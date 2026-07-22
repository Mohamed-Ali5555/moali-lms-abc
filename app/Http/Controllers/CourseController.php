<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Mailer;
use App\Models\Category;
use App\Models\Course;
use App\Models\FileUploader;
use App\Models\Section;
use App\Models\SeoField;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Watch_history;
use App\Models\QuizSubmission;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $category   = 'all';
        $status     = 'all';
        $instructor = 'all';
        $price      = 'all';

        $query  = Course::query();
        $query1 = Course::query();

        if (isset($request->category) && $request->category != '' && $request->category != 'all') {

            $category_details = Category::where('slug', $request->category)->first();
            if ($category_details->parent_id > 0) {
                $page_data['child_cat'] = $request->category;
                $query                  = $query->where('category_id', $category_details->id);
            } else {
                $sub_cat_id              = Category::where('parent_id', $category_details->id)->pluck('id')->toArray();
                $sub_cat_id[] = $category_details->id;
                $query                   = $query->whereIn('category_id', $sub_cat_id);
                $page_data['parent_cat'] = $request->category;
            }
        }

        // search filter
        if (isset($_GET['search']) && $_GET['search'] != '') {
            $query = $query->where('title', 'LIKE', '%' . $_GET['search'] . '%');
        }

        // selected price
        if (isset($_GET['price']) && $_GET['price'] != '' && $_GET['price'] != 'all') {
            $search_price = 2;
            if ($_GET['price'] == 'free') {
                $search_price = 0;
            } elseif ($_GET['price'] == 'paid') {
                $search_price = 1;
            }
            $query = $query->where('is_paid', $search_price);
            $price = $_GET['price'];
        }
        // selected instructor
        if (isset($_GET['instructor']) && $_GET['instructor'] != '' && $_GET['instructor'] != 'all') {
            $query      = $query->where('user_id', $_GET['instructor']);
            $instructor = $_GET['instructor'];
        }

        // status filter
        if (isset($_GET['status']) && $_GET['status'] != '' && $_GET['status'] != 'all') {

            if ($_GET['status'] == 'active') {
                $search_status = 'active';
                $query         = $query->where('status', $search_status);
            } elseif ($_GET['status'] == 'inactive') {
                $search_status = 'inactive';
                $query         = $query->where('status', $search_status);
            } elseif ($_GET['status'] == 'pending') {
                $search_status = 'pending';
                $query         = $query->where('status', $search_status);
            } elseif ($_GET['status'] == 'private') {
                $search_status = 'private';
                $query         = $query->where('status', $search_status);
            } elseif ($_GET['status'] == 'upcoming') {
                $search_status = 'upcoming';
                $query         = $query->where('status', $search_status);
            } elseif ($_GET['status'] == 'draft') {
                $search_status = 'draft';
                $query         = $query->where('status', $search_status);
            }
            $status = $_GET['status'];
        }
        $page_data['status']           = $status;
        $page_data['instructor']       = $instructor;
        $page_data['price']            = $price;
        $page_data['courses']          = $query->paginate(20)->appends(request()->query());
        $page_data['pending_courses']  = Course::where('status', 'pending')->count();
        $page_data['active_courses']   = Course::where('status', 'active')->count();
        $page_data['inactive_courses'] = Course::where('status', 'inactive')->count();
        $page_data['upcoming_courses'] = Course::where('status', 'upcoming')->count();
        $page_data['paid_courses']     = Course::where('is_paid', 1)->count();
        $page_data['free_courses']     = Course::where('is_paid', 0)->count();

        return view('admin.course.index', $page_data);
    }

    public function create()
    {
        return view('admin.course.create');
    }
    public function showUsers(Request $request ,$id){

        $query = User::where('role', 'student')
        ->whereDoesntHave('enrollments', function ($q) use ($id) {
            $q->where('course_id', $id);
        });
        if(request()->filled('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search. '%');
            });
         }


        $users = $query->get();
        return view('admin.course.show_user', compact('users','id'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required|max:255',
            'category_id'           => 'required|numeric|min:1',
            'course_type'           => 'required|in:general,scorm',
            'status'                => 'required|in:active,inactive',
            // 'level'                 => 'required|in:everyone,beginner,intermediate,advanced',
            // 'language'              => 'required',
            'is_paid'               => Rule::in(['0', '1']),
            'price'                 => 'required_if:is_paid,1|min:1|nullable|numeric',
            'discount_flag'         => Rule::in(['', '1']),
            'discount_price'      => ['nullable','numeric','min:1',
                Rule::requiredIf(function () use ($request) {
                    return $request->discount_flag == 1 && $request->is_paid == 1;
                }),],
            'enable_drip_content'   => Rule::in(['0', '1']),
            // 'requirements'          => 'array',
            // 'outcomes'              => 'array',
            // 'faqs'                  => 'array',
            'instructors'           => 'required|array|min:1',
            'thumbnail'             =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:47048',

        ]);
        //for normal form submission

        $data['title']                 = $request->title;
        $data['slug']                  = slugify($request->title);
        $data['user_id']               = auth()->user()->id;
        $data['category_id']           = $request->category_id;
        $data['course_type']           = $request->course_type;
        $data['status']                = $request->status;
        $data['level']                 = 'beginner';
        $data['language']              = 'arabic';
        $data['enable_drip_content']   = $request->enable_drip_content;


        if($request->is_paid == 0){

            $data['is_paid']          = 0;
            $data['price']            = 0;
            $data['discount_price'] = 0;
            $data['discount_flag']    = null;


        }else{
            $data['is_paid']          = $request->is_paid;
            $data['price']            = $request->price;
            $data['discount_flag']    = $request->discount_flag;
            $data['discount_price'] = $request->discount_price;
        }

        $drip_content_settings = '{"lesson_completion_role":"percentage","minimum_duration":15,"minimum_percentage":"25","locked_lesson_message":"&lt;h3 xss=&quot;removed&quot; style=&quot;text-align: center; &quot;&gt;&lt;span xss=&quot;removed&quot;&gt;&lt;strong&gt;Permission denied!&lt;\/strong&gt;&lt;\/span&gt;&lt;\/h3&gt;&lt;p xss=&quot;removed&quot; style=&quot;text-align: center; &quot;&gt;&lt;span xss=&quot;removed&quot;&gt;This course supports drip content, so you must complete the previous lessons.&lt;\/span&gt;&lt;\/p&gt;"}';

        $data['drip_content_settings'] = $drip_content_settings;

        // $meta_keywords     = '';
        // $meta_keywords_arr = json_decode($request->meta_keywords, true);
        // if (is_array($meta_keywords_arr)) {
        //     foreach ($meta_keywords_arr as $key => $keyword) {
        //         if ($key > 0) {
        //             $meta_keywords .= ',' . $keyword['value'];
        //         } else {
        //             $meta_keywords .= $keyword['value'];
        //         }
        //     }
        // }
        // $data['meta_keywords']    = $meta_keywords;
        // $data['meta_description'] = $request->meta_description;

        // $data['short_description'] = $request->short_description;
        $data['description']       = $request->description;

        //Course expiry period
        if ($request->expiry_period == 'limited_time' && is_numeric($request->number_of_month) && $request->number_of_month > 0) {
            $data['expiry_period'] = $request->number_of_month;
        } else {
            $data['expiry_period'] = null;
        }

        //Remove empty value by using array filter function
        // if (isset($request->requirements) && $request->requirements != '') {

        //     $data['requirements'] = json_encode(array_filter($request->requirements, fn ($value) => !is_null($value) && $value !== ''));
        // }
        // if (isset($request->outcomes) && $request->outcomes != '') {

        //     $data['outcomes'] = json_encode(array_filter($request->outcomes, fn ($value) => !is_null($value) && $value !== ''));
        // }

        // if (isset($request->faq_title) && $request->faq_title != '') {

        //     $faqs = [];
        //     foreach ($request->faq_title as $key => $title) {
        //         if ($title != '') {
        //             $faqs[] = ['title' => $title, 'description' => $request->faq_description[$key]];
        //         }
        //     }
        //     $data['faqs'] = json_encode($faqs);
        // }

        $data['instructor_ids'] = json_encode($request->instructors);
        $data['created_at']  = date('Y-m-d H:i:s');
        $data['updated_at']  = date('Y-m-d H:i:s');

        if ($request->thumbnail) {
            $data['thumbnail'] = "uploads/course-thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 400, null, 200, 200);
        }

        // if ($request->banner) {
        //     $data['banner'] = "uploads/course-banner/" . nice_file_name($request->title, $request->banner->extension());
        //     FileUploader::upload($request->banner, $data['banner'], 1400, null, 300, 300);
        // }

        // if ($request->preview) {
        //     $data['preview'] = "uploads/course-preview/" . nice_file_name($request->title, $request->preview->extension());
        //     FileUploader::upload($request->preview, $data['preview']);
        // }

        $course_id = Course::insertGetId($data);
        Course::where('id', $course_id)->update(['slug' => slugify($request->title . '-' . $course_id)]);

        //for normal form submission
        return redirect(route('admin.course.edit', ['id' => $course_id]))->with('success', get_phrase('Course added successfully'));
    }

    public function edit($course_id = "", Request $request)
    {

        $data['course_details'] = Course::where('id', $course_id)->first();
        $data['sections']       = Section::where('course_id', $course_id)->orderBy('sort')->get();
        return view('admin.course.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $query = Course::where('id', $id);
        if ($request->tab == '') {
            Session::flash('error', get_phrase('Data not found.'));
            return redirect()->back();
        }

        $rules = $data = [];
        if ($request->tab == 'basic') {
            $rules = [
                'title'       => 'required|max:255',
                'category_id' => 'required|numeric|min:1',
                // 'level'       => 'required|in:everyone,beginner,intermediate,advanced',
                // 'language'    => 'required',
                'status'      => 'required|in:active,inactive',
                'instructors' => 'required|array|min:1',
            ];

            $data['title']             = $request->title;
            $data['slug']              = slugify($request->title . '-' . $id);
            // $data['short_description'] = $request->short_description;
            $data['description']       = removeScripts($request->description);
            $data['category_id']       = $request->category_id;
            $data['level']             = 'beginner';
            $data['language']          = 'arabic';
            $data['status']            = $request->status;
            $data['instructor_ids']    = json_encode($request->instructors);


           if ($request->thumbnail) {
                $data['thumbnail'] = "uploads/course-thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
                FileUploader::upload($request->thumbnail, $data['thumbnail'], 400, null, 200, 200);
                remove_file($query->first()->thumbnail);
            }
        } elseif ($request->tab == 'pricing') {
            $rules = [
                'is_paid'          => Rule::in(['0', '1']),
                'price'            => 'required_if:is_paid,1|min:1|nullable|numeric',
                'discount_flag'    => Rule::in(['', '1']),
                'discount_price'   => ['nullable','numeric','min:1',
                Rule::requiredIf(function () use ($request) {
                    return $request->discount_flag == 1 && $request->is_paid == 1;
                }),],            ];

            if($request->is_paid == 0){ // free

               $data['is_paid']          = 0;
               $data['price']            = 0;
               $data['discount_price']   = 0;
               $data['discount_flag']    = null;


            }else{
               $data['is_paid']          = $request->is_paid;
               $data['price']            = $request->price;
               $data['discount_flag']    = $request->discount_flag;
               $data['discount_price']   = $request->discount_price;
            }


            //Course expiry period
            if ($request->expiry_period == 'limited_time' && is_numeric($request->number_of_month) && $request->number_of_month > 0) {
                $data['expiry_period'] = $request->number_of_month;
            } else {
                $data['expiry_period'] = null;
            }




        }  elseif ($request->tab == 'drip-content') {
            $rules = [
                'enable_drip_content'   => Rule::in(['0', '1']),
            ];

            $data['enable_drip_content']   = $request->enable_drip_content;

            $lesson_completion_role = htmlspecialchars($request->input('lesson_completion_role'));
            $minimum_duration_input = htmlspecialchars($request->input('minimum_duration'));
            $minimum_percentage = htmlspecialchars($request->input('minimum_percentage'));
            $locked_lesson_message = htmlspecialchars($request->input('locked_lesson_message'));

            // Convert time (HH:MM:SS) to seconds
            $time_parts = explode(':', $minimum_duration_input);
            $seconds = ($time_parts[0] * 3600) + ($time_parts[1] * 60) + $time_parts[2];

            $drip_data = [
                'lesson_completion_role' => $lesson_completion_role,
                'minimum_duration'       => $seconds,
                'minimum_percentage'     => $minimum_percentage,
                'locked_lesson_message'  => $locked_lesson_message,
            ];

            $data['drip_content_settings'] = json_encode($drip_data);
        }

        //For ajax form submission
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return json_encode(array('validationError' => $validator->getMessageBag()->toArray()));
        }

        $query->update($data);

        //For ajax form submission
        // return back()->with('success','Course updated successfully');
        return ['success' => get_phrase('Course updated successfully')];

    }

    public function status($type, $id)
    {
        if ($type == 'active') {
            Course::where('id', $id)->update(['status' => 'active']);

        } else {
            Course::where('id', $id)->update(['status' => 'inactive']);
        }

        return redirect(route('admin.courses'))->with('success', get_phrase('Course status changed successfully'));
    }

    public function delete($id)
    {
        $query = Course::where('id', $id);
         if (!$query) {
            return redirect(route('admin.courses'))->with('error', get_phrase('Course not found'));
        }

        remove_file($query->first()->thumbnail);
        remove_file($query->first()->banner);
        remove_file($query->first()->preview);
        Enrollment::where('course_id',$id)->delete();
        $query->delete();
        return redirect(route('admin.courses'))->with('success', get_phrase('Course deleted successfully'));
    }
public function studentViews($id)
    {
        $course = Course::findOrFail($id);

        // جلب جميع الـ Sections مع الدروس والاختبارات والواجبات الخاصة بكل section
        $sections = Section::where('course_id', $id)
            ->orderBy('sort')
            ->get();

        // جلب جميع الدروس مرتبة حسب section_id و sort
        $allLessons = Lesson::where('course_id', $id)
            ->orderBy('section_id')
            ->orderBy('sort')
            ->get();

        // تنظيم البيانات: كل section يحتوي على دروسه واختباراته وواجباته
        $sectionsData = [];
        foreach ($sections as $section) {
            $sectionLessons = $allLessons->where('section_id', $section->id);

            $lessons = $sectionLessons->whereIn('lesson_type', ['video-url', 'system-video', 'html5', 'google_drive', 'vimeo-url', 'text']);
            $quizzes = $sectionLessons->where('lesson_type', 'quiz');
            $assignments = $sectionLessons->where('lesson_type', 'assignment');

            if ($lessons->count() > 0 || $quizzes->count() > 0 || $assignments->count() > 0) {
                $sectionsData[] = [
                    'section' => $section,
                    'lessons' => $lessons,
                    'quizzes' => $quizzes,
                    'assignments' => $assignments
                ];
            }
        }

        // جلب جميع الطلبة المشتركين في الكورس
        $enrolledStudents = Enrollment::where('course_id', $id)
            ->with('user')
            ->get()
            ->pluck('user')
            ->filter();

        $page_data = [
            'course' => $course,
            'sectionsData' => $sectionsData,
            'enrolledStudents' => $enrolledStudents
        ];

        return view('admin.course.student_views', $page_data);
    }
    public function getStudents(Request $request)
    {
        $courseId = $request->course_id;
        $itemId = $request->item_id;
        $itemType = $request->item_type;
        $showViewed = $request->show_viewed == 1;

        // جلب جميع الطلبة المشتركين
        $enrolledStudentIds = Enrollment::where('course_id', $courseId)
            ->pluck('user_id')
            ->toArray();

        $students = collect([]);

        if ($itemType === 'lesson') {
            // للدروس: استخدم watch_histories
            if ($showViewed) {
                // الطلبة اللي شاهدوا الدرس
                $watchedStudentIds = Watch_history::where('course_id', $courseId)
                    ->get()
                    ->filter(function($history) use ($itemId) {
                        $completedLessons = json_decode($history->completed_lesson, true) ?? [];
                        return in_array($itemId, $completedLessons);
                    })
                    ->pluck('student_id')
                    ->toArray();

                $students = User::whereIn('id', $watchedStudentIds)
                    ->whereIn('id', $enrolledStudentIds)
                    ->get();
            } else {
                // الطلبة اللي مشاهدوش الدرس
                $watchedStudentIds = Watch_history::where('course_id', $courseId)
                    ->get()
                    ->filter(function($history) use ($itemId) {
                        $completedLessons = json_decode($history->completed_lesson, true) ?? [];
                        return in_array($itemId, $completedLessons);
                    })
                    ->pluck('student_id')
                    ->toArray();

                $students = User::whereIn('id', $enrolledStudentIds)
                    ->whereNotIn('id', $watchedStudentIds)
                    ->get();
            }
        } elseif ($itemType === 'quiz') {
            // للاختبارات: استخدم quiz_submissions
            if ($showViewed) {
                // الطلبة اللي حلوا الاختبار
                $submittedStudentIds = QuizSubmission::where('quiz_id', $itemId)
                    ->pluck('user_id')
                    ->toArray();

                $students = User::whereIn('id', $submittedStudentIds)
                    ->whereIn('id', $enrolledStudentIds)
                    ->get();
            } else {
                // الطلبة اللي ما حلوش الاختبار
                $submittedStudentIds = QuizSubmission::where('quiz_id', $itemId)
                    ->pluck('user_id')
                    ->toArray();

                $students = User::whereIn('id', $enrolledStudentIds)
                    ->whereNotIn('id', $submittedStudentIds)
                    ->get();
            }
        } elseif ($itemType === 'assignment') {
            // للواجبات: استخدم quiz_submissions (الواجبات محفوظة كـ quiz في النظام)
            if ($showViewed) {
                // الطلبة اللي حلوا الواجب
                $submittedStudentIds = QuizSubmission::where('quiz_id', $itemId)
                    ->pluck('user_id')
                    ->toArray();

                $students = User::whereIn('id', $submittedStudentIds)
                    ->whereIn('id', $enrolledStudentIds)
                    ->get();
            } else {
                // الطلبة اللي ما حلوش الواجب
                $submittedStudentIds = QuizSubmission::where('quiz_id', $itemId)
                    ->pluck('user_id')
                    ->toArray();

                $students = User::whereIn('id', $enrolledStudentIds)
                    ->whereNotIn('id', $submittedStudentIds)
                    ->get();
            }
        }

        $html = '<div class="table-responsive"><table class="table table-hover">';
        $html .= '<thead><tr><th>#</th><th>' . get_phrase('الاسم') . '</th><th>' . get_phrase('البريد الإلكتروني') . '</th><th>' . get_phrase('الهاتف') . '</th></tr></thead>';
        $html .= '<tbody>';

        if ($students->count() > 0) {
            foreach ($students as $index => $student) {
                $html .= '<tr>';
                $html .= '<td>' . ($index + 1) . '</td>';
                $html .= '<td>' . htmlspecialchars($student->name) . '</td>';
                $html .= '<td>' . htmlspecialchars($student->email) . '</td>';
                $html .= '<td>' . htmlspecialchars($student->phone ?? '-') . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="4" class="text-center">' . get_phrase('لا توجد بيانات') . '</td></tr>';
        }

        $html .= '</tbody></table></div>';
        $html .= '<div class="mt-2"><strong>' . get_phrase('العدد الإجمالي') . ': ' . $students->count() . '</strong></div>';

        return $html;
    }

    public function getStudentsCount(Request $request)
    {
        $courseId = $request->course_id;
        $itemId = $request->item_id;
        $itemType = $request->item_type;

        $enrolledStudentIds = Enrollment::where('course_id', $courseId)
            ->pluck('user_id')
            ->toArray();

        $count = 0;

        if ($itemType === 'lesson') {
            $watchedStudentIds = Watch_history::where('course_id', $courseId)
                ->get()
                ->filter(function($history) use ($itemId) {
                    $completedLessons = json_decode($history->completed_lesson, true) ?? [];
                    return in_array($itemId, $completedLessons);
                })
                ->pluck('student_id')
                ->toArray();

            $count = User::whereIn('id', $watchedStudentIds)
                ->whereIn('id', $enrolledStudentIds)
                ->count();
        } elseif ($itemType === 'quiz' || $itemType === 'assignment') {
            $submittedStudentIds = QuizSubmission::where('quiz_id', $itemId)
                ->pluck('user_id')
                ->toArray();

            $count = User::whereIn('id', $submittedStudentIds)
                ->whereIn('id', $enrolledStudentIds)
                ->count();
        }

        return response()->json(['viewed_count' => $count]);
    }
}
