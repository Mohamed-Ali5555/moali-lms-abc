<?php

namespace Modules\Theme\App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DeviceIp;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\Category;
use App\Models\User;
use App\Models\FileUploader;
use Detection\MobileDetect;

class AuthController extends Controller
{

    public function show_login()
    {
        if (auth()->check()) {
            return redirect('/'); // or your home page
        }
        return view('theme::auth.login');
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower(request()->input('email')) . '|' . request()->ip());
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $input = $request->all();

        // dd($input) ;
        $request->authenticate();
        // $filter = filter_var($input['email'],FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // if (! Auth::attempt([$filter =>$input['email'],'password'=>$input['password']])) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'email' => trans('auth.failed'),
        //     ]);
        // }
        $request->session()->regenerate();
        // dd($input = $request->all());

        //Track device limitation
        // if (Auth::check() && auth()->user()->role != 'admin') {

        //     $user                     = Auth::user();
        //     $current_ip               = request()->getClientIp();
        //     $session_id               = $request->session()->getId();
        //     $user_agent               = request()->header('user-agent');
        //     $current_user_agent       = base64_encode($user->id . $user_agent);

        //     $allowed_devices          = auth()->user()->number_devices ?: get_settings('device_limitation') ?: 1;

        //     $logged_in_devices        = DeviceIp::where('user_id', $user->id)->get();
        //     $browser_name             = $this->extractBrowserName($user_agent);
        //     // device type
        //     $detect                   = new MobileDetect();
        //     $device_type              = $detect->isMobile() ? 'Mobile' : ($detect->isTablet() ? 'Tablet' : 'Desktop');


        //     $existing_device = DeviceIp::where('user_id', $user->id)
        //         ->where('user_agent', $current_user_agent)->where('device_type', $device_type)
        //         ->first();

        //     if ($existing_device && $existing_device->status == '0') {
        //         Auth::guard('web')->logout();
        //         $request->session()->invalidate();
        //         $request->session()->regenerateToken();
        //         Session::flash('error', 'تم حظر هذا الجهاز من تسجيل الدخول.');
        //         return redirect(route('theme.login'));
        //     }
        //     if ($logged_in_devices) {
        //         if ($logged_in_devices->where('user_agent', '!=', $current_user_agent)->count() < $allowed_devices) {
        //             if ($logged_in_devices->where('user_agent', $current_user_agent)->count() == 0) {
        //                 DeviceIp::insert([
        //                     'user_id'     => $user->id,
        //                     'ip_address'  => $current_ip,
        //                     'session_id'  => $session_id,
        //                     'user_agent'  => $current_user_agent,
        //                     'device_type' => $device_type,
        //                     'status'      => 1,
        //                     'browser_name' => $browser_name,
        //                 ]);
        //             } else {
        //                 DeviceIp::where('user_id', $user->id)->where('user_agent', $current_user_agent)->update([
        //                     'session_id' => $session_id,
        //                     'updated_at'    => date('Y-m-d H:i:s'),
        //                 ]);
        //             }
        //         } else {



        //             /// new i write
        //             $user_count = DeviceIp::where('user_id', $user->id)->count();
        //             if ($user_count >= $allowed_devices) {

        //                 Session::flash('error', 'you cant login you use all ways.');

        //                 Auth::guard('web')->logout();
        //                 $request->session()->invalidate();
        //                 $request->session()->regenerateToken();
        //                 return redirect(route('theme.login'));
        //             }
        //         }
        //     } else {
        //         DeviceIp::insert([
        //             'user_id'     => $user->id,
        //             'ip_address'  => $current_ip,
        //             'session_id'  => $session_id,
        //             'user_agent'  => $current_user_agent,
        //             'device_type' => $device_type,
        //             'status'      => 1,
        //             'browser_name' => $browser_name,
        //         ]);
        //     }
        // }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function show_register()
    {

        if (auth()->check()) {
            return redirect('/');
        }
        $categories = Category::where('parent_id', 0)->get();

        return view('theme::auth.register', compact('categories'));
    }


    public function register(Request $request)
    {
        $input = $request->all();



        $validator = Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'unique:users,email'],
            'phone'        => ['required', 'numeric', 'digits_between:10,14', 'different:parent_phone'],
            'parent_phone' => ['required', 'numeric', 'digits_between:10,14'],
            // 'national_id'  => ['required', 'numeric', 'digits:14', 'unique:users,national_id'],
            'category'     => ['required'],
            'gender'       => ['required'],
            // 'national_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:51200'],

            // 'address'      => ['required', 'string', 'max:255'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required'         => 'الاسم مطلوب.',

            'email.required'        => 'البريد الإلكتروني مطلوب.',
            'email.email'           => 'يجب إدخال بريد إلكتروني صحيح.',
            'email.unique'          => 'هذا البريد الإلكتروني مستخدم بالفعل.',

            'phone.required'        => 'رقم الهاتف مطلوب.',
            'phone.numeric'         => 'يجب أن يكون رقم الهاتف رقمًا.',
            'phone.digits_between'  => 'يجب أن يكون رقم الهاتف بين 10 و 14 رقمًا.',
            'phone.different'       => 'يجب أن يكون رقم الهاتف مختلفًا عن رقم ولي الأمر.',

            'parent_phone.required' => 'رقم هاتف ولي الأمر مطلوب.',
            'parent_phone.numeric'  => 'يجب أن يكون رقم هاتف ولي الأمر رقمًا.',
            'parent_phone.digits_between' => 'يجب أن يكون رقم هاتف ولي الأمر بين 10 و 14 رقمًا.',

            // 'national_id.required'  => 'الرقم القومي مطلوب.',
            // 'national_id.numeric'   => 'يجب أن يكون الرقم القومي رقمًا.',
            // 'national_id.digits'    => 'يجب أن يكون الرقم القومي مكونًا من 14 رقمًا.',
            // 'national_id.unique'    => 'هذا الرقم القومي مستخدم بالفعل.',

            'category.required'     => 'التصنيف مطلوب.',
            'gender.required'     => 'النوع مطلوب.',

            'password.required'     => 'كلمة المرور مطلوبة.',
            'password.confirmed'    => 'يجب تأكيد كلمة المرور.',
            // 'national_image.required' => 'صورة البطاقة مطلوبة.',
            // 'national_image.image'    => 'يجب أن يكون الملف صورة.',
            // 'national_image.mimes'    => 'يجب أن تكون الصورة بصيغة: jpeg, png, jpg, webp.',
            // 'national_image.max'      => 'أقصى حجم مسموح للصورة هو 50 ميجا.',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'parent_phone'  => $request->parent_phone,
            'national_id'   => null,
            'category'      => $request->category,
            'goverment'     => $request->goverment,
            // 'address'    => $request->address,
            'gender'        => $request->gender,

            'email_verified_at' => Carbon::now(),
            'role' => 'student',
            'status' => 1,
            'password' => Hash::make($request->password),
        ];

        // if (isset($request->national_image)) {
        //     $user_data['national_image'] = "uploads/user-national_image/" . nice_file_name($request->name, $request->national_image->extension());
        //     FileUploader::upload($request->national_image, $user_data['national_image'], 500, null, 200, 200);
        // }


        if (get_settings('student_email_verification') != 1) {
            $user_data['email_verified_at'] = Carbon::now();
        }

        $user = User::create($user_data);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    private function extractBrowserName($userAgent)
    {
        $browsers = [
            'Edge'       => 'Edg|Edge',
            'Chrome'     => 'Chrome',
            'Firefox'    => 'Firefox',
            'Safari'     => 'Safari',
            'Opera'      => 'Opera|OPR',
            'Internet Explorer' => 'MSIE|Trident',
        ];

        foreach ($browsers as $browser => $regex) {
            if (preg_match("/$regex/i", $userAgent)) {
                return $browser;
            }
        }

        return 'Unknown';
    }
}
