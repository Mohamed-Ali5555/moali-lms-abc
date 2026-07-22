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

class CategoryController extends Controller
{
    public function allCategories()
    {

        $all_categories = array();
        $categories = Category::where('parent_id', 0)->get();
        foreach ($categories as $key => $category) {
            $all_categories[$key] = $category;
            $all_categories[$key]['thumbnail'] = get_photo('category_thumbnail', $category['thumbnail']);
            $all_categories[$key]['number_of_courses'] = get_category_wise_courses($category['id'])->count();

            $all_categories[$key]['number_of_sub_categories'] = $category->childs->count();

            // $sub_categories = $category->childs;
        }
       return response()->json($all_categories, 200);
    }
    // Fetch all the categories
    public function category_details($id)
    {
        $category= Category::where('id',$id)->first();
        if(!$category){
              return response()->json(null, 404);
        }
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
       return response()->json([$categories,$books,$mainCategory,$cartItems], 200);

    }








//   public function Searchcategories($category_id = "")
//     {
//         if ($category_id != "") {
//             $categories = Category::where('id', $category_id)->first();
//         } else {
//             $categories = Category::where('parent_id', 0)->get();
//         }
//         foreach ($categories as $key => $category) {
//             $categories[$key]['thumbnail'] = get_photo('category_thumbnail', $category['thumbnail']);
//             $categories[$key]['number_of_courses'] = get_category_wise_courses($category['id'])->count();

//             $categories[$key]['number_of_sub_categories'] = $category->childs->count();
//         }
//         return $categories;
//     }
}
