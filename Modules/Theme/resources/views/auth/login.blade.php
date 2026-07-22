@extends('theme::layouts.master')
@section('content')
    <div class="main_content" dir="rtl">
        <div class="container" style="height: 100vh;display: flex;align-items: center;justify-content: center;">
            <div class="row login w-100">
                <div class="col-lg-5">
                    <div class="login-image ">
                        <img src="{{ asset('modules/theme/images/login.svg') }}" alt="register-icon" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="login-form-header login-header">
                        <div class="login-form-header-title">
                            <span>تسجيل</span>
                            <span>الدخول</span>
                        </div>
                        {{-- <span class="login-form-header-image">
                            <img src="{{ url('modules/theme/images/register.svg') }}" alt="register-icon" />
                        </span> --}}
                    </div>
                    <div class="login-form-header-body">
                        <p>
                            ادخل علي حسابك بإدخال رقم الهاتف و كلمة المرور المسجل بهم من قبل
                        </p>
                    </div>
                    <div class="form-content mt-4">
                        <form action="{{ route('theme.login') }}" class="global-form login-form mt-25" id="login-form"
                            method="POST">
                            @csrf
                            <h4 class="g-title">تسجيل الدخول</h4>
                            <div class="row">
                                <div class="col-md-12 my-3 email_content">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="text" id="email" name="email" />

                                        <label for="email">
                                            <span class="label-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="iconify iconify--ant-design" width="1em"
                                                    height="1em" preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 1024 1024">
                                                    <path fill="currentColor"
                                                        d="M885.6 230.2L779.1 123.8a80.83 80.83 0 0 0-57.3-23.8c-21.7 0-42.1 8.5-57.4 23.8L549.8 238.4a80.83 80.83 0 0 0-23.8 57.3c0 21.7 8.5 42.1 23.8 57.4l83.8 83.8A393.8 393.8 0 0 1 553.1 553A395.3 395.3 0 0 1 437 633.8L353.2 550a80.83 80.83 0 0 0-57.3-23.8c-21.7 0-42.1 8.5-57.4 23.8L123.8 664.5a80.9 80.9 0 0 0-23.8 57.4c0 21.7 8.5 42.1 23.8 57.4l106.3 106.3c24.4 24.5 58.1 38.4 92.7 38.4c7.3 0 14.3-.6 21.2-1.8c134.8-22.2 268.5-93.9 376.4-201.7C828.2 612.8 899.8 479.2 922.3 344c6.8-41.3-6.9-83.8-36.7-113.8">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span>رقم الهاتف</span>
                                        </label>
                                    </div>
                                </div>



                                <div class="col-md-12 my-3 email_content">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="password" id="password" name="password" />

                                        <label for="password">
                                            <span class="label-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="iconify iconify--ri" width="1em" height="1em"
                                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0zm-2 0V7a4 4 0 0 0-8 0v1zm-5 6v2h2v-2zm-4 0v2h2v-2zm8 0v2h2v-2z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span>كلمة السر</span>
                                        </label>
                                    </div>
                                </div>



                                <div class="form-group mb-25 d-flex justify-content-between align-items-center remember-me">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                            checked>
                                        <label class="form-check-label"
                                            for="flexCheckChecked">{{ get_phrase('Remember Me') }}</label>
                                    </div>
                                    <a href="{{ route('theme.password.request') }}">{{ get_phrase('Forget Password?') }}</a>
                                </div>

                                @if (get_frontend_settings('recaptcha_status'))
                                    <button class="eBtn gradient w-100 g-recaptcha"
                                        data-sitekey="{{ get_frontend_settings('recaptcha_sitekey') }}"
                                        data-callback='onLoginSubmit'
                                        data-action='submit'>{{ get_phrase('Login') }}</button>
                                @else
                                    <button type="submit" class="eBtn gradient w-100">تسجيل الدخول</button>
                                @endif


                            </div>
                            {{-- <p class="my-3">Login As -</p>
                                        <button type="button" class="eBtn gradient w-100 mb-3 py-3 custom-btn" id="admin">Admin</button>
                                        <button type="button" class="eBtn gradient w-100 mb-3 py-3 custom-btn" id="student">Student</button>
                                        <button type="button" class="eBtn gradient w-100 mb-3 py-3 custom-btn" id="instructor">Instructor</button> --}}
                        </form>
                    </div>
                    <div class="login-link mt-4" style="color: #6b7280">
                        <span>لا يوجد لديك حساب؟</span>
                        <a href="{{ route('theme.show_register') }}" style="color: #2072b7">
                            انشئ حسابك الآن !</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="dna-loader-3d dna-2" style="--count:30;">
        <div class="orbit" style="--i:1;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:2;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:3;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:4;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:5;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:6;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:7;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:8;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:9;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:10;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:11;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:12;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:13;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:14;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:15;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:16;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:17;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:18;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:19;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:20;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:21;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:22;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:23;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:24;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:25;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:26;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:27;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:28;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:29;">
            <div class="ball"></div>
        </div>
        <div class="orbit" style="--i:30;">
            <div class="ball"></div>
        </div>
    </div> --}}
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            let device = localStorage.getItem("device");
            console.log(device)
            $('#device').attr("value", device)
        });
    </script>
@endsection
@push('js')
    <script>
        "use strict";

        $(document).ready(function() {
            $('.custom-btn').on('click', function(e) {
                e.preventDefault();

                var role = $(this).attr('id');
                if (role == 'admin') {
                    $('#email').val('admin@example.com');
                    $('#password').val('12345678');
                } else if (role == 'student') {
                    $('#email').val('student@example.com');
                    $('#password').val('12345678');
                } else {
                    $('#email').val('instructor@example.com');
                    $('#password').val('12345678');
                }
                $('#login').trigger('click');
            });
        });

        $(document).ready(function() {
            $('#showpassword').on('click', function(e) {
                e.preventDefault();
                const type = $('#password').attr('type');

                if (type == 'password') {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });

        function onLoginSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script>
@endpush
