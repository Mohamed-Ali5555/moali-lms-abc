<?php

namespace Modules\Theme\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use Modules\BookStore\App\Models\Book;
use App\Models\CartItem;
use App\Models\BootcampCategory;
use App\Models\Bootcamp;

class CategoryController extends Controller
{
    public function index($id){
        $category= Category::where('id',$id)->where('status',1)->first();
        if(!$category){
            return redirect()->back();
        }
        $courses      = Course::where('status','active')->get();
        $categories   = Category::where('parent_id','!=',0)->where('parent_id',$category->id)->where('status',1)->get();
        if($categories->isEmpty()){
            $categories = Category::where('id',$id)->where('status',1)->get();
        }
        $mainCategory = Category::where('id',$category->id)->where('status',1)->first();
        $books        = Book::where('status',1)->where(['category_id'=>$category->id])->orderBy('sort', 'asc')->get();
        $bootcampCategories = BootcampCategory::where('category_id',$category->id)->orderBy('id', 'asc')->get();
        $bootcamps = Bootcamp::where('status',1)->get();
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

        return view('theme::category.index',compact('courses','categories','books','mainCategory','cartItems','bootcampCategories','bootcamps'));
    }
}
