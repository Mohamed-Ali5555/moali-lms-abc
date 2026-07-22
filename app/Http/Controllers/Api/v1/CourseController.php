<?php

namespace App\Http\Controllers\Api\v1;

use Modules\BookStore\App\Models\Book;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CartItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CourseController extends Controller
{
   public function allCourses()
    {
        $courses      = Course::where('status','active')->get();

       return response()->json($courses, 200);
    }
    // Fetch all the categories
    public function courseDetails($id)
    {
        $category= Category::where('id',$id)->first();
        if(!$category){
              return response()->json(null, 404);
        }
        $courses      = Course::where('status','active')->get();
        $categories   = Category::where('parent_id','!=',0)->where('parent_id',$category->id)->get();
        if($categories->isEmpty()){
            $categories = Category::where('id',$id)->get();
        }
        $mainCategory = Category::where('id',$category->id)->first();
        $books        = Book::where('status',1)->where(['category_id'=>$category->id])->orderBy('sort', 'asc')->get();

        if(auth()->check()){
            $cartItems = CartItem::where('user_id', auth()->user()->id)
            ->whereNotNull('book_id')
            ->pluck('qty', 'book_id')
            ->toArray();
        }else{
            $cartItems = CartItem::whereNotNull('book_id')
            ->pluck('qty', 'book_id')
            ->toArray();
        }
       return response()->json([$courses,$categories,$books,$mainCategory,$cartItems], 200);

    }






 // Filter course
    public function filter_course(Request $request)
    {

        $selected_category = $request->selected_category;
        $selected_price = $request->selected_price;
        $selected_level = $request->selected_level;
        $selected_language = $request->selected_language;
        $selected_rating = $request->selected_rating;
        $selected_search_string = ltrim(rtrim($request->selected_search_string));

        // $course_ids = array();

        $query = Course::query();

        if ($selected_search_string != "" && $selected_search_string != "null") {
            $query->where('title', $selected_search_string->id);
        }
        if ($selected_category != "all") {
            $query->where('category_id', $selected_category);
        }

        if ($selected_price != "all") {
            if ($selected_price == "paid") {
                $query->where('is_paid', 1);
            } elseif ($selected_price == "free") {
                $query->where('is_paid', 0)
                    ->orWhere('is_paid', null);
            }
        }

        if ($selected_level != "all") {
            $query->where('level', $selected_level);
        }

        if ($selected_language != "all") {
            $query->where('language', $selected_language);
        }

        $query->where('status', 'active');
        $courses = $query->get();

        // This block of codes return the required data of courses
        $result = array();
        $result = course_data($courses);
        return $result;

    }

    // Filter course
    public function courses_by_search_string(Request $request)
    {
        $search_string = $request->search_string;

        $courses = Course::where('title', 'LIKE', "%{$search_string}%")->where('status', 'active')->get();
        $response = course_data($courses);

        return $response;
    }


    // Course Details
    public function course_details_by_id(Request $request)
    {

        $response = array();

        $course_id = $request->course_id;

        $user = auth('sanctum')->user();
        $user_id = $user ? $user->id : 0;

        if ($user_id > 0) {
            $response = course_details_by_id($user_id, $course_id);
        } else {
            $response = course_details_by_id(0, $course_id);
        }
        return $response;

    }
}
