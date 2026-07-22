<?php

namespace Modules\BankQuestions\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\BankQuestions\App\Models\BankQuestionsCategory;
use Modules\BankQuestions\App\Models\BankQuizs;
use Modules\BankQuestions\App\Models\BankQuestions;

class QuizController extends Controller
{
    public function index(Request $request){

        $query = BankQuizs::query();

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $query = $query
            ->where('title', 'LIKE', '%' . $_GET['search'] . '%')
            ->orWhere('retake','LIKE','%' .request('search') .'%')
            ->orWhere('total_mark','LIKE','%' .request('search') .'%')
            ->orWhere('pass_mark','LIKE','%' .request('search') .'%');
        }

        if (isset($request->category) && $request->category != '' && $request->category != 'all') {
            if (str_starts_with($request->category, 'main_')) {
                $mainCategoryId = str_replace('main_', '', $request->category);
                $ids = BankQuestionsCategory::where('category_id', $mainCategoryId)->pluck('id')->toArray();
                $query->whereIn('category_id',$ids);
                $page_data['parent_cat'] = $mainCategoryId;
            }elseif (str_starts_with($request->category, 'sub_')) {
                $subCategoryId = str_replace('sub_', '', $request->category);
                $query->where(['category_id'=>$subCategoryId]);
                $page_data['child_cat'] = $subCategoryId;
            }
        }
        $page_data['quizs'] = $query->orderBy('id','DESC')->paginate(20)->appends(request()->query());
        return view('bankquestions::quiz.index', $page_data);
    }

    public function show($id){

        $questions = BankQuestions::whereHas('quizs',function($query)use($id){
            $query->where('quiz_id',$id);
        })->orderBy('sort')->get();
        $quiz = BankQuizs::where('id', $id)->first();
         // return $questions;
        return view('bankquestions::quiz.show_questions',compact('questions','quiz'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'      => 'required',
            'category'   => 'required|numeric',
            'second'     => 'max:59',
            'minute'     => 'max:59',
            'hour'       => 'max:23',
            'total_mark' => 'required|numeric',
            'pass_mark'  => 'required|numeric',
            'retake'     => 'required|numeric|min:1',
        ])->after(function ($validator) use ($request) {
            $hour   = $request->hour;
            $minute = $request->minute;
            $second = $request->second;

            if ($hour == 0 && $minute == 0 && $second == 0) {
                $validator->errors()->add('second', 'If hour and minute are 0, second must be greater than 0.');
            } elseif ($hour == 0 && $minute == 0 && $second < 1) {
                $validator->errors()->add('minute', 'If hour is 0, minute must be greater than 0.');
            } elseif ($minute == 0 && $second == 0 && $hour < 1) {
                $validator->errors()->add('hour', 'If minute and second are 0, hour must be greater than 0.');
            }

            if ($request->pass_mark > $request->total_mark) {
                $validator->errors()->add('pass_mark', 'The pass mark must be less than the total mark.');
            }
        });
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $hour                = $request->hour ?? 0;
        $minute              = $request->minute ?? 0;
        $second              = $request->second ?? 0;

        $data['duration']     = $hour . ':' . $minute . ':' . $second;
        $data['title']        = $request->title;
        $data['category_id']  = $request->category;
        $data['total_mark']   = $request->total_mark;
        $data['pass_mark']    = $request->pass_mark;
        $data['retake']       = $request->retake;
        $data['description']  = $request->description;
        $data['status']       = 1;

        BankQuizs::insert($data);

        Session::flash('success', get_phrase('Quiz has been created.'));
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {

        $quiz = BankQuizs::where('id', $id)->first();
        if (! $quiz) {
            return response()->json_encode([
                'error' => get_phrase('Data not found.'),
            ]);
        }
        $validator = Validator::make($request->all(), [
            'title'      => 'required',
            'category'   => 'required|numeric',
            'second'     => 'max:59',
            'minute'     => 'max:59',
            'hour'       => 'max:23',
            'total_mark' => 'required|numeric',
            'pass_mark'  => 'required|numeric',
            'retake'     => 'required|numeric|min:1',
        ])->after(function ($validator) use ($request) {
            $hour   = $request->hour;
            $minute = $request->minute;
            $second = $request->second;

            if ($hour == 0 && $minute == 0 && $second == 0) {
                $validator->errors()->add('second', 'If hour and minute are 0, second must be greater than 0.');
            } elseif ($hour == 0 && $minute == 0 && $second < 1) {
                $validator->errors()->add('minute', 'If hour is 0, minute must be greater than 0.');
            } elseif ($minute == 0 && $second == 0 && $hour < 1) {
                $validator->errors()->add('hour', 'If minute and second are 0, hour must be greater than 0.');
            }

            if ($request->pass_mark > $request->total_mark) {
                $validator->errors()->add('pass_mark', 'The pass mark must be less than the total mark.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $hour                = $request->hour ?? 0;
        $minute              = $request->minute ?? 0;
        $second              = $request->second ?? 0;

        $data['duration']     = $hour . ':' . $minute . ':' . $second;
        $data['title']        = $request->title;
        $data['category_id']  = $request->category;
        $data['total_mark']   = $request->total_mark;
        $data['pass_mark']    = $request->pass_mark;
        $data['retake']       = $request->retake;
        $data['description']  = $request->description;
        $data['status']       = 1;
        BankQuizs::where('id', $id)->update($data);

        Session::flash('success', get_phrase('Quiz has been updated.'));
        return redirect()->back();
    }

    public function result(Request $request)
    {
        $submissions = QuizSubmission::where('quiz_id', $request->quizId)
            ->where('user_id', $request->participant)->get();

        $result[] = "<option>" . get_phrase('Select an option') . "</option>";
        foreach ($submissions as $key => $submission) {
            $result[] = "<option value=" . $submission->id . ">Attempt " . ++$key . "</option>";
        }
        return $result;
    }

    public function result_preview(Request $request)
    {
        $page_data['quiz']      = Lesson::where('id', $request->quizId)->first();
        $page_data['results']   = QuizSubmission::where('quiz_id', $request->quizId)->where('user_id', $request->participantId)->get();
        $page_data['questions'] = Question::where('quiz_id', $request->quizId)->get();
        return view('admin.quiz_result.preview', $page_data);
    }





    public function destroy($id){
        $quiz = BankQuizs::where('id', $id)->first();
        if (! $quiz) {
            Session::flash('error', get_phrase('quiz not found.'));
            return redirect()->back();
        }
        $quiz->questions()->delete();
        $quiz->delete();
        Session::flash('success', get_phrase('Question has been deleted.'));
        return redirect()->back();

    }
}
