<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Coupon;
use Modules\BookStore\App\Models\Book;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Theme\App\Models\theme_feature;

class HomeController extends Controller
{


    public function getBooks(){
      $books = Book::where('status', 1)
        ->orderBy('sort', 'ASC')
        ->get();

        return response()->json($books, 200);
    }

    public function getBookDetails($id){
       $book = Book::where('status', 1)->find($id);

        if (!$book) {
              return response()->json(null, 404);
        }
       return response()->json($book, 200);
    }
    public function getFeatures(){
        $ThemeFeatures = theme_feature::where('status', 1)->get();

        if (!$ThemeFeatures) {
              return response()->json(null, 404);
        }
       return response()->json($ThemeFeatures, 200);
    }



}
