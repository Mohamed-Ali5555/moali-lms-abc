@php

    $social = \Modules\Theme\App\Models\theme_social::where('status', 1)->get();
@endphp


    <footer class="site-footer" dir="rtl">

        <!-- الفاصل الموجي -->
        <div class="footer-wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>

        <div class="container text-center text-white">
            <div class="d-flex flex-column align-items-center">

                <img src="{{ asset(get_theme_settings('logo') ?? '') }}" alt="Platform Logo" class="footer-logo logo light" />
                <img src="{{ asset(get_theme_settings('dark_logo') ?? '') }}" alt="Platform Logo" class="footer-logo logo dark" />

                <p class="footer-quote mb-4">
                    {!! get_theme_settings('footer_description') !!}
                </p>

                {{-- <p class="fs-5 mb-4 w-75">
                    {!! get_theme_settings('footer_description') !!}
                </p> --}}

                <!-- 3. رقم التواصل والدعم -->
                <div class="support-contact mb-4">
                    <a href="https://wa.me/{{ get_theme_settings('technical') }}" target="_blank" class="d-flex align-items-center gap-2">
                        <span>للدعم الفني: <strong>{{ get_theme_settings('technical') }}</strong></span>
                    </a>
                </div>

                <!-- 4. وسائل التواصل -->
                <div class="social-icons d-flex gap-3 mb-5">
                    @if (!empty($social))
                        @foreach ($social as $row)
                            <a href="{{ $row->url }}" aria-label="{{ $row->title }}"><i class="fa-brands fa-{{ $row->title }}"></i></a>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

        <!-- 5 & 6. حقوق النشر والشروط والأحكام -->
        <div class="footer-bottom py-3">
            <div class="container">
                <div class="flex-column-reverse flex-sm-row justify-content-between text-center small d-flex">
                    <p class="mb-2 mb-sm-0">&copy; <span>
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </span> جميع الحقوق محفوظة لـ <a href="https://wa.me/+201044445330" target="_blank" class="text-decoration-none fw-bold" style="color: rgb(var(--c-accent-rgb))">Arkan</a>
                    </p>
                    @if (get_theme_settings('terms_status') == 1)
                        <a href="{{ route('theme.terms.condition') }}">الشروط والأحكام وسياسة الخصوصية</a>
                    @endif
                </div>
            </div>
        </div>

    </footer>



{{-- <footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10 mx-auto">
                <div class="social-media d-flex align-items-center justify-content-center gap-3">

                    @if (!empty($social))
                        @foreach ($social as $row)
                            <a href="{{ $row->url }}">
                                <img src="{{ get_image($row->thumbnail) }}" alt="{{ $row->title }}" />
                            </a>
                        @endforeach
                    @endif
                </div>

                @if (get_theme_settings('technical_status') == 1)
                    <div class="d-flex align-items-center gap-2 justify-content-center hot-line" style="direction: rtl">
                        <h6 class="mb-0 text-dark">الدعم الفنى : </h6>
                        <a href="https://t.me/{{ get_theme_settings('telegram_username') }}" target="_blank" style="color:#FFF">
                            <h4 style="direction: ltr">
                                <span style="color:#000000;">{{ get_theme_settings('technical') }}</span>
                            </h4>
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--healthicons"
                                width="1em" height="1em" viewBox="0 0 48 48">
                                <g fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M21.407 15.092a5.402 5.402 0 0 1 3.477 8.33L38.718 34.16a2.25 2.25 0 1 1-1.182 1.614l-14.07-10.922a5.4 5.4 0 1 1-4.058-9.76L19.406 6h2zm.799 5.308a1.8 1.8 0 1 1-3.6 0a1.8 1.8 0 0 1 3.6 0"
                                        clip-rule="evenodd"></path>
                                    <path
                                        d="M27.63 20.384a7.2 7.2 0 0 0-4.223-6.558v-7.72c4.289.377 6.517 1.728 8.512 3.577q.151.141.296.273v.001c.85.78 1.526 1.401 1.875 2.331l4.234 11.272a2 2 0 0 1-1.873 2.701H34.82V28.6l-7.575-5.882a7.2 7.2 0 0 0 .386-2.333m-10.224-6.539V6.241c-8.99 1.353-11.403 8.06-11.403 11.734c0 5.767 3.683 10.24 5.41 12.033V42h17.112v-6.512h4.293c.302 0 .59-.068.846-.188L23.08 27.08a7.2 7.2 0 0 1-5.673-13.234">
                                    </path>
                                </g>
                            </svg>
                        </a>
                    </div>
                @endif





                <div class="d-flex align-items-center justify-content-between gap-2">
                    <span class="heart">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--emojione-v1" width="1em"
                            height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 64 64">
                            <path fill="#d13852"
                                d="M54.02 26.962c-.169-2.643-.734-4.79-2.576-7c-3.686-4.421-12.158-5.157-15.953-.901c-.66.626-1.284 1.38-1.911 2.281l-1.419 2.039l-1.419-2.039c-.629-.9-1.255-1.655-1.916-2.281c-3.792-4.256-12.265-3.521-15.951.901c-1.843 2.211-2.41 4.358-2.579 7c-.24 7.858 5.463 14.15 6.167 15.07c3.87 4.54 8.092 8.834 12.38 12.789c.776.68 1.446 1.243 2.116 1.804c.403.33.8.662 1.201.989c.399-.327.797-.659 1.196-.989c.673-.561 1.343-1.124 2.117-1.804c4.289-3.955 8.511-8.249 12.381-12.789c.706-.923 6.409-7.215 6.166-15.07">
                            </path>
                            <path fill="#f1a5b1"
                                d="M51.648 25.56a6.893 6.893 0 0 0-.313-1.997a6.222 6.222 0 0 0-.802-1.662c-2.042-3-6.489-4.081-10.206-3.321c-1.448.349-2.9.894-3.568 2.278c-.228.594.252.879.989.843c2.673-.299 5.632-.03 7.996 1.119c.589.288 1.139.63 1.643 1.032c1.696 1.313 2.429 3.356 2.764 5.381c.822-.166 1.273-1.155 1.378-2.036a7.185 7.185 0 0 0 .119-1.637">
                            </path>
                            <g fill="#faae40">
                                <path
                                    d="M54.4 18.02a9.222 9.222 0 0 1 1.83 6.566c1.754-2.41 1.868-5.726.008-8.182c-1.981-2.625-5.528-3.396-8.453-2.02a9.198 9.198 0 0 1 6.615 3.637">
                                </path>
                                <path
                                    d="M58.18 14.675a15.665 15.665 0 0 1 3.095 11.12c2.977-4.083 3.162-9.699.016-13.859c-3.369-4.454-9.37-5.753-14.321-3.423a15.625 15.625 0 0 1 11.21 6.162M9.915 18.02a9.257 9.257 0 0 0-1.832 6.566c-1.751-2.41-1.866-5.726-.006-8.182c1.984-2.625 5.527-3.396 8.454-2.02a9.204 9.204 0 0 0-6.616 3.637">
                                </path>
                                <path
                                    d="M6.137 14.675a15.626 15.626 0 0 0-3.094 11.12c-2.976-4.083-3.169-9.699-.019-13.859c3.371-4.454 9.374-5.753 14.325-3.423c-4.256.352-8.389 2.426-11.212 6.162">
                                </path>
                            </g>
                        </svg>
                    </span>

                    <span class="text-light text-center">{!! get_theme_settings('footer_description') !!} </span>

                    <span class="heart">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--emojione-v1" width="1em"
                            height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 64 64">
                            <path fill="#d13852"
                                d="M54.02 26.962c-.169-2.643-.734-4.79-2.576-7c-3.686-4.421-12.158-5.157-15.953-.901c-.66.626-1.284 1.38-1.911 2.281l-1.419 2.039l-1.419-2.039c-.629-.9-1.255-1.655-1.916-2.281c-3.792-4.256-12.265-3.521-15.951.901c-1.843 2.211-2.41 4.358-2.579 7c-.24 7.858 5.463 14.15 6.167 15.07c3.87 4.54 8.092 8.834 12.38 12.789c.776.68 1.446 1.243 2.116 1.804c.403.33.8.662 1.201.989c.399-.327.797-.659 1.196-.989c.673-.561 1.343-1.124 2.117-1.804c4.289-3.955 8.511-8.249 12.381-12.789c.706-.923 6.409-7.215 6.166-15.07">
                            </path>
                            <path fill="#f1a5b1"
                                d="M51.648 25.56a6.893 6.893 0 0 0-.313-1.997a6.222 6.222 0 0 0-.802-1.662c-2.042-3-6.489-4.081-10.206-3.321c-1.448.349-2.9.894-3.568 2.278c-.228.594.252.879.989.843c2.673-.299 5.632-.03 7.996 1.119c.589.288 1.139.63 1.643 1.032c1.696 1.313 2.429 3.356 2.764 5.381c.822-.166 1.273-1.155 1.378-2.036a7.185 7.185 0 0 0 .119-1.637">
                            </path>
                            <g fill="#faae40">
                                <path
                                    d="M54.4 18.02a9.222 9.222 0 0 1 1.83 6.566c1.754-2.41 1.868-5.726.008-8.182c-1.981-2.625-5.528-3.396-8.453-2.02a9.198 9.198 0 0 1 6.615 3.637">
                                </path>
                                <path
                                    d="M58.18 14.675a15.665 15.665 0 0 1 3.095 11.12c2.977-4.083 3.162-9.699.016-13.859c-3.369-4.454-9.37-5.753-14.321-3.423a15.625 15.625 0 0 1 11.21 6.162M9.915 18.02a9.257 9.257 0 0 0-1.832 6.566c-1.751-2.41-1.866-5.726-.006-8.182c1.984-2.625 5.527-3.396 8.454-2.02a9.204 9.204 0 0 0-6.616 3.637">
                                </path>
                                <path
                                    d="M6.137 14.675a15.626 15.626 0 0 0-3.094 11.12c-2.976-4.083-3.169-9.699-.019-13.859c3.371-4.454 9.374-5.753 14.325-3.423c-4.256.352-8.389 2.426-11.212 6.162">
                                </path>
                            </g>
                        </svg>
                    </span>
                </div>

                @if (get_theme_settings('terms_status') == 1)
                    <div class="text-center" style="color: #d8b4fe">
                        <a href="#" class="wow fadeInUp terms_condition"
                            data-wow-delay="0.1s"> شروط و احكام و سياسات استخدام المنصة </a>
                    </div>
                @endif


                <div class="text-center mt-4 fs-5" style="color: #d8b4fe">
                    <span class="text-purple-300">All Copy Rights Reserved @
                        <a href="https://wa.me/+201140404211" target="_blank"
                            style="color: var(--primary-color)">Arkan</a>
                        <span>
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </span>
                    </span>
                </div>

            </div>
        </div>
    </div>
</footer> --}}

