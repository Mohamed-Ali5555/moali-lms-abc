@extends('theme::layouts.master')
@section('content')
    <div class="main_content" dir="rtl">
        <div class="container" style="display: flex;align-items: center;justify-content: center;">
            <div class="row register w-100">
                <div class="col-lg-5">
                    <div class="signup-image" style="height: 100%;display: flex;align-items: center;justify-content: center;">
                        <img src="{{ asset('modules/theme/images/signup.svg') }}" alt="register-icon" />
                    </div>





                    <div class="animated__corona corona-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" width="75px" height="75px">
                            <circle cx="64" cy="64" r="46.7" fill="#bde5ec"></circle>
                            <circle cx="64" cy="64" r="35" fill="#f7f7eb"></circle>
                            <path fill="#e44450"
                                d="M67.7 3.1c1.4.5 1.9 1 2 1.5 0 .5-.2 1-.8 1.5-.5.5-1.2 1-1.5 1.5-.4.4-.4.9-.5 1.4-.4 2-.7 4-1 5.9-.3 2-.5 4-.6 5.9-.1 2-.2 4 0 5.9.1.7-.5 1.3-1.2 1.4-.7.1-1.3-.5-1.4-1.2v-.2c.1-2 .1-4 0-5.9-.1-2-.3-4-.6-5.9-.3-2-.6-4-1-5.9-.1-.5-.1-1-.5-1.5s-1-1-1.5-1.5-.8-1-.8-1.5c.1-.5.6-1 2-1.5 2.6-.7 5.1-.7 7.4.1zm56.2 64.6c-.5 1.4-1 1.9-1.5 2-.5 0-1-.2-1.5-.8-.5-.5-1-1.2-1.5-1.5-.5-.4-1-.4-1.5-.5-2-.4-4-.7-5.9-1-2-.3-4-.5-5.9-.6-2-.1-4-.2-5.9 0-.7.1-1.3-.5-1.4-1.2-.1-.7.5-1.3 1.2-1.4h.2c2 .1 4 .1 5.9 0 2-.1 4-.3 5.9-.6 2-.3 4-.6 5.9-1 .5-.1 1-.1 1.5-.5s1-1 1.5-1.5 1-.8 1.5-.8c.5.1 1 .6 1.5 2 .8 2.6.8 5.1 0 7.4zm-64.6 56.2c-1.4-.5-1.9-1-2-1.5 0-.5.2-1 .8-1.5.5-.5 1.2-1 1.5-1.5.4-.5.4-1 .5-1.5.4-2 .7-4 1-5.9.3-2 .5-4 .6-5.9.1-2 .2-4 0-5.9-.1-.7.5-1.3 1.2-1.4.7-.1 1.3.5 1.4 1.2v.2c-.1 2-.1 4 0 5.9.1 2 .3 4 .6 5.9.3 2 .6 4 1 5.9.1.5.1 1 .5 1.5s1 1 1.5 1.5.8 1 .8 1.5c-.1.5-.6 1-2 1.5-2.6.8-5.1.8-7.4 0zM3.1 59.3c.5-1.4 1-1.9 1.5-2 .5 0 1 .2 1.5.8.5.5 1 1.2 1.5 1.5.4.4.9.4 1.4.5 2 .4 4 .7 5.9 1 2 .3 4 .5 5.9.6 2 .1 4 .2 5.9 0 .7-.1 1.3.5 1.4 1.2.1.7-.5 1.3-1.2 1.4h-.2c-2-.1-4-.1-5.9 0-2 .1-4 .3-5.9.6-2 .3-4 .6-5.9 1-.5.1-1 .1-1.5.5s-1 1-1.5 1.5-1 .8-1.5.8c-.5-.1-1-.6-1.5-2-.7-2.6-.7-5.1.1-7.4zM36.9 9.1c1.5-.3 2.2-.1 2.5.3.3.4.3 1 .1 1.7-.2.7-.5 1.4-.6 2.1-.1.6.2 1 .3 1.5.7 1.9 1.4 3.8 2.1 5.6.8 1.8 1.6 3.7 2.5 5.4.9 1.8 1.8 3.5 3 5.1.4.6.2 1.4-.3 1.8-.6.4-1.4.2-1.8-.3 0-.1-.1-.1-.1-.2-.9-1.8-1.9-3.5-3-5.1-1.1-1.7-2.2-3.3-3.5-4.8-1.2-1.6-2.5-3.1-3.8-4.7-.3-.4-.6-.8-1.2-1-.6-.2-1.4-.3-2.1-.5-.7-.2-1.2-.5-1.4-.9-.2-.5 0-1.1 1-2.3 1.7-2 4-3.2 6.3-3.7zm81 27.8c.3 1.5.1 2.2-.3 2.5-.4.3-1 .3-1.7.1-.7-.2-1.4-.5-2.1-.6-.6-.1-1 .2-1.5.3-1.9.7-3.8 1.4-5.6 2.1-1.8.8-3.7 1.6-5.4 2.5-1.8.9-3.5 1.8-5.1 3-.6.4-1.4.2-1.8-.3-.4-.6-.2-1.4.3-1.8.1 0 .1-.1.2-.1 1.8-.9 3.5-1.9 5.1-3 1.7-1.1 3.3-2.2 4.8-3.5 1.6-1.2 3.1-2.5 4.7-3.8.4-.3.8-.6 1-1.2.2-.6.3-1.4.5-2.1.2-.7.5-1.2.9-1.4.5-.2 1.1 0 2.3 1 2 1.7 3.2 4 3.7 6.3zm-27.8 81c-1.5.3-2.2.1-2.5-.3-.3-.4-.3-1-.1-1.7.2-.7.5-1.4.6-2.1.1-.6-.2-1-.3-1.5-.7-1.9-1.4-3.8-2.1-5.6-.8-1.8-1.6-3.7-2.5-5.4-.9-1.8-1.8-3.5-3-5.1-.4-.6-.2-1.4.3-1.8s1.4-.2 1.8.3c0 .1.1.1.1.2.9 1.8 1.9 3.5 3 5.1 1.1 1.7 2.2 3.3 3.5 4.8 1.2 1.6 2.5 3.1 3.8 4.7.3.4.6.8 1.2 1 .6.2 1.4.3 2.1.5.7.2 1.2.5 1.4.9.2.5 0 1.1-1 2.3-1.7 2-4 3.2-6.3 3.7zm-81-27.8c-.3-1.5-.1-2.2.3-2.5.4-.3 1-.3 1.7-.1.7.2 1.4.5 2.1.6.6.1 1-.2 1.5-.3 1.9-.7 3.8-1.4 5.6-2.1 1.8-.8 3.7-1.6 5.4-2.5 1.8-.9 3.5-1.8 5.1-3 .6-.4 1.4-.2 1.8.3s.2 1.4-.3 1.8c-.1 0-.1.1-.2.1-1.8.9-3.5 1.9-5.1 3-1.7 1.1-3.3 2.2-4.8 3.5-1.6 1.2-3.1 2.5-4.7 3.8-.4.3-.8.6-1 1.2-.2.6-.3 1.4-.5 2.1-.2.7-.5 1.2-.9 1.4-.5.2-1.1 0-2.3-1-2-1.7-3.2-4-3.7-6.3zm4.2-60.4c1.1-1 1.8-1.2 2.3-1 .5.2.7.7.9 1.4.2.7.3 1.5.5 2.1.2.6.7.8 1 1.2 1.5 1.3 3.1 2.6 4.7 3.8 1.6 1.2 3.2 2.4 4.8 3.5 1.7 1.1 3.3 2.1 5.1 3 .6.3.9 1.1.6 1.7-.3.6-1.1.9-1.7.6-.1 0-.1-.1-.2-.1-1.6-1.1-3.4-2.1-5.1-3-1.8-.9-3.6-1.7-5.4-2.5-1.8-.8-3.7-1.5-5.6-2.1-.5-.2-.9-.4-1.5-.3-.6.1-1.4.4-2.1.6-.7.2-1.3.2-1.7-.1-.4-.3-.6-1-.3-2.5.6-2.6 1.9-4.8 3.7-6.3zm84-16.4c1 1.1 1.2 1.8 1 2.3-.2.5-.7.7-1.4.9-.7.2-1.5.3-2.1.5-.6.2-.8.7-1.2 1-1.3 1.5-2.6 3.1-3.8 4.7-1.2 1.6-2.4 3.2-3.5 4.8-1.1 1.7-2.1 3.3-3 5.1-.3.6-1.1.9-1.7.6-.6-.3-.9-1.1-.6-1.7 0-.1.1-.1.1-.2 1.1-1.6 2.1-3.4 3-5.1.9-1.8 1.7-3.6 2.5-5.4.8-1.8 1.5-3.7 2.1-5.6.2-.5.4-.9.3-1.5-.1-.6-.4-1.4-.6-2.1-.2-.7-.2-1.3.1-1.7.3-.4 1-.6 2.5-.3 2.6.6 4.8 1.9 6.3 3.7zm16.4 84c-1.1 1-1.8 1.2-2.3 1-.5-.2-.7-.7-.9-1.4-.2-.7-.3-1.5-.5-2.1-.2-.6-.7-.8-1-1.2-1.5-1.3-3.1-2.6-4.7-3.8-1.6-1.2-3.2-2.4-4.8-3.5-1.7-1.1-3.3-2.1-5.1-3-.6-.3-.9-1.1-.6-1.7s1.1-.9 1.7-.6c.1 0 .1.1.2.1 1.6 1.1 3.4 2.1 5.1 3 1.8.9 3.6 1.7 5.4 2.5 1.8.8 3.7 1.5 5.6 2.1.5.2.9.4 1.5.3.6-.1 1.4-.4 2.1-.6.7-.2 1.3-.2 1.7.1.4.3.6 1 .3 2.5-.6 2.6-1.9 4.8-3.7 6.3zm-84 16.4c-1-1.1-1.2-1.8-1-2.3.2-.5.7-.7 1.4-.9.7-.2 1.5-.3 2.1-.5.6-.2.8-.7 1.2-1 1.3-1.5 2.6-3.1 3.8-4.7 1.2-1.6 2.4-3.2 3.5-4.8 1.1-1.7 2.1-3.3 3-5.1.3-.6 1.1-.9 1.7-.6s.9 1.1.6 1.7c0 .1-.1.1-.1.2-1.1 1.6-2.1 3.4-3 5.1-.9 1.8-1.7 3.6-2.5 5.4-.8 1.8-1.5 3.7-2.1 5.6-.2.5-.4.9-.3 1.5.1.6.4 1.4.6 2.1.2.7.2 1.3-.1 1.7-.3.4-1 .6-2.5.3-2.6-.6-4.8-1.9-6.3-3.7z">
                            </path>
                            <path fill="#2652e4"
                                d="M71.8 28.5c.5-.9.9-1.9 1.2-2.8.3-1 .5-1.9.7-2.9.1-1 .1-2.1 0-3.1 0-.5 0-1 .1-1.5s0-1 .9-1.3c1.2-.3 2.5 0 3.3.9.7.7.3 1.1.2 1.6-.2.5-.4.9-.7 1.4-.5.9-1.1 1.8-1.5 2.7-.4.9-.6 1.9-.9 2.9-.2 1-.4 2-.3 3 0 .9-.7 1.6-1.6 1.6s-1.6-.7-1.6-1.6c-.1-.3 0-.6.2-.9zM55.3 99.3c-.6.9-.9 1.8-1.3 2.8-.3 1-.6 1.9-.8 2.9-.2 1-.1 2.1-.1 3.1 0 .5 0 1-.1 1.5s0 1-1 1.3c-1.2.3-2.5-.1-3.3-1-.7-.7-.3-1.1-.1-1.6.2-.5.5-.9.7-1.4.6-.9 1.2-1.8 1.6-2.7.4-.9.7-1.9.9-2.9.2-1 .4-2 .4-3 0-.9.7-1.6 1.6-1.6.9 0 1.6.7 1.6 1.6.1.5 0 .8-.1 1zm43.4-27.1c.9.5 1.9.9 2.8 1.2 1 .3 1.9.5 2.9.7 1 .1 2.1.1 3.1 0 .5 0 1 0 1.5.1s1 0 1.3.9c.3 1.2 0 2.5-.9 3.3-.7.7-1.1.3-1.6.2-.5-.2-.9-.4-1.4-.7-.9-.5-1.8-1.1-2.7-1.5-.9-.4-1.9-.6-2.9-.9-1-.2-2-.4-3-.3-.9 0-1.6-.7-1.6-1.6 0-.9.7-1.6 1.6-1.6.4 0 .7.1.9.2zM28 55.8c-.9-.6-1.8-.9-2.8-1.3-1-.3-1.9-.6-2.9-.8-1-.2-2.1-.1-3.1-.1-.5 0-1 0-1.5-.1s-1 0-1.3-1c-.3-1.2.1-2.5 1-3.3.7-.7 1.1-.3 1.6-.1.5.2.9.5 1.4.7.9.6 1.8 1.2 2.7 1.6.9.4 1.9.7 2.9.9 1 .2 2 .4 3 .4.9 0 1.6.7 1.6 1.6s-.9 1.7-1.8 1.7c-.3 0-.6-.1-.8-.2zm70.2-2.4c1 0 2-.2 3-.4s1.9-.5 2.9-.9c.9-.4 1.8-1 2.7-1.5.4-.3.9-.5 1.4-.7.5-.2.9-.5 1.6.2.9.9 1.2 2.2.9 3.3-.3 1-.8.9-1.3 1-.5.1-1 .1-1.5.1-1 0-2.1-.1-3.1.1s-2 .4-2.9.7c-1 .3-1.9.7-2.8 1.2-.8.5-1.7.2-2.2-.5-.5-.8-.2-1.7.5-2.2.2-.3.5-.4.8-.4zM28.7 74.6c-1 0-2.1.1-3 .3-1 .2-2 .5-2.9.8-1 .3-1.8.9-2.8 1.4-.5.3-.9.5-1.4.7-.5.2-.9.5-1.6-.2-.9-.9-1.1-2.2-.8-3.3.3-1 .8-.8 1.3-.9.5-.1 1-.1 1.5 0 1 0 2.1.1 3.1 0s2-.3 3-.6 1.9-.6 2.8-1.1c.8-.4 1.7-.2 2.2.6.4.8.2 1.7-.6 2.2-.3 0-.6.1-.8.1zm45.1 24c0 1 .2 2 .4 3s.5 1.9.9 2.9c.4.9 1 1.8 1.5 2.7.3.4.5.9.7 1.4.2.5.5.9-.2 1.6-.9.9-2.2 1.2-3.3.9-1-.3-.9-.8-1-1.3-.1-.5-.1-1-.1-1.5 0-1 .1-2.1-.1-3.1s-.4-2-.7-2.9c-.3-1-.7-1.9-1.2-2.8-.5-.8-.2-1.7.5-2.2s1.7-.2 2.2.5c.4.3.4.5.4.8zM52.7 29.1c0-1-.1-2.1-.3-3-.2-1-.5-2-.8-2.9-.3-1-.9-1.8-1.4-2.8-.3-.5-.5-.9-.7-1.4-.2-.5-.5-.9.2-1.6.9-.9 2.2-1.1 3.3-.8 1 .3.8.8.9 1.3.1.5.1 1 0 1.5 0 1-.1 2.1 0 3.1s.3 2 .6 3 .6 1.9 1.1 2.8c.4.8.2 1.7-.6 2.2-.8.4-1.7.2-2.2-.6-.1-.2-.1-.5-.1-.8zm35.6 8.3c.9-.5 1.7-1.2 2.4-1.8.7-.7 1.4-1.4 2.1-2.2.6-.8 1.1-1.8 1.6-2.7.3-.5.5-.9.8-1.3.3-.4.5-.9 1.5-.7 1.2.3 2.1 1.3 2.4 2.4.3 1-.3 1.2-.7 1.5-.4.3-.8.6-1.3.8-.9.5-1.9 1-2.7 1.6-.8.6-1.5 1.3-2.2 2.1-.7.8-1.3 1.5-1.8 2.5-.4.8-1.4 1-2.2.6-.8-.4-1-1.4-.6-2.2.2-.2.5-.4.7-.6zM38.7 90.5c-.9.5-1.7 1.1-2.5 1.8s-1.5 1.4-2.1 2.2c-.7.8-1.1 1.7-1.7 2.6-.3.4-.5.9-.9 1.3-.3.3-.5.8-1.5.6-1.2-.3-2.1-1.3-2.4-2.5-.2-1 .3-1.1.7-1.5.4-.3.9-.6 1.3-.8.9-.5 1.9-.9 2.7-1.5.8-.6 1.5-1.3 2.3-2 .7-.7 1.4-1.5 1.9-2.4.4-.8 1.4-1 2.2-.6.8.4 1 1.4.6 2.2-.2.3-.4.5-.6.6zm51.1-1.7c.5.9 1.2 1.7 1.8 2.4.7.7 1.4 1.4 2.2 2.1.8.6 1.8 1.1 2.7 1.6.5.3.9.5 1.3.8.4.3.9.5.7 1.5-.3 1.2-1.3 2.1-2.4 2.4-1 .3-1.2-.3-1.5-.7-.3-.4-.6-.8-.8-1.3-.5-.9-1-1.9-1.6-2.7-.6-.8-1.3-1.5-2.1-2.2-.8-.7-1.5-1.3-2.5-1.8-.8-.4-1-1.4-.6-2.2.4-.8 1.4-1 2.2-.6.3.2.5.4.6.7zm-53-49.7c-.5-.9-1.1-1.7-1.8-2.5s-1.4-1.5-2.2-2.1c-.8-.7-1.7-1.1-2.6-1.7-.4-.3-.9-.5-1.3-.9-.4-.3-.9-.5-.6-1.5.3-1.2 1.3-2.1 2.5-2.4 1-.2 1.1.3 1.5.7.3.4.6.9.8 1.3.5.9.9 1.9 1.5 2.7.6.8 1.3 1.5 2 2.3.7.7 1.5 1.4 2.4 1.9.8.4 1 1.4.6 2.2-.4.8-1.4 1-2.2.6-.3-.1-.5-.3-.6-.6z">
                            </path>
                            <path fill="none" stroke="#ecc6c3" stroke-linecap="round" stroke-miterlimit="10"
                                stroke-width="4"
                                d="M65.7 91.8c1.2-2.8 2-5.8 2.5-8.7.4-3 .4-5.8 0-8.7-.1-.7 0-1.1.2-1.2.2-.1.6.1 1.1.7 1.4 1.8 3.1 3.4 4.9 4.9 1.8 1.5 3.9 2.7 6.1 3.8 1.4.7 2.8-.5 2.1-2-.9-2.3-2.1-4.4-3.4-6.3-.7-1-1.4-1.9-2.1-2.8-.8-.9-1.6-1.7-2.4-2.5-1-1-.8-1.5.6-1.2 2.3.5 4.5.7 6.9.7 2.3-.1 4.8-.3 7.1-.9 1.5-.4 1.8-2.2.4-2.9-2.2-1.2-4.4-2-6.7-2.7-1.1-.3-2.3-.6-3.4-.8-1.2-.2-2.3-.3-3.5-.4-1.4-.1-1.6-.7-.3-1.4 2.1-1.1 3.9-2.4 5.8-3.9 1.8-1.5 3.4-3.3 4.9-5.3.9-1.2 0-2.8-1.6-2.5-2.4.5-4.7 1.2-6.9 2.2-2.1.9-4.2 2.1-6 3.5-1.2.8-1.7.5-1.1-.9.9-2.1 1.5-4.3 1.9-6.7.4-2.3.6-4.8.4-7.2 0-.8-.5-1.3-1-1.5-.6-.2-1.2 0-1.7.6-.8 1-1.5 1.9-2.1 2.9-.7 1-1.2 2.1-1.8 3.1-1 2.1-1.8 4.3-2.4 6.5-.4 1.4-1 1.5-1.4 0-.7-2.2-1.6-4.3-2.8-6.4-1.2-2-2.6-4-4.2-5.8-1-1.2-2.8-.6-2.7 1.1 0 1.2.1 2.4.2 3.6.1 1.2.4 2.4.6 3.5.5 2.3 1.3 4.5 2.3 6.5.6 1.3.2 1.8-1.1.9-1.9-1.2-4-2.3-6.2-3.1-2.2-.8-4.6-1.5-7-1.8-.8-.1-1.4.2-1.7.7-.3.5-.2 1.2.3 1.8 3.1 3.7 7 6.6 11.2 8.5 1.3.6 1.3 1.2-.2 1.4-2.2.3-4.5.8-6.8 1.5-2.2.8-4.4 1.8-6.5 3.1-.7.4-.9 1.1-.8 1.6.1.6.6 1.1 1.4 1.2 4.8.9 9.6.6 14.1-.6.7-.2 1.2-.2 1.3.1.1.2 0 .6-.6 1.1-4 4.1-6.9 9.4-8.3 15.5">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="login-form-header register-header">
                        <div class="login-form-header-title">
                            <span>أنشء</span>
                            <span>حسابك الآن :</span>
                        </div>
                        {{-- <span class="login-form-header-image">
                            <img src="{{ url('modules/theme/images/register.svg') }}" alt="register-icon" />
                        </span> --}}
                    </div>
                    <div class="login-form-header-body">
                        <p>ادخل بياناتك بشكل صحيح للحصول علي افضل تجربة داخل الموقع</p>
                    </div>
                    <div class="form-content mt-4">
                        <form action="{{ route('theme.register') }}" id="login-form" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="text" required="" id="name" name="name"
                                            onkeypress="validateArabicInput(event)" />
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="name">
                                            <span class="label-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="iconify iconify--icon-park-solid" width="1em"
                                                    height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="4">
                                                        <circle cx="24" cy="11" r="7" fill="currentColor">
                                                        </circle>
                                                        <path d="M4 41c0-8.837 8.059-16 18-16"></path>
                                                        <path fill="currentColor" d="m31 42l10-10l-4-4l-10 10v4z"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span>الاسم رباعى</span>
                                        </label>


                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="email" required="" id="email" name="email" />
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="email">
                                            <span class="label-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="iconify iconify--icon-park-solid" width="1em"
                                                    height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="4">
                                                        <circle cx="24" cy="11" r="7" fill="currentColor">
                                                        </circle>
                                                        <path d="M4 41c0-8.837 8.059-16 18-16"></path>
                                                        <path fill="currentColor" d="m31 42l10-10l-4-4l-10 10v4z"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span>الاميل </span>
                                        </label>


                                    </div>
                                </div>
                                {{-- <div class="col-md-12 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="number" required="" id="national_id" name="national_id"
                                            onkeypress="validateNumberInput(event)" maxlength="14" />
                                        @error('national_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <label for="national_id">
                                            <span class="label-icon">
                                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 576 512" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0 96l576 0c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96zm0 32V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128H0zM64 405.3c0-29.5 23.9-53.3 53.3-53.3H234.7c29.5 0 53.3 23.9 53.3 53.3c0 5.9-4.8 10.7-10.7 10.7H74.7c-5.9 0-10.7-4.8-10.7-10.7zM176 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm176 16c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span>الرقم القومى</span>
                                        </label>


                                    </div>
                                    <span class="custom_input_message">
                                        الرقم القومى المكون من 14 رقم موجودا فى شهادة الميلاد او
                                        البطاقة
                                    </span>

                                </div> --}}

                                <div class="col-md-6 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="number" required="" id="phone" name="phone"
                                            onkeypress="validateNumberInput(event)" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <label for="phone">
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
                                            <span>رقم الهاتف </span>
                                            <!--<span> {{ _('student.Phone Number') }}</span>-->
                                            <span class="text-danger">*</span>

                                        </label>


                                    </div>
                                </div>

                                <div class="col-md-6 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="text" required="" id="parent_phone" name="parent_phone"
                                            onkeypress="validateNumberInput(event)" />
                                        @error('parent_phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <label for="parent_phone">
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
                                            <span>رقم هاتف ولى الأمر</span>
                                        </label>


                                    </div>
                                </div>

                                <div class="col-12 my-3">
                                    <div class="custom-select">
                                        <select
                                            class=" form-control  ot-input select2 @error('gender') is-invalid @enderror"
                                            id="gender" name="gender" required>
                                            <option selected="" disabled="" value="">

                                                اختر النوع
                                            </option>
                                            <option value="1">ذكر</option>
                                            <option value="2">أنثي</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 my-3">
                                    <div class="custom-select">
                                        <select name="goverment" class="form-control">
                                            <option selected="" disabled="" value="">المحافظة</option>
                                            <option value="القاهرة">القاهرة</option>
                                            <option value="الغربية">الغربية</option>
                                            <option value="الجيزة">الجيزة </option>
                                            <option value="الإسماعيلية">الإسماعيلية</option>
                                            <option value="كفر الشيخ">كفر الشيخ</option>
                                            <option value="مطروح">مطروح</option>
                                            <option value="المنيا">المنيا</option>
                                            <option value="المنوفية">المنوفية</option>
                                            <option value="الوادي الجديد">الوادي الجديد</option>
                                            <option value="شمال سيناء">شمال سيناء</option>
                                            <option value="بورسعيد">بورسعيد</option>
                                            <option value="القليوبية">القليوبية</option>
                                            <option value="قنا">قنا</option>
                                            <option value="البحر الأحمر">البحر الأحمر</option>
                                            <option value="الشرقية">الشرقية</option>
                                            <option value="سوهاج">سوهاج</option>
                                            <option value="جنوب سيناء">جنوب سيناء</option>
                                            <option value="السويس">السويس</option>
                                            <option value="الأقصر">الأقصر</option>
                                            <option value="الإسكندرية">الإسكندرية</option>
                                            <option value="الفيوم">الفيوم</option>
                                            <option value="أسوان">أسوان</option>
                                            <option value="أسيوط">أسيوط</option>
                                            <option value="البحيرة">البحيرة</option>
                                            <option value="بني سويف">بني سويف</option>
                                            <option value="الدقهلية">الدقهلية</option>
                                            <option value="دمياط">دمياط</option>
                                        </select>

                                        @error('goverment')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-12 my-3">
                                    <div class="custom-select">
                                        <select
                                            class=" form-control  ot-input select2 @error('category') is-invalid @enderror"
                                            id="category" name="category">
                                            <option selected="" disabled="" value="">

                                                اختر الصف الدراسي
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                                {{-- <div class="col-12 my-3">
                                    <div class="national_container">
                                        <label class="form-label" for="national_image">
                                            <span> رفع </span>
                                            <p> ارفع شهادة ميلادك / بطاقتك </p>
                                        </label>
                                        <input type="file" required="" id="national_image" name="national_image"
                                            class="form-control d-none" onchange="uploadNationalImage(this)" />
                                        <span class="text-danger custom-error-text" id="error_national_image"></span>
                                        <img />
                                    </div>
                                </div> --}}



                                <div class="col-md-6 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="password" required="" id="password" name="password" />
                                        <span class="text-danger custom-error-text" id="error_password"></span>

                                        <label for="password">
                                            <span class="label-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="iconify iconify--ri" width="1em"
                                                    height="1em" preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0zm-2 0V7a4 4 0 0 0-8 0v1zm-5 6v2h2v-2zm-4 0v2h2v-2zm8 0v2h2v-2z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <!--{{ _('student.Password') }}-->
                                            كلمه السر
                                            <span class="text-danger">*</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6 my-3">
                                    <div class="custom_input">
                                        <div class="bg"></div>
                                        <input type="password" required="" id="password_confirmation"
                                            name="password_confirmation" />
                                        <span class="text-danger custom-error-text"
                                            id="error_password_confirmation"></span>

                                        <label for="password_confirmation">
                                            <span class="label-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="iconify iconify--ri" width="1em"
                                                    height="1em" preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0zm-2 0V7a4 4 0 0 0-8 0v1zm-5 6v2h2v-2zm-4 0v2h2v-2zm8 0v2h2v-2z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span>تأكيد كلمة السر </span>

                                        </label>
                                    </div>
                                </div>
                                <div class="position-relative ot-contact-form mb-40">
                                    <div class="remember-me terms-condition mb-0">
                                        <label>
                                            <input class="ot-checkbox" type="checkbox" value="programming"
                                                name="agree" />
                                            <small>
                                                أوافق
                                                <a href="#"><span style="margin-right: 3px;"> على الشروط
                                                        والاحكام</span></a>
                                            </small>
                                            <span class="ot-checkmark"></span>
                                        </label>
                                    </div>
                                    <span class="text-danger custom-error-text" id="error_agree"></span>
                                </div>
                                <div>
                                    {{-- <button type="button" class="btn-outline btn-outline-blue" id="studentSignUpButton"
                                        style="width: 160px; font-size: 1rem">
                                        انشئ الحساب
                                    </button> --}}

                                    @if (get_frontend_settings('recaptcha_status'))
                                        <button class="eBtn gradient w-100 g-recaptcha"
                                            data-sitekey="{{ get_frontend_settings('recaptcha_sitekey') }}"
                                            data-callback='onLoginSubmit' data-action='submit'> انشئ الان الحساب</button>
                                    @else
                                        <button type="submit" class="eBtn gradient w-100"> انشئ الان الحساب</button>
                                    @endif
                                    {{-- <button type="button" class="btn-outline btn-outline-red mt-3"
                                        onclick="openVideosModal(this, `{{ get_theme_settings('button_how_register') }}`)"
                                        style="font-size: 1rem">
                                        طريقة شرح انشاء حساب علي المنصة
                                    </button> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="login-link mt-4" style="color: #6b7280">
                        <!--<span>يوجد لديك حساب بالفعل؟</span>-->
                        <span>يوجد لديك حساب بالفعل؟ <a href="{{ route('theme.show_login') }}"><span>ادخل إلى حسابك الآن
                                    !</span></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        let hasShownNumberToast = false;
        let hasShownArabicToast = false;

        function validateNumberInput(event) {
            try {
                const charCode = event.which ? event.which : event.keyCode;

                // Allow special keys: backspace, delete, tab, escape, enter, arrow keys, etc.
                if (charCode === 8 || charCode === 9 || charCode === 27 || charCode === 13 ||
                    (charCode === 46 && event.shiftKey === false) ||
                    (charCode >= 35 && charCode <= 40) ||
                    (charCode >= 37 && charCode <= 40)) {
                    return true;
                }

                // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                if ((charCode === 65 || charCode === 67 || charCode === 86 || charCode === 88) &&
                    (event.ctrlKey === true || event.metaKey === true)) {
                    return true;
                }

                if (charCode < 48 || charCode > 57) {
                    event.preventDefault();

                    if (!hasShownNumberToast && typeof Swal !== 'undefined') {
                        hasShownNumberToast = true;
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "error",
                            title: "مسموح فقط الكتابة بالأرقام "
                        });

                        setTimeout(() => {
                            hasShownNumberToast = false;
                        }, 1500);
                    }
                    return false;
                }
                return true;
            } catch (error) {
                console.error('Error in validateNumberInput:', error);
                return true;
            }
        }

        function validateArabicInput(event) {
            try {
                const charCode = event.which ? event.which : event.keyCode;

                // Allow special keys: backspace, delete, tab, escape, enter, arrow keys, etc.
                if (charCode === 8 || charCode === 9 || charCode === 27 || charCode === 13 ||
                    (charCode === 46 && event.shiftKey === false) ||
                    (charCode >= 35 && charCode <= 40) ||
                    (charCode >= 37 && charCode <= 40)) {
                    return true;
                }

                // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                if ((charCode === 65 || charCode === 67 || charCode === 86 || charCode === 88) &&
                    (event.ctrlKey === true || event.metaKey === true)) {
                    return true;
                }

                const char = String.fromCharCode(charCode);
                const arabicRegex = /^[\u0600-\u06FF\s]+$/;

                if (!arabicRegex.test(char)) {
                    event.preventDefault();

                    if (!hasShownArabicToast && typeof Swal !== 'undefined') {
                        hasShownArabicToast = true;
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "error",
                            title: "مسموح فقط الكتابة باللغه العربية"
                        });

                        setTimeout(() => {
                            hasShownArabicToast = false;
                        }, 1500);
                    }
                    return false;
                }
                return true;
            } catch (error) {
                console.error('Error in validateArabicInput:', error);
                return true;
            }
        }

        function uploadNationalImage(input) {
            try {
                if (!input || !input.files) {
                    return;
                }

                const inputParent = input.closest("div");
                if (!inputParent) {
                    return;
                }

                const label = inputParent.querySelector('label p');
                const preview = inputParent.querySelector("img");
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        if (preview) {
                            preview.src = reader.result;
                            preview.style.display = "block";
                        }
                    };
                    reader.readAsDataURL(file);
                    inputParent.classList.add("uploaded");
                    if (label) {
                        label.textContent = file.name;
                    }
                } else {
                    if (preview) {
                        preview.style.display = "none";
                    }
                    if (label) {
                        label.textContent = " ارفع شهادة ميلادك / بطاقتك";
                    }
                    inputParent.classList.remove("uploaded");
                }
            } catch (error) {
                console.error('Error in uploadNationalImage:', error);
            }
        }

        // Form validation function
        function validateForm() {
            try {
                // Clear previous error messages
                const errorElements = document.querySelectorAll('.custom-error-text');
                errorElements.forEach(el => el.textContent = '');

                let errors = [];
                let firstErrorField = null;

                // Validate name
                const name = document.getElementById('name');
                if (!name || !name.value || !name.value.trim()) {
                    errors.push('يرجى إدخال حقل الاسم');
                    if (!firstErrorField) firstErrorField = name;
                }

                // Validate email
                const email = document.getElementById('email');
                if (!email || !email.value || !email.value.trim()) {
                    errors.push('يرجى إدخال حقل البريد الإلكتروني');
                    if (!firstErrorField) firstErrorField = email;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                    errors.push('يجب إدخال بريد إلكتروني صحيح');
                    if (!firstErrorField) firstErrorField = email;
                }

                // // Validate national_id
                // const nationalId = document.getElementById('national_id');
                // if (!nationalId || !nationalId.value || !nationalId.value.trim()) {
                //     errors.push('يرجى إدخال حقل الرقم القومي');
                //     if (!firstErrorField) firstErrorField = nationalId;
                // } else if (nationalId.value.length !== 14) {
                //     errors.push('يجب أن يكون الرقم القومي مكونًا من 14 رقمًا');
                //     if (!firstErrorField) firstErrorField = nationalId;
                // }

                // Validate phone
                const phone = document.getElementById('phone');
                if (!phone || !phone.value || !phone.value.trim()) {
                    errors.push('يرجى إدخال حقل رقم الهاتف');
                    if (!firstErrorField) firstErrorField = phone;
                } else if (phone.value.length < 10 || phone.value.length > 14) {
                    errors.push('يجب أن يكون رقم الهاتف بين 10 و 14 رقمًا');
                    if (!firstErrorField) firstErrorField = phone;
                }

                // Validate parent_phone
                const parentPhone = document.getElementById('parent_phone');
                if (!parentPhone || !parentPhone.value || !parentPhone.value.trim()) {
                    errors.push('يرجى إدخال حقل رقم هاتف ولي الأمر');
                    if (!firstErrorField) firstErrorField = parentPhone;
                } else if (parentPhone.value.length < 10 || parentPhone.value.length > 14) {
                    errors.push('يجب أن يكون رقم هاتف ولي الأمر بين 10 و 14 رقمًا');
                    if (!firstErrorField) firstErrorField = parentPhone;
                } else if (phone && phone.value && phone.value === parentPhone.value) {
                    errors.push('يجب أن يكون رقم الهاتف مختلفًا عن رقم ولي الأمر');
                    if (!firstErrorField) firstErrorField = parentPhone;
                }

                // Validate gender
                const gender = document.getElementById('gender');
                if (!gender || !gender.value) {
                    errors.push('يرجى اختيار حقل النوع');
                    if (!firstErrorField) firstErrorField = gender;
                }

                // Validate goverment
                const goverment = document.querySelector('select[name="goverment"]');
                if (!goverment || !goverment.value) {
                    errors.push('يرجى اختيار حقل المحافظة');
                    if (!firstErrorField) firstErrorField = goverment;
                }

                // Validate category
                const category = document.getElementById('category');
                if (!category || !category.value) {
                    errors.push('يرجى اختيار حقل الصف الدراسي');
                    if (!firstErrorField) firstErrorField = category;
                }

                // // Validate national_image
                // const nationalImage = document.getElementById('national_image');
                // if (!nationalImage || !nationalImage.files || nationalImage.files.length === 0) {
                //     errors.push('يرجى رفع صورة البطاقة');
                //     if (!firstErrorField) firstErrorField = nationalImage;
                // } else {
                //     const file = nationalImage.files[0];
                //     if (file) {
                //         const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                //         const maxSize = 50 * 1024 * 1024; // 50MB

                //         if (!allowedTypes.includes(file.type)) {
                //             errors.push('يجب أن تكون الصورة بصيغة: jpeg, png, jpg, webp');
                //             if (!firstErrorField) firstErrorField = nationalImage;
                //         } else if (file.size > maxSize) {
                //             errors.push('أقصى حجم مسموح للصورة هو 50 ميجا');
                //             if (!firstErrorField) firstErrorField = nationalImage;
                //         }
                //     }
                // }

                // Validate password
                const password = document.getElementById('password');
                if (!password || !password.value) {
                    errors.push('يرجى إدخال حقل كلمة المرور');
                    if (!firstErrorField) firstErrorField = password;
                } else if (password.value.length < 8) {
                    errors.push('كلمة المرور يجب أن تكون على الأقل 8 أحرف');
                    if (!firstErrorField) firstErrorField = password;
                }

                // Validate password confirmation
                const passwordConfirmation = document.getElementById('password_confirmation');
                if (!passwordConfirmation || !passwordConfirmation.value) {
                    errors.push('يرجى إدخال حقل تأكيد كلمة المرور');
                    if (!firstErrorField) firstErrorField = passwordConfirmation;
                } else if (password && password.value && password.value !== passwordConfirmation.value) {
                    errors.push('كلمة المرور وتأكيد كلمة المرور غير متطابقين');
                    if (!firstErrorField) firstErrorField = passwordConfirmation;
                }

                // Validate agree checkbox
                const agree = document.querySelector('input[name="agree"]');
                if (!agree || !agree.checked) {
                    errors.push('يرجى الموافقة على الشروط والأحكام');
                    if (!firstErrorField) firstErrorField = agree;
                }

                return {
                    errors,
                    firstErrorField
                };
            } catch (error) {
                console.error('Error in validateForm:', error);
                return {
                    errors: ['حدث خطأ أثناء التحقق من البيانات. يرجى المحاولة مرة أخرى.'],
                    firstErrorField: null
                };
            }
        }

        // Function to show errors in Sweet Alert
        function showValidationErrors(errors, firstErrorField) {
            try {
                if (!errors || errors.length === 0) {
                    return true;
                }

                if (typeof Swal === 'undefined') {
                    // Fallback if Swal is not loaded
                    alert('يرجى إكمال البيانات المطلوبة:\n' + errors.join('\n'));
                    if (firstErrorField && firstErrorField.focus) {
                        setTimeout(() => {
                            firstErrorField.focus();
                        }, 100);
                    }
                    return false;
                }

                let errorMessage = errors.length === 1 ?
                    errors[0] :
                    '<ul style="text-align: right; direction: rtl; list-style-type: none; padding-right: 0;">' + errors.map(
                        err => '<li style="margin-bottom: 8px;">' + err + '</li>').join('') + '</ul>';

                Swal.fire({
                    icon: 'error',
                    title: 'يرجى إكمال البيانات المطلوبة',
                    html: errorMessage,
                    confirmButtonText: 'حسناً',
                    confirmButtonColor: '#3085d6',
                    didClose: () => {
                        // Focus on first error field after closing alert
                        if (firstErrorField) {
                            setTimeout(() => {
                                try {
                                    if (firstErrorField.focus) {
                                        firstErrorField.focus();
                                    }
                                    if (firstErrorField.scrollIntoView) {
                                        firstErrorField.scrollIntoView({
                                            behavior: 'smooth',
                                            block: 'center'
                                        });
                                    }
                                } catch (e) {
                                    console.error('Error focusing field:', e);
                                }
                            }, 100);
                        }
                    }
                });
                return false;
            } catch (error) {
                console.error('Error in showValidationErrors:', error);
                alert('حدث خطأ أثناء التحقق من البيانات. يرجى المحاولة مرة أخرى.');
                return false;
            }
        }

        // reCAPTCHA callback function
        function onLoginSubmit(token) {
            try {
                const validationResult = validateForm();
                if (!validationResult || !validationResult.errors || validationResult.errors.length === 0) {
                    const form = document.getElementById("login-form");
                    if (form) {
                        form.submit();
                    }
                } else {
                    showValidationErrors(validationResult.errors, validationResult.firstErrorField);
                    // Reset reCAPTCHA
                    if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
                        grecaptcha.reset();
                    }
                }
            } catch (error) {
                console.error('Error in onLoginSubmit:', error);
                alert('حدث خطأ أثناء إرسال النموذج. يرجى المحاولة مرة أخرى.');
            }
        }

        // Form validation and submission handler
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const form = document.getElementById('login-form');

                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        try {
                            const validationResult = validateForm();

                            if (!validationResult || !validationResult.errors || validationResult.errors
                                .length === 0) {
                                // If validation passes, submit the form
                                form.submit();
                            } else {
                                showValidationErrors(validationResult.errors, validationResult
                                    .firstErrorField);
                            }
                        } catch (error) {
                            console.error('Error in form submit handler:', error);
                            alert('حدث خطأ أثناء التحقق من البيانات. يرجى المحاولة مرة أخرى.');
                        }
                    });
                }
            } catch (error) {
                console.error('Error in DOMContentLoaded:', error);
            }
        });

        // Handle server-side validation errors
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    let errorMessages = [];
                    @foreach ($errors->all() as $error)
                        errorMessages.push('{{ addslashes($error) }}');
                    @endforeach

                    if (errorMessages.length > 0) {
                        let errorMessage = errorMessages.length === 1 ?
                            errorMessages[0] :
                            '<ul style="text-align: right; direction: rtl; list-style-type: none; padding-right: 0;">' +
                            errorMessages.map(err => '<li style="margin-bottom: 8px;">' + err + '</li>').join('') +
                            '</ul>';

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ في البيانات',
                                html: errorMessage,
                                confirmButtonText: 'حسناً',
                                confirmButtonColor: '#3085d6'
                            });
                        } else {
                            alert('خطأ في البيانات:\n' + errorMessages.join('\n'));
                        }
                    }
                } catch (error) {
                    console.error('Error showing server-side validation errors:', error);
                }
            });
        @endif
    </script>

    <!-- LOGIN::END  -->



    <link rel="stylesheet" type="text/css" href="{{ url('frontend\assets/css/global/animation.css') }}">
@endsection
