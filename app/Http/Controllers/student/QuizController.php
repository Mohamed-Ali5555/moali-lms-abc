<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class QuizController extends Controller
{
    public function quiz_submit(Request $request)
    {
        $retake = Lesson::where('id', $request->quiz_id)->value('retake');
        $submit = QuizSubmission::where('quiz_id', $request->quiz_id)->where('user_id', auth()->user()->id)->count();
        if ($submit > $retake) {
            Session::flash('warning', get_phrase('Attempt has been over.'));
            return redirect()->back();
        }

        $inputs  = collect($request->all());
        $quiz_id = $inputs->pull('quiz_id');
        $inputs->forget(['_token', 'quiz_id']);

        $submits = $inputs->whereNotNull();
        foreach ($submits as $key => $submit) {
            if (is_string($submit) && ($submit != 'true' && $submit != 'false')) {
                $submits[$key] = array_column(json_decode($submit), 'value');
            }
        }

        $question_ids      = $submits->keys();
        $submitted_answers = $submits->values();
        $questions         = Question::whereIn('id', $question_ids)->get();

        $right_answers = $wrong_answers = [];
        foreach ($questions as $key => $question) {

            $correct_answer = json_decode($question->answer, true);
            $submitted      = $submitted_answers[$key];

            if ($question->type == 'mcq') {
                //$isCorrect = empty(array_diff($correct_answer, $submitted));
                $isCorrect = empty(array_diff($correct_answer, $submitted)) && empty(array_diff($submitted, $correct_answer));
            } elseif ($question->type == 'fill_blanks') {
                $isCorrect = count($correct_answer) === count($submitted);

                if ($isCorrect) {
                    for ($i = 0; $i < count($correct_answer); $i++) {
                        if (strtolower($correct_answer[$i]) != strtolower($submitted[$i])) {
                            $isCorrect = false;
                            break;
                        }
                    }
                } else {
                    $isCorrect = false;
                }
            } elseif ($question->type == 'true_false') {
                $isCorrect = strtolower(json_encode($correct_answer)) == strtolower($submitted);
            }

            $isCorrect ? $right_answers[] = $question->id : $wrong_answers[] = $question->id;
        }

        $data['quiz_id']        = $quiz_id;
        $data['user_id']        = auth()->user()->id;
        $data['correct_answer'] = $right_answers ? json_encode($right_answers) : null;
        $data['wrong_answer']   = $wrong_answers ? json_encode($wrong_answers) : null;
        $data['submits']        = $submits->count() > 0 ? json_encode($submits->toArray()) : null;

        QuizSubmission::insert($data);

        $userId = auth()->user()->id;
        $lessons = Lesson::where('id',$request->quiz_id)->first();
        $courseId = $lessons->course_id;

            // Update course progress if the lesson is completed

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

                if (!in_array($quiz_id, $lessonIds)) {
                    array_push($lessonIds, $quiz_id);
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
            }else{
                DB::table('watch_histories')->insert([
                    'course_id' => $courseId,
                    'student_id' => $userId,
                    'completed_lesson' => json_encode([$lessonId]),
                    'course_progress' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


        Session::flash('success', get_phrase('Your answers have been submitted.'));
        return redirect()->back();
    }

    public function load_result(Request $request)
    {
        $page_data['quiz']      = Lesson::where('id', $request->quiz_id)->first();
        $page_data['questions'] = Question::where('quiz_id', $request->quiz_id)->get();
        $page_data['result']    = QuizSubmission::where('id', $request->submit_id)
            ->where('quiz_id', $request->quiz_id)
            ->where('user_id', auth()->user()->id)
            ->first();
        return view('course_player.quiz.result', $page_data);
    }

    public function load_questions(Request $request)
    {
        $page_data['quiz']      = Lesson::where('id', $request->quiz_id)->first();
        $page_data['questions'] = Question::where('quiz_id', $request->quiz_id)->get();
        $page_data['submits']   = QuizSubmission::where('quiz_id', $request->quiz_id)
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('course_player.quiz.questions', $page_data);
    }
}
