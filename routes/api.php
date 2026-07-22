<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\frontend\CourseController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Api\v1\HomeController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\CouponController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Coupon API Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/coupons/validate', [CouponController::class, 'validateCoupon']);
    Route::get('/coupons/info', [CouponController::class, 'getCouponInfo']);
    Route::post('/coupons/recharge', [CouponController::class, 'applyRechargeCoupon']);
    Route::post('/coupons/discount', [CouponController::class, 'applyDiscountCoupon']);
    Route::post('/coupons/payment', [CouponController::class, 'applyPaymentCoupon']);
    Route::post('/coupons/transfer', [CouponController::class, 'transferCoupon']);
    Route::get('/coupons/user', [CouponController::class, 'getUserCoupons']);
});







// auth
Route::post('/login', [ApiController::class, 'login']);
Route::post('/signup', [ApiController::class, 'signup']);
Route::post('/forgot_password', [ApiController::class, 'forgot_password']);
// end auth







// home page bools section
Route::get('/books', [HomeController::class, 'getBooks']);
Route::get('/books-details/{id}', [HomeController::class, 'getBookDetails']);
// end home page books section


// theme feature
Route::get('/theme-feature', [HomeController::class, 'getFeatures']);
// end feature

// all category
Route::get('/all-categories', [CategoryController::class, 'allCategories']);
Route::get('/search-categories', [CategoryController::class, 'SearchCategories']);
Route::get('/category_details/{id}', [CategoryController::class, 'category_details']);

// end category

// courses
Route::get('/all-Courses', [CourseController::class, 'allCourses']);

Route::get('/course-details/{id}', [CourseController::class, 'courseDetails']);
    Route::get('/filter_course', [CourseController::class, 'filter_course']);

//end courses



// Route::get('/categories', [ApiController::class, 'all_categories']);

Route::group(['middleware', ['auth:sanctum']], function () {
    Route::get('/top_courses', [ApiController::class, 'top_courses']);

    Route::get('/all_categories', [ApiController::class, 'all_categories']);
    Route::get('/category_details', [ApiController::class, 'category_details']);

    Route::get('/sub_categories/{id}', [ApiController::class, 'sub_categories']);
    Route::get('/category_wise_course', [ApiController::class, 'category_wise_course']);
    Route::get('/category_subcategory_wise_course', [ApiController::class, 'category_subcategory_wise_course']);
    // Route::get('/filter_course', [ApiController::class, 'filter_course']);
    Route::get('/my_wishlist', [ApiController::class, 'my_wishlist']);
    Route::get('/toggle_wishlist_items', [ApiController::class, 'toggle_wishlist_items']);
    Route::get('/languages', [ApiController::class, 'languages']);
    Route::get('/courses_by_search_string', [ApiController::class, 'courses_by_search_string']);
    Route::get('/my_courses', [ApiController::class, 'my_courses']);
    Route::get('/sections', [ApiController::class, 'sections']);
    Route::get('/course_details_by_id', [ApiController::class, 'course_details_by_id']);
    Route::post('/update_password', [ApiController::class, 'update_password']);
    Route::post('/update_userdata', [ApiController::class, 'update_userdata']);
    Route::post('/account_disable', [ApiController::class, 'account_disable']);
    Route::get('/cart_list', [ApiController::class, 'cart_list']);
    Route::get('/toggle_cart_items', [ApiController::class, 'toggle_cart_items']);
    Route::get('/save_course_progress', [ApiController::class, 'save_course_progress']);
    Route::post('/logout', [ApiController::class, 'logout'])->middleware('auth:sanctum');

    //Zoom live class
    Route::get('zoom/settings', [ApiController::class, 'zoom_settings']);
    Route::get('zoom/meetings', [ApiController::class, 'live_class_schedules']);

    Route::get('payment/{token}', [ApiController::class, 'payment']);
    Route::get('token', [ApiController::class, 'token']);

    Route::get('free_course_enroll/{course_id}', [ApiController::class, 'free_course_enroll']);

    Route::get('cart_tools', [ApiController::class, 'cart_tools']);

    // Quiz APIs
    Route::get('/quiz/{quiz_id}', [QuizController::class, 'getQuiz']);
    Route::post('/quiz/{quiz_id}/submit', [QuizController::class, 'submitQuiz']);
    Route::get('/quiz/{quiz_id}/result/{submission_id}', [QuizController::class, 'getQuizResult']);
    Route::get('/quiz/{quiz_id}/submissions', [QuizController::class, 'getQuizSubmissions']);
});

