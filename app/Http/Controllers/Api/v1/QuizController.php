<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuizSubmission;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    /**
     * Get quiz details and questions
     * GET /api/v1/quiz/{quiz_id}
     */
    public function getQuiz(Request $request, $quizId)
    {
        //try {
        $user = auth('sanctum')->user();
            
            // Check if user is enrolled in the course
            $quiz = Lesson::where('id', $quizId)
                ->where('lesson_type', 'quiz')
                ->with(['course', 'questions' => function($query) {
                    $query->orderBy('sort', 'asc');
                }])
                ->first();
            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found'
                ], 404);
            }
            // Check enrollment
            $enrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $quiz->course_id)
                ->first();
                
            if (!$enrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            // Get user's previous submissions
            $submissions = QuizSubmission::where('quiz_id', $quizId)
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Check if user can retake
            $canRetake = $submissions->count() < $quiz->retake;

            // Format questions for API (hide correct answers)
            $questions = $quiz->questions->map(function($question) {
                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'options' => $question->options ? json_decode($question->options, true) : null,
                    'sort' => $question->sort
                ];
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'quiz' => [
                        'id' => $quiz->id,
                        'title' => $quiz->title,
                        'description' => $quiz->description,
                        'total_mark' => $quiz->total_mark,
                        'pass_mark' => $quiz->pass_mark,
                        'retake' => $quiz->retake,
                        'duration' => $quiz->duration,
                        'start_time' => $quiz->start_time,
                        'end_time' => $quiz->end_time,
                        'can_retake' => $canRetake,
                        'attempts_used' => $submissions->count(),
                        'attempts_remaining' => max(0, $quiz->retake - $submissions->count())
                    ],
                    'questions' => $questions,
                    'previous_submissions' => $submissions->map(function($submission) {
                        return [
                            'id' => $submission->id,
                            'correct_answers' => $submission->correct_answer ? json_decode($submission->correct_answer, true) : [],
                            'wrong_answers' => $submission->wrong_answer ? json_decode($submission->wrong_answer, true) : [],
                            'submitted_at' => $submission->created_at->format('Y-m-d H:i:s'),
                            'score' => $submission->correct_answer ? count(json_decode($submission->correct_answer, true)) : 0
                        ];
                    })
                ]
            ]);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'An error occurred while fetching quiz data',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
    }

    /**
     * Submit quiz answers
     * POST /api/v1/quiz/{quiz_id}/submit
     */
    public function submitQuiz(Request $request, $quizId)
    {
        try {
            $user = auth('sanctum')->user();
            // Validate request
            $validator = Validator::make($request->all(), [
                'answers' => 'required|array',
                'answers.*' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get quiz details
            $quiz = Lesson::where('id', $quizId)
                ->where('lesson_type', 'quiz')
                ->first();

            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found'
                ], 404);
            }

            // Check enrollment
            $enrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $quiz->course_id)
                ->where('status', 'active')
                ->first();

            if (!$enrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            // Check retake limit
            $submissionCount = QuizSubmission::where('quiz_id', $quizId)
                ->where('user_id', $user->id)
                ->count();

            if ($submissionCount >= $quiz->retake) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maximum attempts exceeded'
                ], 400);
            }

            // Process answers
            $answers = $request->input('answers');
            $questionIds = array_keys($answers);
            $questions = Question::whereIn('id', $questionIds)->get();

            $rightAnswers = [];
            $wrongAnswers = [];

            foreach ($questions as $question) {
                $correctAnswer = json_decode($question->answer, true);
                $submittedAnswer = $answers[$question->id];

                $isCorrect = false;

                if ($question->type == 'mcq') {
                    // For multiple choice questions
                    $isCorrect = empty(array_diff($correctAnswer, $submittedAnswer));
                } elseif ($question->type == 'fill_blanks') {
                    // For fill in the blanks
                    $isCorrect = count($correctAnswer) === count($submittedAnswer);
                    if ($isCorrect) {
                        for ($i = 0; $i < count($correctAnswer); $i++) {
                            if (strtolower($correctAnswer[$i]) != strtolower($submittedAnswer[$i])) {
                                $isCorrect = false;
                                break;
                            }
                        }
                    }
                } elseif ($question->type == 'true_false') {
                    // For true/false questions
                    $isCorrect = strtolower(json_encode($correctAnswer)) == strtolower($submittedAnswer);
                }

                if ($isCorrect) {
                    $rightAnswers[] = $question->id;
                } else {
                    $wrongAnswers[] = $question->id;
                }
            }

            // Save submission
            $submission = QuizSubmission::create([
                'quiz_id' => $quizId,
                'user_id' => $user->id,
                'correct_answer' => !empty($rightAnswers) ? json_encode($rightAnswers) : null,
                'wrong_answer' => !empty($wrongAnswers) ? json_encode($wrongAnswers) : null,
                'submits' => json_encode($answers)
            ]);

            // Update course progress
            $this->updateCourseProgress($user->id, $quizId, $quiz->course_id);

            // Calculate score
            $totalQuestions = $questions->count();
            $correctCount = count($rightAnswers);
            $score = $totalQuestions > 0 ? ($correctCount / $totalQuestions) * 100 : 0;
            $passed = $score >= $quiz->pass_mark;

            return response()->json([
                'success' => true,
                'message' => 'Quiz submitted successfully',
                'data' => [
                    'submission_id' => $submission->id,
                    'score' => round($score, 2),
                    'correct_answers' => count($rightAnswers),
                    'wrong_answers' => count($wrongAnswers),
                    'total_questions' => $totalQuestions,
                    'passed' => $passed,
                    'pass_mark' => $quiz->pass_mark,
                    'submitted_at' => $submission->created_at->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting quiz',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get quiz result details
     * GET /api/v1/quiz/{quiz_id}/result/{submission_id}
     */
    public function getQuizResult(Request $request, $quizId, $submissionId)
    {
        try {
            $user = auth('sanctum')->user();

            $quiz = Lesson::where('id', $quizId)
                ->where('lesson_type', 'quiz')
                ->with(['questions'])
                ->first();

            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found'
                ], 404);
            }

            $submission = QuizSubmission::where('id', $submissionId)
                ->where('quiz_id', $quizId)
                ->where('user_id', $user->id)
                ->first();

            if (!$submission) {
                return response()->json([
                    'success' => false,
                    'message' => 'Submission not found'
                ], 404);
            }

            $correctAnswers = $submission->correct_answer ? json_decode($submission->correct_answer, true) : [];
            $wrongAnswers = $submission->wrong_answer ? json_decode($submission->wrong_answer, true) : [];
            $submittedAnswers = $submission->submits ? json_decode($submission->submits, true) : [];

            // Get detailed question results
            $questionResults = [];
            foreach ($quiz->questions as $question) {
                $isCorrect = in_array($question->id, $correctAnswers);
                $userAnswer = $submittedAnswers[$question->id] ?? null;
                $correctAnswer = json_decode($question->answer, true);

                $questionResults[] = [
                    'question_id' => $question->id,
                    'question_title' => $question->title,
                    'question_type' => $question->type,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $correctAnswer,
                    'is_correct' => $isCorrect,
                    'options' => $question->options ? json_decode($question->options, true) : null
                ];
            }

            $totalQuestions = $quiz->questions->count();
            $correctCount = count($correctAnswers);
            $score = $totalQuestions > 0 ? ($correctCount / $totalQuestions) * 100 : 0;
            $passed = $score >= $quiz->pass_mark;

            return response()->json([
                'success' => true,
                'data' => [
                    'quiz' => [
                        'id' => $quiz->id,
                        'title' => $quiz->title,
                        'total_mark' => $quiz->total_mark,
                        'pass_mark' => $quiz->pass_mark
                    ],
                    'submission' => [
                        'id' => $submission->id,
                        'score' => round($score, 2),
                        'correct_answers' => $correctCount,
                        'wrong_answers' => count($wrongAnswers),
                        'total_questions' => $totalQuestions,
                        'passed' => $passed,
                        'submitted_at' => $submission->created_at->format('Y-m-d H:i:s')
                    ],
                    'question_results' => $questionResults
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching quiz result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's quiz submissions for a specific quiz
     * GET /api/v1/quiz/{quiz_id}/submissions
     */
    public function getQuizSubmissions(Request $request, $quizId)
    {
        try {
            $user = auth('sanctum')->user();

            $quiz = Lesson::where('id', $quizId)
                ->where('lesson_type', 'quiz')
                ->first();

            if (!$quiz) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz not found'
                ], 404);
            }

            $submissions = QuizSubmission::where('quiz_id', $quizId)
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $submissionData = $submissions->map(function($submission) use ($quiz) {
                $correctAnswers = $submission->correct_answer ? json_decode($submission->correct_answer, true) : [];
                $wrongAnswers = $submission->wrong_answer ? json_decode($submission->wrong_answer, true) : [];
                
                // Get total questions count
                $totalQuestions = Question::where('quiz_id', $quiz->id)->count();
                $score = $totalQuestions > 0 ? (count($correctAnswers) / $totalQuestions) * 100 : 0;
                $passed = $score >= $quiz->pass_mark;

                return [
                    'id' => $submission->id,
                    'score' => round($score, 2),
                    'correct_answers' => count($correctAnswers),
                    'wrong_answers' => count($wrongAnswers),
                    'total_questions' => $totalQuestions,
                    'passed' => $passed,
                    'submitted_at' => $submission->created_at->format('Y-m-d H:i:s')
                ];
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'quiz' => [
                        'id' => $quiz->id,
                        'title' => $quiz->title,
                        'retake' => $quiz->retake
                    ],
                    'submissions' => $submissionData,
                    'total_submissions' => $submissions->count(),
                    'remaining_attempts' => max(0, $quiz->retake - $submissions->count())
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching submissions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update course progress after quiz completion
     */
    private function updateCourseProgress($userId, $quizId, $courseId)
    {
        try {
            $watchHistory = DB::table('watch_histories')
                ->where([
                    'course_id' => $courseId,
                    'student_id' => $userId,
                ])
                ->first();

            if ($watchHistory) {
                $lessonIds = json_decode($watchHistory->completed_lesson, true);
                $courseProgress = $watchHistory->course_progress;

                if (!is_array($lessonIds)) $lessonIds = [];

                if (!in_array($quizId, $lessonIds)) {
                    array_push($lessonIds, $quizId);
                    $totalLesson = DB::table('lessons')->where('course_id', $courseId)->count();
                    $courseProgress = (100 / $totalLesson) * count($lessonIds);

                    $completedDate = ($courseProgress >= 100 && !$watchHistory->completed_date)
                        ? time()
                        : $watchHistory->completed_date;

                    DB::table('watch_histories')
                        ->where('id', $watchHistory->id)
                        ->update([
                            'course_progress' => $courseProgress,
                            'completed_lesson' => json_encode($lessonIds),
                            'completed_date' => $completedDate,
                        ]);
                }
            } else {
                DB::table('watch_histories')->insert([
                    'course_id' => $courseId,
                    'student_id' => $userId,
                    'completed_lesson' => json_encode([$quizId]),
                    'course_progress' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            // Log error but don't fail the quiz submission
            Log::error('Failed to update course progress: ' . $e->getMessage());
        }
    }
}
