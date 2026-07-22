<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\FileUploader;
use App\Models\Payout;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\Message;
use App\Models\MessageThread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Watch_history;
use App\Models\QuizSubmission;
use App\Models\Payment_history;

class UsersController extends Controller
{

    public function admin_index(Request $request)
    {
        $query = User::where('role', 'admin');


        if(request()->filled('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search. '%');
            });
         }

        $page_data['admins'] = $query->paginate(10)->withQueryString();
        return view('admin.admin.index', $page_data);
    }

    public function student_not_enroll(Request $request){
        $activeCourses = Course::where('status', 'active')->pluck('id');
              $query = User::where('role', 'student')->whereDoesntHave('enrollments',function($q) use ($activeCourses){
                    $q->whereIn('course_id', $activeCourses);
                });

              if(request()->filled('search')){
                 $search = $request->search;
                 $query->where(function($q) use($search){
                     $q->where('name', 'LIKE', '%' . $search . '%')
                         ->orWhere('phone', 'LIKE', '%' . $search . '%')
                         ->orWhere('parent_phone', 'LIKE', '%' . $search . '%')
                        //  ->orWhere('national_id', 'LIKE', '%' . $search . '%')
                         ;

                 });
              }


         $users = $query ->get();
        return view('admin.student.student_not_enroll', compact('users'));
    }
    public function admin_create()
    {
        return view('admin.admin.create_admin');
    }
    public function admin_store(Request $request)
    {

        $validated = $request->validate([
            'name'     => "required",
            'email'    => 'required|email|unique:users',
            'password' => "required|min:8",
        ]);

        $data['name']     = $request->name;
        $data['phone']    = $request->phone;
        $data['address']  = $request->address;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);

        $data['role']     = 'admin';
        $data['status']     = '1';

        if (isset($request->photo) && $request->hasFile('photo')) {
            $path = "uploads/users/instructor/" . nice_file_name($request->name, $request->photo->extension());
            FileUploader::upload($request->photo, $path, 400, null, 200, 200);
            $data['photo'] = $path;
        }

        $done = User::insert($data);

        if ($done) {
            $admin_id = User::latest('id')->first();
            Permission::insert(['admin_id' => $admin_id->id]);
        }
        Session::flash('success', get_phrase('Admin add successfully'));
        return redirect()->route('admin.admins.index');
    }

    public function admin_edit($id)
    {
        $page_data['admin'] = User::where('id', $id)->first();
        return view('admin.admin.edit_admin', $page_data);
    }
    public function admin_update(Request $request, $id)
    {

        $validated = $request->validate([
            'name'  => 'required|max:255',
            'email' => "required|email|unique:users,email,$id",
        ]);

        $data['name']     = $request->name;
        $data['about']    = $request->about;
        $data['phone']    = $request->phone;
        $data['address']  = $request->address;
        $data['email']    = $request->email;
        $data['facebook'] = $request->facebook;
        $data['twitter']  = $request->twitter;
        $data['website']  = $request->website;
        $data['linkedin'] = $request->linkedin;
        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Old password does not match')->withInput();
            }
            $data['password']     = Hash::make($request->new_password);
        }
        if (isset($request->photo) && $request->hasFile('photo')) {
            remove_file(User::where('id', $id)->first()->photo);
            $path = "uploads/users/instructor/" . nice_file_name($request->name, $request->photo->extension());
            FileUploader::upload($request->photo, $path, 400, null, 200, 200);
            $data['photo'] = $path;
        }

        User::where('id', $request->id)->update($data);
        Session::flash('success', get_phrase('Admin update successfully'));
        return redirect()->route('admin.admins.index');
    }

    public function admin_delete($id)
    {
        $threads = MessageThread::where('contact_one', $id)
                    ->orWhere('contact_two', $id)
                    ->pluck('id');

        if ($threads->isNotEmpty()) {
            Message::whereIn('thread_id', $threads)->delete();
            MessageThread::whereIn('id', $threads)->delete();
        }

        $done = User::where('id', $id)->delete();
        if ($done) {
            Permission::where('admin_id', $id)->delete();
        }
        Session::flash('success', get_phrase('Admin delete successfully'));
        return redirect()->back();
    }

    public function admin_permission($user_id)
    {
        $page_data['admin'] = User::where('id', $user_id)->firstOrNew();
        return view('admin.admin.permission', $page_data);
    }
    public function admin_permission_store(Request $request)
    {
        $user_id = $request->user_id;

        $permission = Permission::where('admin_id', $user_id)->first();

        if ($permission) {
            $set_permission = json_decode($permission->permissions, true) ?? [];
            if (in_array($request->permission, $set_permission)) {
                $pos = array_search($request->permission, $set_permission);
                array_splice($set_permission, $pos, 1);
            } else {
                array_push($set_permission, $request->permission);
            }
            Permission::where('admin_id', $user_id)->update(['permissions' => $set_permission]);
            return true;
        } else {
            $set_per = json_encode([$request->permission]);
            Permission::insert(['admin_id' => $user_id, 'permissions' => $set_per]);
            return true;
        }
    }

    public function instructor_index(Request $request)
    {
        $query = User::where('role', 'instructor');
        if(request()->filled('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        $page_data['instructors'] = $query->paginate(10)->withQueryString();
        return view('admin.instructor.index', $page_data);
    }

    public function instructor_create()
    {
        return view('admin.instructor.create_instructor');
    }
    public function instructor_edit($id = '')
    {
        $page_data['instructor'] = User::where('id', $id)->first();
        return view('admin.instructor.edit_instructor', $page_data);
    }
    public function instructor_store(Request $request, $id = '')
    {
        $validated = $request->validate([
            'name'     => "required|max:255",
            'email'    => 'required|email|unique:users',
            'password' => "required|min:8",
        ]);

        if(get_settings('student_email_verification') != 1){
            $data['email_verified_at'] = date('Y-m-d H:i:s');
        }

        $data['name']        = $request->name;
        $data['about']       = $request->about;
        $data['phone']       = $request->phone;
        $data['address']     = $request->address;
        $data['email']       = $request->email;
        $data['facebook']    = $request->facebook;
        $data['twitter']     = $request->twitter;
        $data['website']     = $request->website;
        $data['linkedin']    = $request->linkedin;
        $data['paymentkeys'] = json_encode($request->paymentkeys);
        $data['status']     = '1';

        $data['password'] = Hash::make($request->password);
        $data['role']     = 'instructor';

        if (isset($request->photo) && $request->hasFile('photo')) {
            $path = "uploads/users/instructor/" . nice_file_name($request->name, $request->photo->extension());
            FileUploader::upload($request->photo, $path, 400, null, 200, 200);
            $data['photo'] = $path;
        }
        $user = User::create($data);

        if(get_settings('student_email_verification') == 1) {
            $user->sendEmailVerificationNotification();
        }

        Session::flash('success', get_phrase('Instructor add successfully'));

        return redirect()->route('admin.instructor.index');
    }

    public function instructor_update(Request $request, $id = '')
    {

        $validated = $request->validate([
            'name'  => 'required|max:255',
            'email' => "required|email|unique:users,email,$id",
        ]);

        $data['name']        = $request->name;
        $data['about']       = $request->about;
        $data['phone']       = $request->phone;
        $data['address']     = $request->address;
        $data['email']       = $request->email;
        $data['facebook']    = $request->facebook;
        $data['twitter']     = $request->twitter;
        $data['website']     = $request->website;
        $data['linkedin']    = $request->linkedin;
        $data['paymentkeys'] = json_encode($request->paymentkeys);

        if (isset($request->photo) && $request->hasFile('photo')) {
            remove_file(User::where('id', $id)->first()->photo);
            $path = "uploads/users/instructor/" . nice_file_name($request->name, $request->photo->extension());
            FileUploader::upload($request->photo, $path, 400, null, 200, 200);
            $data['photo'] = $path;
        }

        User::where('id', $id)->update($data);
        Session::flash('success', get_phrase('Instructor update successfully'));
        return redirect()->route('admin.instructor.index');
    }

    public function instructor_delete($id)
    {
        $threads = MessageThread::where('contact_one', $id)
                    ->orWhere('contact_two', $id)
                    ->pluck('id');

        if ($threads->isNotEmpty()) {
            Message::whereIn('thread_id', $threads)->delete();
            MessageThread::whereIn('id', $threads)->delete();
        }

        User::where('id', $id)->delete();
        Session::flash('success', get_phrase('Instructor delete successfully'));
        return redirect()->back();
    }

    public function instructor_view_course(Request $request)
    {
        $course = Course::where('user_id', $request->id)->get();
    }

    public function instructor_payout(Request $request)
    {
        $start_date                              = strtotime('first day of this month');
        $end_date                                = strtotime('last day of this month');
        $page_data['start_date']                 = $start_date;
        $page_data['end_date']                   = $end_date;
        $page_data['instructor_payout_complete'] = Payout::where('status', 1)->where('created_at', '>=', date('Y-m-d H:i:s', $start_date))
            ->where('created_at', '<=', date('Y-m-d H:i:s', $end_date))->paginate(10);
        $page_data['instructor_payout_incomplete'] = Payout::where('status', 0)->where('created_at', '>=', date('Y-m-d H:i:s', $start_date))
            ->where('created_at', '<=', date('Y-m-d H:i:s', $end_date))->paginate(10);
        return view('admin.instructor.payout', $page_data);
    }
    public function instructor_payout_filter(Request $request)
    {

        $date                    = explode('-', $request->eDateRange);
        $start_date              = strtotime($date[0] . ' 00:00:00');
        $end_date                = strtotime($date[1] . ' 23:59:59');
        $page_data['start_date'] = $start_date;
        $page_data['end_date']   = $end_date;

        $page_data['instructor_payout_complete'] = Payout::where('status', 1)->where('created_at', '>=', date('Y-m-d H:i:s', $start_date))
            ->where('created_at', '<=', date('Y-m-d H:i:s', $end_date))->paginate(10);
        $page_data['instructor_payout_incomplete'] = Payout::where('status', 0)->paginate(10);

        return view('admin.instructor.payout', $page_data);
    }

    public function instructor_payout_invoice($id = '')
    {
        if ($id != '') {
            $page_data['invoice_info'] = Payout::where('status', 1)->first();
            $page_data['invoice_data'] = Payout::where('status', 1)->get();
            $page_data['invoice_id']   = $id;

            return view('admin.instructor.instructor_invoice', $page_data);
        }
    }

    public function instructor_payment(Request $request)
    {
        $id              = $request->user_id;
        $payable_amount  = $request->amount;
        $start_timestamp = time();
        $end_timestamp   = time();

        $payment_details = [
            'items'          => [
                [
                    'id'                  => $id,
                    'title'               => get_phrase('Pay for instructor payout'),
                    'subtitle'            => get_phrase(''),
                    'price'               => $payable_amount,
                    'qty'                 => 1,
                    'discount_price'      => $payable_amount,
                    'discount_percentage' => 0,
                ],
            ],
            'custom_field'   => [
                'start_date' => date('Y-m-d H:i:s', $start_timestamp),
                'end_date'   => date('Y-m-d H:i:s', $end_timestamp),
                'user_id'    => auth()->user()->id,
                'payout_id'  => $request->payout_id,

            ],
            'success_method' => [
                'model_name'    => 'InstructorPayment',
                'function_name' => 'instructor_payment',
            ],
            'tax'            => 0,
            'coupon'         => null,
            'payable_amount' => $payable_amount,
            'cancel_url'     => route('admin.instructor.payout'),
            'success_url'    => route('payment.success'),
        ];
        session(['payment_details' => $payment_details]);
        return redirect()->route('payment');
    }

    public function instructor_setting()
    {
        $page_data['allow_instructor']   = Setting::where('type', 'allow_instructor')->first();
        $page_data['application_note']   = Setting::where('type', 'instructor_application_note')->first();
        $page_data['instructor_revenue'] = Setting::where('type', 'instructor_revenue')->first();
        return view('admin.instructor.instructor_setting', $page_data);
    }

    public function instructor_setting_store(Request $request)
    {

        if ($request->first == 'item_1') {

            $key_found = Setting::where('type', 'instructor_application_note')->exists();
            if ($key_found) {
                $data['description'] = $request->instructor_application_note;

                Setting::where('type', 'instructor_application_note')->update($data);
            } else {
                $data['type']        = 'instructor_application_note';
                $data['description'] = $request->instructor_application_note;

                Setting::insert($data);
            }

            $key_founds = Setting::where('type', 'allow_instructor')->exists();
            if ($key_founds) {
                $data['description'] = $request->allow_instructor;

                Setting::where('type', 'allow_instructor')->update($data);
            } else {

                $data['type']        = 'allow_instructor';
                $data['description'] = $request->allow_instructor;

                Setting::insert($data);
            }
        }
        if ($request->second == 'item_2') {

            $key_found = Setting::where('type', 'instructor_revenue')->exists();
            if ($key_found) {
                $data['description'] = $request->instructor_revenue;

                Setting::where('type', 'instructor_revenue')->update($data);
            } else {
                $data['type']        = 'instructor_revenue';
                $data['description'] = $request->instructor_revenue;

                Setting::insert($data);
            }
        }

        Session::flash('success', get_phrase('Instructor setting updated'));
        return redirect()->back();
    }

    public function instructor_application()
    {
        return view('admin.instructor.application');
    }
    public function instructor_application_approve($id)
    {
        $query         = Application::where('id', $id);
        $update_status = $query->update(['status' => 1]);
        if ($update_status) {
            $user_id = $query->first();
            User::where('id', $user_id->user_id)->update(['role' => 'instructor']);
            Session::flash('success', get_phrase('Application approve successfully'));
        }
        return redirect()->back();
    }
    public function instructor_application_delete($id)
    {
        Application::where('id', $id)->delete();
        Session::flash('success', get_phrase('Application delete successfully'));
        return redirect()->back();
    }
    public function instructor_application_download($id)
    {
        $path = Application::where('id', $id)->first();

        if (file_exists(public_path($path->document))) {
            return response()->download(public_path($path->document));
        } else {
            Session::flash('error', get_phrase('File does not exists'));
            return redirect()->back();
        }
    }

    public function student_index(Request $request)
    {
        $query = User::where('role', 'student');
        if(request()->filled('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->orWhere('parent_phone', 'LIKE', '%' . $search . '%')
                // ->orWhere('national_id', 'LIKE', '%' . $search. '%')
                ;
            });
        }

        if (request()->filled('source_category') && Category::where('id', $request->source_category)->exists()) {
            $query->where('category', $request->source_category);
        }

        $page_data['students'] = $query->paginate(10)->withQueryString();
        $page_data['categories'] = Category::where('parent_id', 0)->get();
        $page_data['selected_source_category'] = $request->source_category;

        return view('admin.student.index', $page_data);
    }

    public function student_move(Request $request)
    {
        $validated = $request->validate([
            'student_ids'           => 'nullable|array',
            'student_ids.*'         => 'integer|exists:users,id',
            'category'              => 'required|integer|exists:categories,id',
            'source_category'       => 'nullable|integer|exists:categories,id',
        ]);

        $targetCategory = Category::where('id', $request->category)->where('parent_id', 0)->first();
        if (!$targetCategory) {
            return back()->with('error', get_phrase('Please select a valid target category.'));
        }

        $sourceCategory = $request->source_category;
        $studentIds = $request->student_ids ?? [];

        if (empty($sourceCategory) && empty($studentIds)) {
            return back()->with('error', get_phrase('Please select at least one student or source category.'));
        }

        if (!empty($sourceCategory)) {
            if ($sourceCategory == $request->category) {
                return back()->with('error', get_phrase('Source and destination category must be different.'));
            }

            // جلب جميع طلاب الفئة المصدرة ما عدا الطلاب المختارين (للاستثناء)
            $query = User::where('role', 'student')->where('category', $sourceCategory);

            if (!empty($studentIds)) {
                // إذا تم اختيار طلاب معينين، استثنهم من النقل
                $query->whereNotIn('id', $studentIds);
            }

            $count = $query->count();
            $query->update(['category' => $request->category]);

            if (!empty($studentIds)) {
                $message = get_phrase('All students in the selected category were moved successfully except the selected ones.') . ' (' . $count . ')';
            } else {
                $message = get_phrase('All students in the selected category were moved successfully.') . ' (' . $count . ')';
            }
        } else {
            User::whereIn('id', $studentIds)
                ->where('role', 'student')
                ->update(['category' => $request->category]);

            $message = get_phrase('Selected students moved successfully.');
        }

        return redirect()->route('admin.student.index')->with('success', $message);
    }

    public function student_create()
    {
        $categories = Category::where('parent_id',0)->get();

        return view('admin.student.create_student',compact('categories'));
    }
    public function student_edit($id = '')
    {
        $categories = Category::where('parent_id',0)->get();
        $page_data['student'] = User::where('id', $id)->first();
        return view('admin.student.edit_student', $page_data,compact('categories'));
    }
    public function student_store(Request $request, $id = '')
    {

        $validated = $request->validate([
            'name'            => 'required|max:255',
            // 'national_id'     => 'required|numeric|digits:14|unique:users,national_id',
            'category'        => 'required',
            'goverment'       => 'required',
            'gender'          => 'required|in:1,2',
            'phone'           => ['required', 'numeric', 'digits_between:10,14', 'different:parent_phone'],
            'parent_phone'    => ['required' , 'numeric','digits_between:10,14'],
            'email'           => 'required|email|unique:users',
            'password'        => 'required',
        ]);

        if(get_settings('student_email_verification') != 1){
            $data['email_verified_at'] = date('Y-m-d H:i:s');
        }

        $data['name']            = $request->name;
        $data['phone']           = $request->phone;
        $data['parent_phone']    = $request->parent_phone;
        $data['category']        = $request->category;
        $data['goverment']       = $request->goverment;
        $data['national_id']     = null;
        $data['address']         = $request->address;
        $data['email']           = $request->email;
        $data['gender']          = $request->gender;

        $data['status']          = '1';

        $data['password'] = Hash::make($request->password);
        $data['role']     = 'student';

       if ($request->photo) {

            $data['photo'] = "uploads/users/student/" . nice_file_name($request->name, $request->photo->extension());
            FileUploader::upload($request->photo, $data['photo'], 400, null, 200, 200);
        }
        $user = User::create($data);

        if(get_settings('student_email_verification') == 1) {
            $user->sendEmailVerificationNotification();
        }

        Session::flash('success', get_phrase('Student add successfully'));

        return redirect()->route('admin.student.index');
    }

    public function student_update(Request $request, $id = '')
    {
        $validated = $request->validate([
            'name'             => 'required|max:255',
            // 'national_id'      => "required|numeric|digits:14|unique:users,national_id,$id",
            'category'         => 'required',
            'goverment'        => 'required',
            'phone'            => 'required|min:11',
            'parent_phone'     => 'required|min:11',
            'email'            => "required|email|unique:users,email,$id",
            'gender'          => 'required|in:1,2',
            // 'old_password'    => 'required_with:new_password',
            'new_password'    => 'nullable',
        ]);
       $user = User::find($id);

        $data['name']            = $request->name;
        $data['phone']           = $request->phone;
        $data['parent_phone']    = $request->parent_phone;
        $data['category']        = $request->category;
        $data['goverment']       = $request->goverment;
        $data['national_id']     = null;
        $data['address']         = $request->address;
        $data['email']           = $request->email;
        $data['gender']          = $request->gender;

        if ($request->filled('new_password')) {
            // if (!Hash::check($request->old_password, $user->password)) {
            //     return redirect()->back()->with('error', 'Old password does not match')->withInput();
            // }
            $data['password']     = Hash::make($request->new_password);
        }
        if (isset($request->photo) && $request->hasFile('photo')) {
                $user = User::find($id);
                if ($user && $user->photo && file_exists(public_path($user->photo))) {
                    unlink(public_path($user->photo));
                }
            $path = "uploads/users/student/" . nice_file_name($request->name, $request->photo->extension());
            FileUploader::upload($request->photo, $path, 400, null, 200, 200);
            $data['photo'] = $path;
        }

        $user->update($data);
        Session::flash('success', get_phrase('Student update successfully'));
        return redirect()->route('admin.student.index');
    }

    public function student_delete($id)
    {
        $threads = MessageThread::where('contact_one', $id)
                    ->orWhere('contact_two', $id)
                    ->pluck('id');

        if ($threads->isNotEmpty()) {
            Message::whereIn('thread_id', $threads)->delete();
            MessageThread::whereIn('id', $threads)->delete();
        }

        $query = User::find($id);
        if ($query && $query->photo && file_exists(public_path($query->photo))) {
            unlink(public_path($query->photo));
        }

        Enrollment::where('user_id',$id)->delete();

        $query->delete();
        return redirect(route('admin.student.index'))->with('success', 'تم حذف الطالب بنجاح');
    }

    public function student_delete_remove_device($id)
    {
        $query = User::where('id', $id)->first();
        $query->current_device_id = null;
        $query->save();
        return redirect(route('admin.student.index'))->with('success', 'تم مسح الجهاز المسجل به بنجاح');
    }


    public function view_course($id)
    {
        $courses = Enrollment::where('user_id',$id)->with('course')->get();
        // return $courses;
        return view('admin.student.view_course',compact('courses'));
    }
    public function student_enrol()
    {
        return view('admin.enroll.course_enrollment');
    }
    public function student_get(Request $request)
    {

        $user = User::where('role', 'student')->where('name', 'LIKE', '%' . $request->searchVal . '%')->get();

        foreach ($user as $row) {
            $response[] = ['id' => $row->id, 'text' => $row->name];
        }
        return json_encode($response);
    }

    // public function student_post(Request $request)
    // {
    //     $message = [];
    //     for ($i = 0; $i < count($request->user_id); $i++) {
    //         for ($j = 0; $j < count($request->course_id); $j++) {
    //             $data['user_id']    = $request->user_id[$i];
    //             $data['course_id']  = $request->course_id[$j];
    //             $data['entry_date'] = time();

    //             $course_details = $course_details = get_course_info($request->course_id[$j]);

    //             if ($course_details->expiry_period > 0) {
    //                 $days = $course_details->expiry_period * 30;
    //                 $data['expiry_date'] = strtotime("+" . $days . " days");
    //             } else {
    //                 $data['expiry_date'] = null;
    //             }

    //             $user  = Enrollment::where('user_id', $request->user_id[$i])->where('course_id', $request->course_id[$j])->exists();
    //             if (!$user) {

    //                 Enrollment::insert($data);
    //             }else{
    //                 return back()->with('error', $request->user_id[$i] . 'student is alreedy added to this course');
    //             }
    //         }
    //     }

    //     Session::flash('success', get_phrase('Student add successfully'));
    //     return redirect()->route('admin.enroll.history');
    // }

    public function student_post(Request $request)
    {
        $messages = [];

        for ($i = 0; $i < count($request->user_id); $i++) {
            for ($j = 0; $j < count($request->course_id); $j++) {
                $data['user_id']    = $request->user_id[$i];
                $data['course_id']  = $request->course_id[$j];
                $data['entry_date'] = time();

                $course_details = get_course_info($request->course_id[$j]);

                if ($course_details->expiry_period > 0) {
                    $days = $course_details->expiry_period * 30;
                    $data['expiry_date'] = strtotime("+" . $days . " days");
                } else {
                    $data['expiry_date'] = null;
                }

                $exists = Enrollment::where('user_id', $request->user_id[$i])
                    ->where('course_id', $request->course_id[$j])
                    ->exists();

                if (!$exists) {
                    Enrollment::insert($data);
                } else {
                    $userName   = User::find($request->user_id[$i])->name ?? $request->user_id[$i];
                    $courseName = $course_details->title ?? $request->course_id[$j];

                    $messages[] = "الطالب {$userName} مسجل بالفعل في كورس {$courseName}";
                }
            }
        }

        if (!empty($messages)) {
            return back()->with('error', implode(' | ', $messages));
        }

        Session::flash('success', get_phrase('Student add successfully'));
        return redirect()->route('admin.enroll.history');
    }


    public function enroll_history(Request $request)
    {
        $query = Enrollment::with('users');
        if($request->has('id')){
            $query->where('course_id',$request->id);
        }

        if ($request->eDateRange) {
            $date                        = explode('-', $request->eDateRange);
            $start_date                  = strtotime($date[0] . ' 00:00:00');
            $end_date                    = strtotime($date[1] . ' 23:59:59');
            $page_data['start_date']     = $start_date;
            $page_data['end_date']       = $end_date;
            $page_data['enroll_history'] = $query->where('entry_date', '>=', $start_date)
                ->where('entry_date', '<=', $end_date)
                ->paginate(10)->appends($request->query());
        } else {
            $start_date                  = strtotime('first day of this month ');
            $end_date                    = strtotime('last day of this month');
            $page_data['start_date']     = $start_date;
            $page_data['end_date']       = $end_date;
            $page_data['enroll_history'] = $query->where('entry_date', '>=', $start_date)
                ->where('entry_date', '<=', $end_date)->paginate(10);
        }
        return view('admin.enroll.enroll_history', $page_data);
    }



    public function enroll_history_delete($id)
    {
        $enroll = Enrollment::where('id', $id)->first();
        // dd($enroll->user_id);
        if($enroll){
           $paymentHistoryId = $enroll->payment_history_id;

            Watch_history::where(['student_id'=>$enroll->user_id,'course_id'=>$enroll->course_id])->delete();

            QuizSubmission::where('user_id',$enroll->user_id)->whereHas('lesson',function($q) use($enroll){
                $q->where('course_id',$enroll->course_id);
            })->delete();


              $enroll->delete();

           if ($paymentHistoryId) {
                $paymentHistory = Payment_history::with('items')->find($paymentHistoryId);

                if ($paymentHistory) {
                    $paymentHistory->items()
                        ->where('productable_type', 'App\Models\Course')
                        ->where('productable_id', $enroll->course_id)
                        ->delete();

                    if ($paymentHistory->items()->count() == 0) {
                        $paymentHistory->delete();
                    }
                }
        }
        }
        Session::flash('success', get_phrase('Enroll delete successfully'));
        return redirect()->back();
    }

    public function manage_profile()
    {
        return view('admin.profile.index');
    }
    public function manage_profile_update(Request $request)
    {
        if ($request->type == 'general') {
            $profile['name']      = $request->name;
            $profile['email']     = $request->email;
            $profile['facebook']  = $request->facebook;
            $profile['linkedin']  = $request->linkedin;
            $profile['twitter']  = $request->twitter;
            $profile['about']     = $request->about;
            $profile['skills']    = $request->skills;
            $profile['biography'] = $request->biography;

            if ($request->photo) {
                if (isset($request->photo) && $request->photo != '') {
                    $profile['photo'] = "uploads/users/admin/" . nice_file_name($request->title, $request->photo->extension());
                    FileUploader::upload($request->photo, $profile['photo'], 400, null, 200, 200);
                }
            }
            User::where('id', auth()->user()->id)->update($profile);
        } else {
            $old_pass_check = Auth::attempt(['email' => auth()->user()->email, 'password' => $request->current_password]);

            if (!$old_pass_check) {
                Session::flash('error', get_phrase('Current password wrong.'));
                return redirect()->back();
            }

            if ($request->new_password != $request->confirm_password) {
                Session::flash('error', get_phrase('Confirm password not same'));
                return redirect()->back();
            }

            $password = Hash::make($request->new_password);
            User::where('id', auth()->user()->id)->update(['password' => $password]);
        }
        Session::flash('success', get_phrase('Your changes has been saved.'));
        return redirect()->back();
    }
}
