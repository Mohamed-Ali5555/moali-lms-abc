@extends('theme::layouts.master')

@section('content')

    @if (get_theme_settings('subscriptions_view') == 1)
        <div id="notification"
            style="display: none; border: 1px solid rgba(var(--c-bg-rgb)); padding: 10px; margin: 10px; border-radius: 5px; background-color: var(--theme-secondary-background);">
            <button id="close-btn"
                style="position: absolute; top: -10px; left: -10px; background: red; color: white; border: none; font-size: 18px; cursor: pointer; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">&times;</button>

            <p
                style="font-weight: bold;display: flex; font-size:18px;align-items: center !important; justify-content: center !important">
                عملية اشتراك جديدة <span style="font-size: 24px;">🛒</span></p>
            <p>قام <span style="font-size:18px; color:red" id="user-name"></span> بالاشتراك</p>
            <p>في <span style="font-size:18px; color:#0891b2" id="course-name">{{ $data['course']->title }}</span></p>
            <hr style="border:1px solid #2dd4bf">
            <p><span id="purchase-time"></span></p>
        </div>
    @endif
    <div class="main_content" dir="rtl">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="course-header">
            <div class="container" style="position: relative; z-index: 1">
                <div class="d-flex flex-wrap gap-3 course-details">
                    <div class="d-flex my-2">
                        <div class="course-details-number">
                            <span class="">+</span>
                            <span class="fw-bold fs-5">{{ $data['lessonCount'] }}</span>
                            <span class="">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--bxs" width="1em"
                                    height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M4 8H2v12a2 2 0 0 0 2 2h12v-2H4z"></path>
                                    <path fill="currentColor"
                                        d="M20 2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2m-9 12V6l7 4z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="course-details-text">
                            <span>فيديوهات</span>
                        </div>
                    </div>

                    <div class="d-flex my-2">
                        <div class="course-details-number">
                            <span class="">+</span>
                            <span class="fw-bold fs-5">{{ $data['quizeCount'] }}</span>
                            <span class=""><svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                    class="iconify iconify--healthicons" width="1em" height="1em"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                    <path fill="currentColor" stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M28.753 6.342A1 1 0 0 0 27 7v7a2 2 0 0 0 2 2h6a1 1 0 0 0 .753-1.658zM20.75 23h-1.5l.75-1.8zm6.808-18L37 15.387V40a3 3 0 0 1-3 3H14a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3zm-5.712 10.23a2 2 0 0 0-3.692 0l-5 12a2 2 0 0 0 3.692 1.54l.737-1.77h4.834l.737 1.77a2 2 0 0 0 3.692-1.54l-.103-.246Q26.87 27 27 27h1v1a2 2 0 1 0 4 0v-1h1a2 2 0 1 0 0-4h-1v-1a2 2 0 1 0-4 0v1h-1c-.648 0-1.224.308-1.59.786zM15 31a2 2 0 1 0 0 4a2 2 0 1 0 0 4h12a2 2 0 0 0 .002-4H33a2 2 0 1 0 0-4z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="course-details-text">
                            <span>امتحانات</span>
                        </div>
                    </div>

                    <div class="d-flex my-2">
                        <div class="course-details-number">
                            <span class="">+</span>
                            <span class="fw-bold fs-5">{{ $data['assinmentCount'] }}</span>
                            <span class=""><svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                    class="iconify iconify--healthicons" width="1em" height="1em"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M39 13a3 3 0 0 0-3 3v2h6v-2a3 3 0 0 0-3-3m3 7h-6v16.5l3 4.5l3-4.5zM6 9v30a3 3 0 0 0 3 3h22a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3m14 6a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1m1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2zm-1 10a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1m1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2zm-9-3v3h3v-3zm-1-2h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1m6.707-10.293a1 1 0 0 0-1.414-1.414L13 17.586l-1.293-1.293a1 1 0 0 0-1.414 1.414L13 20.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="course-details-text">
                            <span>واجبات</span>
                        </div>
                    </div>

                    <div class="d-flex my-2">
                        <div class="course-details-number">
                            <span class="">+</span>
                            <span class="fw-bold fs-5">{{ $data['documentCount'] }}</span>
                            <span class=""><svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                    class="iconify iconify--ant-design" width="1em" height="1em"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                                    <path fill="currentColor"
                                        d="M832 64H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V96c0-17.7-14.3-32-32-32m-260 72h96v209.9L621.5 312L572 347.4zM232 888V136h280v296.9c0 3.3 1 6.6 3 9.3a15.9 15.9 0 0 0 22.3 3.7l83.8-59.9l81.4 59.4c2.7 2 6 3.1 9.4 3.1c8.8 0 16-7.2 16-16V136h64v752z">
                                    </path>
                                    <path fill="currentColor" fill-opacity=".15" d="M668 345.9V136h-96v211.4l49.5-35.4z">
                                    </path>
                                    <path fill="currentColor" fill-opacity=".15"
                                        d="M727.9 136v296.5c0 8.8-7.2 16-16 16c-3.4 0-6.7-1.1-9.4-3.1L621.1 386l-83.8 59.9a15.9 15.9 0 0 1-22.3-3.7c-2-2.7-3-6-3-9.3V136H232v752h559.9V136z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="course-details-text">
                            <span>ملفات</span>
                        </div>
                    </div>


                </div>

                <div class="fs-1 fw-bold mt-3 text-light"> {{ $data['course']->title }}</div>
                <div class="fs-5 my-3 text-light">
                    <span>{!! $data['course']->description !!}</span>
                </div>
                <div class="course-dates">
                    <div class="d-flex flex-wrap gap-2">
                        <span class="" style="color: rgb(var(--c-accent-rgb))">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" width="1em" height="1em"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m11.17 8l-.59-.59L9.17 6H4v12h16V8zM14 10h2v2h2v2h-2v2h-2v-2h-2v-2h2z"
                                    opacity=".3"></path>
                                <path fill="currentColor"
                                    d="M20 6h-8l-2-2H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2m0 12H4V6h5.17l1.41 1.41l.59.59H20zm-8-4h2v2h2v-2h2v-2h-2v-2h-2v2h-2z">
                                </path>
                            </svg>
                        </span>
                        @php
                            \Carbon\Carbon::setLocale('ar');
                        @endphp
                        <span class="text-light text-decoration-underline">
                            <span>تاريخ انشاء الكورس</span> </span><span class="px-2 py-1 rounde"
                            style="background: rgb(var(--c-accent-rgb))">{{ \Carbon\Carbon::parse($data['course']->created_at)->isoFormat('dddd، D MMMM YYYY') }}</span>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="" style="color: rgb(var(--c-secondary-rgb))">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--icon-park-twotone"
                                width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                <defs>
                                    <mask id="iconifyReact79">
                                        <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="4">
                                            <path fill="#555"
                                                d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20">
                                            </path>
                                            <path
                                                d="M33.542 27c-1.274 4.057-5.064 7-9.542 7c-4.477 0-8.268-2.943-9.542-7v6m19.084-18v6c-1.274-4.057-5.064-7-9.542-7c-4.477 0-8.268 2.943-9.542 7">
                                            </path>
                                        </g>
                                    </mask>
                                </defs>
                                <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#iconifyReact79)"></path>
                            </svg></span><span class="text-light text-decoration-underline">آخر تحديث للكورس</span><span
                            class="px-2 py-1 rounded"
                            style="background: rgb(var(--c-secondary-rgb))">{{ \Carbon\Carbon::parse(lastUpdate($data['course']->id))->isoFormat('dddd، D MMMM YYYY') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row course-details-row">
                <div class="col-lg-8 col-md-7 display: none;">
                    <div class="course-content">
                        <div class="course-banner">
                            <img src="{{ get_image($data['course']->thumbnail ?? '') }}" alt="course-1" />
                            <div class="news_courses_content shadow mt-3 pb-4">
                                <h6 class="custom-section-title custom-section-title-animation fs-3 mb-5">
                                    <span>{{ $data['course']->title }}</span>
                                    <span></span>
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </h6>
                                <p>
                                    @if ($data['course']->category->parent == null)
                                        {{ $data['course']->category->title }}
                                    @else
                                        {{ $data['course']->category->parent->title }}
                                    @endif
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-5 display: none;">
                    <div class="course-small-banner" id="banner">
                        <img src="{{ get_image($data['course']->thumbnail ?? '') }}" alt="course-1" />

                        <div class="row px-3">



                            <div class="col-12 d-flex justify-content-between align-items-center">




                                @if (
                                    $data['course']->is_paid == 0 &&
                                        ($data['course']->price == 0 || $data['course']->price < 0 || $data['course']->price === null))
                                    <div class="cart_total_price course_price py-2 is-free" style="width:100%;">
                                        <span class="text-white">كورس مجانى</span>
                                    </div>
                                @else
                                    @if ($data['course']->discount_flag == 1)
                                        <div class="cart_total_price course_price">
                                            <span id="totalPrice">


                                                <b>{{ $data['course']->discount_price }}</b>
                                                <del class="color-black">{{ $data['course']->price }}</del>


                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" style="font-size: 0.8rem;color: var(--bs-warning);"
                                                    width="1em" height="1em" preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 1024 1024">
                                                    <path fill="currentColor"
                                                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372">
                                                    </path>
                                                    <path fill="currentColor" fill-opacity=".15"
                                                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372s372-166.6 372-372s-166.6-372-372-372m146 582.1c0 4.4-3.6 8-8 8H376.2c-4.4 0-8-3.6-8-8v-38.5c0-3.7 2.5-6.9 6.1-7.8c44-10.9 72.8-49 72.8-94.2c0-14.7-2.5-29.4-5.9-44.2H374c-4.4 0-8-3.6-8-8v-30c0-4.4 3.6-8 8-8h53.7c-7.8-25.1-14.6-50.7-14.6-77.1c0-75.8 58.6-120.3 151.5-120.3c26.5 0 51.4 5.5 70.3 12.7c3.1 1.2 5.2 4.2 5.2 7.5v39.5a8 8 0 0 1-10.6 7.6c-17.9-6.4-39-10.5-60.4-10.5c-53.3 0-87.3 26.6-87.3 70.2c0 24.7 6.2 47.9 13.4 70.5h112c4.4 0 8 3.6 8 8v30c0 4.4-3.6 8-8 8h-98.6c3.1 13.2 5.3 26.9 5.3 41c0 40.7-16.5 73.9-43.9 91.1v4.7h180c4.4 0 8 3.6 8 8z">
                                                    </path>
                                                    <path fill="currentColor"
                                                        d="M650 674.3H470v-4.7c27.4-17.2 43.9-50.4 43.9-91.1c0-14.1-2.2-27.8-5.3-41h98.6c4.4 0 8-3.6 8-8v-30c0-4.4-3.6-8-8-8h-112c-7.2-22.6-13.4-45.8-13.4-70.5c0-43.6 34-70.2 87.3-70.2c21.4 0 42.5 4.1 60.4 10.5a8 8 0 0 0 10.6-7.6v-39.5c0-3.3-2.1-6.3-5.2-7.5c-18.9-7.2-43.8-12.7-70.3-12.7c-92.9 0-151.5 44.5-151.5 120.3c0 26.4 6.8 52 14.6 77.1H374c-4.4 0-8 3.6-8 8v30c0 4.4 3.6 8 8 8h67.2c3.4 14.8 5.9 29.5 5.9 44.2c0 45.2-28.8 83.3-72.8 94.2c-3.6.9-6.1 4.1-6.1 7.8v38.5c0 4.4 3.6 8 8 8H650c4.4 0 8-3.6 8-8v-39.8c0-4.4-3.6-8-8-8">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span> جنيهًا </span>
                                        </div>
                                    @else
                                        <div class="cart_total_price course_price">
                                            <span id="totalPrice">
                                                {{ $data['course']->price }}.00
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" style="font-size: 0.8rem;color: var(--bs-warning);"
                                                    width="1em" height="1em" preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 1024 1024">
                                                    <path fill="currentColor"
                                                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372">
                                                    </path>
                                                    <path fill="currentColor" fill-opacity=".15"
                                                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372s372-166.6 372-372s-166.6-372-372-372m146 582.1c0 4.4-3.6 8-8 8H376.2c-4.4 0-8-3.6-8-8v-38.5c0-3.7 2.5-6.9 6.1-7.8c44-10.9 72.8-49 72.8-94.2c0-14.7-2.5-29.4-5.9-44.2H374c-4.4 0-8-3.6-8-8v-30c0-4.4 3.6-8 8-8h53.7c-7.8-25.1-14.6-50.7-14.6-77.1c0-75.8 58.6-120.3 151.5-120.3c26.5 0 51.4 5.5 70.3 12.7c3.1 1.2 5.2 4.2 5.2 7.5v39.5a8 8 0 0 1-10.6 7.6c-17.9-6.4-39-10.5-60.4-10.5c-53.3 0-87.3 26.6-87.3 70.2c0 24.7 6.2 47.9 13.4 70.5h112c4.4 0 8 3.6 8 8v30c0 4.4-3.6 8-8 8h-98.6c3.1 13.2 5.3 26.9 5.3 41c0 40.7-16.5 73.9-43.9 91.1v4.7h180c4.4 0 8 3.6 8 8z">
                                                    </path>
                                                    <path fill="currentColor"
                                                        d="M650 674.3H470v-4.7c27.4-17.2 43.9-50.4 43.9-91.1c0-14.1-2.2-27.8-5.3-41h98.6c4.4 0 8-3.6 8-8v-30c0-4.4-3.6-8-8-8h-112c-7.2-22.6-13.4-45.8-13.4-70.5c0-43.6 34-70.2 87.3-70.2c21.4 0 42.5 4.1 60.4 10.5a8 8 0 0 0 10.6-7.6v-39.5c0-3.3-2.1-6.3-5.2-7.5c-18.9-7.2-43.8-12.7-70.3-12.7c-92.9 0-151.5 44.5-151.5 120.3c0 26.4 6.8 52 14.6 77.1H374c-4.4 0-8 3.6-8 8v30c0 4.4 3.6 8 8 8h67.2c3.4 14.8 5.9 29.5 5.9 44.2c0 45.2-28.8 83.3-72.8 94.2c-3.6.9-6.1 4.1-6.1 7.8v38.5c0 4.4 3.6 8 8 8H650c4.4 0 8-3.6 8-8v-39.8c0-4.4-3.6-8-8-8">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span> جنيهًا </span>
                                        </div>
                                    @endif
                                @endif




                            </div>


                            <hr class="my-3" />



                            <div class="col-12 d-flex justify-content-between align-items-center">

                                <div class="d-flex gap-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            aria-hidden="true" role="img" class="iconify iconify--icon-park-twotone"
                                            width="1em" height="1em" preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 48 48">
                                            <defs>
                                                <mask id="iconifyReact290">
                                                    <g fill="none" stroke="#fff" stroke-linejoin="round"
                                                        stroke-width="4">
                                                        <path fill="#555"
                                                            d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z">
                                                        </path>
                                                        <path stroke-linecap="round" d="M24.008 12v12.01l8.479 8.48">
                                                        </path>
                                                    </g>
                                                </mask>
                                            </defs>
                                            <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#iconifyReact290)">
                                            </path>
                                        </svg>
                                    </span>
                                    <span>المحتوى</span>
                                </div>
                                <div class="d-flex gap-1" style="color:var(--theme-color)">
                                    <span>+</span>
                                    @php
                                        use Carbon\Carbon;

                                        $totalMinutes = $data['course']->sections->flatMap->allLesson->sum(function (
                                            $lesson,
                                        ) {
                                            if (!$lesson->duration) {
                                                return 0;
                                            }

                                            $time = Carbon::parse($lesson->duration);
                                            return $time->hour * 60 + $time->minute;
                                        });

                                        $hours = floor($totalMinutes / 60);
                                        $minutes = $totalMinutes % 60;
                                    @endphp
                                    {{-- <span>{{ $totalMinutes }}</span> --}}

                                    <span>{{ $hours }}h {{ $minutes }}m</span>


                                    {{-- <span>{{ number_format($data['course']->sections->flatMap->allLesson->sum(fn($lesson) => (int) $lesson->duration) / 60, 0) }}</span> --}}
                                    <span>ساعات</span>
                                </div>
                            </div>

                            <hr class="my-3" />

                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            aria-hidden="true" role="img" class="iconify iconify--ant-design"
                                            width="1em" height="1em" preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 1024 1024">
                                            <path fill="currentColor"
                                                d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372">
                                            </path>
                                            <path fill="currentColor" fill-opacity=".15"
                                                d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372s372-166.6 372-372s-166.6-372-372-372m0 632c-22.1 0-40-17.9-40-40s17.9-40 40-40s40 17.9 40 40s-17.9 40-40 40m62.9-219.5a48.3 48.3 0 0 0-30.9 44.8V620c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8v-21.5c0-23.1 6.7-45.9 19.9-64.9c12.9-18.6 30.9-32.8 52.1-40.9c34-13.1 56-41.6 56-72.7c0-44.1-43.1-80-96-80s-96 35.9-96 80v7.6c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V420c0-39.3 17.2-76 48.4-103.3C430.4 290.4 470 276 512 276s81.6 14.5 111.6 40.7C654.8 344 672 380.7 672 420c0 57.8-38.1 109.8-97.1 132.5">
                                            </path>
                                            <path fill="currentColor"
                                                d="M472 732a40 40 0 1 0 80 0a40 40 0 1 0-80 0m151.6-415.3C593.6 290.5 554 276 512 276s-81.6 14.4-111.6 40.7C369.2 344 352 380.7 352 420v7.6c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V420c0-44.1 43.1-80 96-80s96 35.9 96 80c0 31.1-22 59.6-56 72.7c-21.2 8.1-39.2 22.3-52.1 40.9c-13.2 19-19.9 41.8-19.9 64.9V620c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-22.7a48.3 48.3 0 0 1 30.9-44.8c59-22.7 97.1-74.7 97.1-132.5c0-39.3-17.2-76-48.4-103.3">
                                            </path>
                                        </svg>
                                    </span>
                                    <span>اجمالي الاسئلة</span>
                                </div>
                                <div class="d-flex gap-1" style="color:var(--theme-color)">
                                    <span>+</span>
                                    <span>{{ (int) $data['question'] + (int) $data['question_number_count'] }}</span>
                                    <span>سؤال</span>
                                </div>
                            </div>

                            <hr class="my-3" />

                            <div class="course-button" style="padding-top: 0px;">
                                @if (auth()->check() &&
                                        \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $data['course']->id)->exists())
                                    @php
                                        $watch_history = App\Models\Watch_history::where(
                                            'course_id',
                                            $data['course']->id,
                                        )
                                            ->where('student_id', auth()->user()->id)
                                            ->first();
                                        $lesson = App\Models\Lesson::where('course_id', $data['course']->id)
                                            ->orderBy('sort', 'asc')
                                            ->first();

                                        if (!$watch_history && !$lesson) {
                                            $url = route('course.player', ['slug' => $data['course']->slug]);
                                        } else {
                                            if ($watch_history) {
                                                $lesson_id = $watch_history->watching_lesson_id;
                                            } elseif ($lesson) {
                                                $lesson_id = $lesson->id;
                                            }
                                            $url = route('course.player', [
                                                'slug' => $data['course']->slug,
                                                'id' => $lesson_id,
                                            ]);
                                        }
                                    @endphp
                                    <button class="form-control eBtn gradient text-white"
                                        onclick="window.location='{{ $url }}'">
                                        @if (progress_bar($data['course']->id) > 0)
                                            مشاهدة الكورس
                                        @else
                                            البدء في مشاهدة الكورس
                                        @endif
                                    </button>
                                @elseif(
                                    $data['course']->is_paid == 0 &&
                                        ($data['course']->price == 0 || $data['course']->price < 0 || $data['course']->price === null))
                                    <button type="button" class="form-control eBtn gradient text-white"
                                        onclick="window.location.href='{{ route('payment.successFree', $data['course']->id) }}'">
                                        <i data-lucide="gift" class="me-2"></i>
                                        ابدأ مجانًا
                                    </button>
                                @else
                                    <button class="add-to-cart form-control eBtn gradient text-white"
                                        element-type="course" id-element="{{ $data['course']->id }}">إشترك
                                        الأن!</button><br />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4" class="quize-text-wrapper" id="quiz_load" {{-- data-url="{{ route('student.quiz', [encryptFunction(@$data['lesson']->id)]) }}"> --}}
                    data-url="#">

                </div>

                <div class="col-md-12 mt-4" id="video-container" style=" display:none;position: relative;">
                    <!-- Close button -->
                    <button id="close-video-btn" class="btn btn-secondary"
                        style="position: absolute; top: 0px; left: 25px; z-index: 1000;">Close</button>
                    <!-- Video player will be inserted here -->
                </div>


                <div class="col-12">
                    <div class="news_courses_content mt-5 shadow-lg">
                        <h2 class="custom-section-title mb-5 custom-section-title-animation">
                            <span>محتوى</span>
                            <span>الكورس</span>
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </h2>

                        <div class="accordion course-accordion" id="accordionExample">
                            @foreach ($data['course']->sections as $section)
                                <div class="accordion-item my-5 p-3 shadow rounded-1 border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed gap-3" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#section_{{ $section->id }}"
                                            aria-expanded="false" aria-controls="section_{{ $section->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                                class="iconify iconify--ant-design" width="1em" height="1em"
                                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                                                <path fill="currentColor"
                                                    d="M464 144H160c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16m-52 268H212V212h200zm452-268H560c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16m-52 268H612V212h200zm52 132H560c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V560c0-8.8-7.2-16-16-16m-52 268H612V612h200zM424 712H296V584c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v128H104c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h128v128c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V776h128c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8">
                                                </path>
                                            </svg>
                                            <div>
                                                <div class="fs-2 fw-bold text-end mb-3">{{ $section->title }}</div>
                                                <span class="text-end d-block">
                                                    @if ($data['course']->category->parent == null)
                                                        {{ $data['course']->category->title }}
                                                    @else
                                                        {{ $data['course']->category->parent->title }}
                                                    @endif
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="section_{{ $section->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <!-- Start Accordion Children -->
                                            <div class="accordion course-children-accordion"
                                                id="video_{{ $section->id }}">
                                                <!-- Vedio -->
                                                @foreach ($section->allLesson as $lesson)
                                                    @php
                                                        $url = route('course.player', [
                                                            'slug' => $data['course']->slug,
                                                            'id' => $lesson->id,
                                                        ]);
                                                    @endphp
                                                    <div class="accordion-item rounded-1 border-0 mt-3">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed gap-3"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#{{ $lesson->id }}_video_1"
                                                                aria-expanded="false"
                                                                aria-controls="{{ $lesson->id }}_video_1">

                                                                {{-- Quize --}}
                                                                @if ($lesson->lesson_type == 'quiz' && $lesson->type == 1)
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        aria-hidden="true" role="img"
                                                                        class="quiz_icon" width="1em" height="1em"
                                                                        preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 256 256">
                                                                        <g fill="currentColor">
                                                                            <path
                                                                                d="M224 56v160l-32-16l-32 16l-32-16l-32 16l-32-16l-32 16V56a8 8 0 0 1 8-8h176a8 8 0 0 1 8 8"
                                                                                opacity=".2"></path>
                                                                            <path
                                                                                d="M216 40H40a16 16 0 0 0-16 16v160a8 8 0 0 0 11.58 7.16L64 208.94l28.42 14.22a8 8 0 0 0 7.16 0L128 208.94l28.42 14.22a8 8 0 0 0 7.16 0L192 208.94l28.42 14.22A8 8 0 0 0 232 216V56a16 16 0 0 0-16-16m0 163.06l-20.42-10.22a8 8 0 0 0-7.16 0L160 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L96 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L40 203.06V56h176Zm-155.58-35.9a8 8 0 0 0 10.74-3.58L76.94 152h38.12l5.78 11.58a8 8 0 1 0 14.32-7.16l-32-64a8 8 0 0 0-14.32 0l-32 64a8 8 0 0 0 3.58 10.74M96 113.89L107.06 136H84.94ZM136 128a8 8 0 0 1 8-8h16v-16a8 8 0 0 1 16 0v16h16a8 8 0 0 1 0 16h-16v16a8 8 0 0 1-16 0v-16h-16a8 8 0 0 1-8-8">
                                                                            </path>
                                                                        </g>
                                                                    </svg>
                                                                    {{-- Homework --}}
                                                                @elseif($lesson->lesson_type == 'quiz' && $lesson->type == 2)
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        aria-hidden="true" role="img"
                                                                        class="homework_icon" width="1em"
                                                                        height="1em" preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 24 24">
                                                                        <path fill="currentColor"
                                                                            d="M8 4v12h12V4zm6.74 10.69a.96.96 0 0 1-.73.31c-.29 0-.54-.1-.74-.31a1 1 0 0 1-.31-.74c0-.29.1-.54.31-.74s.45-.3.74-.3s.54.1.74.3s.3.45.3.74s-.11.54-.31.74m1.77-5.86c-.23.34-.54.69-.92 1.06c-.3.27-.51.52-.64.75q-.18.345-.18.78v.4h-1.52v-.56c0-.42.09-.78.26-1.09c.18-.32.49-.67.95-1.07c.32-.29.55-.54.69-.74q.21-.3.21-.72q0-.54-.36-.87c-.24-.23-.57-.34-.99-.34c-.4 0-.72.12-.97.36s-.42.53-.53.87l-1.37-.57c.18-.55.52-1.03 1-1.45c.49-.43 1.11-.64 1.85-.64c.56 0 1.05.11 1.49.33q.66.33 1.02.93c.36.6.36.84.36 1.33s-.11.9-.35 1.24"
                                                                            opacity=".3"></path>
                                                                        <path fill="currentColor"
                                                                            d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H8V4h12zm-6.49-5.84c.41-.73 1.18-1.16 1.63-1.8c.48-.68.21-1.94-1.14-1.94c-.88 0-1.32.67-1.5 1.23l-1.37-.57C11.51 5.96 12.52 5 13.99 5c1.23 0 2.08.56 2.51 1.26c.37.6.58 1.73.01 2.57c-.63.93-1.23 1.21-1.56 1.81c-.13.24-.18.4-.18 1.18h-1.52c.01-.41-.06-1.08.26-1.66m-.56 3.79c0-.59.47-1.04 1.05-1.04c.59 0 1.04.45 1.04 1.04c0 .58-.44 1.05-1.04 1.05c-.58 0-1.05-.47-1.05-1.05">
                                                                        </path>
                                                                    </svg>
                                                                @elseif($lesson->lesson_type == 'video-url')
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        aria-hidden="true" role="img"
                                                                        class="video_icon" width="1em" height="1em"
                                                                        preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 1024 1024">
                                                                        <path fill="currentColor" fill-opacity=".15"
                                                                            d="M136 792h576V232H136zm64-488c0-4.4 3.6-8 8-8h112c4.4 0 8 3.6 8 8v48c0 4.4-3.6 8-8 8H208c-4.4 0-8-3.6-8-8z">
                                                                        </path>
                                                                        <path fill="currentColor"
                                                                            d="M912 302.3L784 376V224c0-35.3-28.7-64-64-64H128c-35.3 0-64 28.7-64 64v576c0 35.3 28.7 64 64 64h592c35.3 0 64-28.7 64-64V648l128 73.7c21.3 12.3 48-3.1 48-27.6V330c0-24.6-26.7-40-48-27.7M712 792H136V232h576zm176-167l-104-59.8V458.9L888 399z">
                                                                        </path>
                                                                        <path fill="currentColor"
                                                                            d="M208 360h112c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H208c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8">
                                                                        </path>
                                                                    </svg>
                                                                @elseif($lesson->lesson_type == 'document_type' || $lesson->lesson_type == 'text')
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        aria-hidden="true" role="img"
                                                                        class="book_icon" width="2rem" height="2rem"
                                                                        preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 48 48">
                                                                        <defs>
                                                                            <mask id="iconifyReact_5">
                                                                                <g fill="none" stroke="#fff"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="4">
                                                                                    <path fill="#555"
                                                                                        d="M7 37V11a6 6 0 0 1 6-6h22v26H13c-3.3 0-6 2.684-6 6Z">
                                                                                    </path>
                                                                                    <path stroke-linecap="round"
                                                                                        d="M35 31H13a6 6 0 0 0 0 12h28V7M14 37h20">
                                                                                    </path>
                                                                                </g>
                                                                            </mask>
                                                                        </defs>
                                                                        <path fill="currentColor" d="M0 0h48v48H0z"
                                                                            mask="url(#iconifyReact_5)">
                                                                        </path>
                                                                    </svg>
                                                                @else
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        aria-hidden="true" role="img"
                                                                        class="video_icon" width="1em" height="1em"
                                                                        preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 1024 1024">
                                                                        <path fill="currentColor" fill-opacity=".15"
                                                                            d="M136 792h576V232H136zm64-488c0-4.4 3.6-8 8-8h112c4.4 0 8 3.6 8 8v48c0 4.4-3.6 8-8 8H208c-4.4 0-8-3.6-8-8z">
                                                                        </path>
                                                                        <path fill="currentColor"
                                                                            d="M912 302.3L784 376V224c0-35.3-28.7-64-64-64H128c-35.3 0-64 28.7-64 64v576c0 35.3 28.7 64 64 64h592c35.3 0 64-28.7 64-64V648l128 73.7c21.3 12.3 48-3.1 48-27.6V330c0-24.6-26.7-40-48-27.7M712 792H136V232h576zm176-167l-104-59.8V458.9L888 399z">
                                                                        </path>
                                                                        <path fill="currentColor"
                                                                            d="M208 360h112c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H208c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8">
                                                                        </path>
                                                                    </svg>
                                                                @endif
                                                                <div class="fs-5 fw-bold">{{ $lesson->title }}</div>
                                                            </button>
                                                        </h2>
                                                        <div id="{{ $lesson->id }}_video_1"
                                                            class="accordion-collapse collapse"
                                                            data-bs-parent="#video_{{ $section->id }}">
                                                            <div class="accordion-body mt-0 px-4 py-4">

                                                                <div class="d-flex flex-column">
                                                                    <div class="d-flex">
                                                                        <div class="d-flex flex-wrap gap-2">
                                                                            <span>

                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                    aria-hidden="true" role="img"
                                                                                    class="details_icon" width="1em"
                                                                                    height="1em"
                                                                                    preserveAspectRatio="xMidYMid meet"
                                                                                    viewBox="0 0 48 48">
                                                                                    <path fill="currentColor"
                                                                                        d="M0 0h48v48H0z"></path>
                                                                                    <path fill="#555"
                                                                                        d="M24 44c9.389 0 17-7.611 17-17s-7.611-17-17-17S7 17.611 7 27s7.611 17 17 17Z">
                                                                                    </path>
                                                                                    <path stroke="#fff"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="4"
                                                                                        stroke-linecap="round"
                                                                                        d="M18 4h12m-6 15v8m8 0h-8m0-23v4">
                                                                                    </path>
                                                                                </svg>
                                                                            </span>
                                                                            <span> المدة :</span>
                                                                            <div class="text-muted">
                                                                                {{ lesson_durations($lesson->id) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex">
                                                                        <div class="d-flex flex-wrap gap-2">
                                                                            <span>
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                    aria-hidden="true" role="img"
                                                                                    class="description_icon"
                                                                                    width="1em" height="1em"
                                                                                    preserveAspectRatio="xMidYMid meet"
                                                                                    viewBox="0 0 1024 1024">
                                                                                    <path fill="currentColor"
                                                                                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372">
                                                                                    </path>
                                                                                    <path fill="currentColor"
                                                                                        fill-opacity=".15"
                                                                                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372s372-166.6 372-372s-166.6-372-372-372m32 588c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V456c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8zm-32-344a48.01 48.01 0 0 1 0-96a48.01 48.01 0 0 1 0 96">
                                                                                    </path>
                                                                                    <path fill="currentColor"
                                                                                        d="M464 336a48 48 0 1 0 96 0a48 48 0 1 0-96 0m72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8">
                                                                                    </path>
                                                                                </svg>
                                                                            </span>
                                                                            <span>الوصف :</span>
                                                                            <span
                                                                                class="text-muted">{!! $lesson->description !!}</span>
                                                                        </div>
                                                                    </div>

                                                                    <div
                                                                        class="d-flex @if (viewLesson($data['course']->id, $lesson->id) === 'auth') d-none @endif">
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-between flex-wrap w-100">
                                                                            <a
                                                                                @if (@$data['course']->firstLesson) href="#" @else href="#" @endif>
                                                                                @if (auth()->check() &&
                                                                                        \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $data['course']->id)->count() > 0)
                                                                                    <div>

                                                                                        {{-- {{ dd(viewLesson($data['course']->id, $lesson->id)) }} --}}

                                                                                        @if ($lesson->lesson_type == 'quiz' && $lesson->type == 1)
                                                                                            <span>
                                                                                                <a style="cursor: pointer;"
                                                                                                    @if (!viewLesson($data['course']->id, $lesson->id)) onclick="showLessonError(event)" @endif
                                                                                                    class="btn-outline btn-outline-red show-video-btn"
                                                                                                    href="{{ viewLesson($data['course']->id, $lesson->id) ? $url : 'javascript:void(0);' }}">
                                                                                                    حل الامتحان
                                                                                                </a>
                                                                                            </span>
                                                                                        @elseif($lesson->lesson_type == 'quiz' && $lesson->type == 2)
                                                                                            <span>
                                                                                                <a style="cursor: pointer;"
                                                                                                    @if (!viewLesson($data['course']->id, $lesson->id)) onclick="showLessonError(event)" @endif
                                                                                                    class="btn-outline btn-outline-green show-video-btn"
                                                                                                    href="{{ viewLesson($data['course']->id, $lesson->id) ? $url : 'javascript:void(0);' }}">
                                                                                                    حل الواجب
                                                                                                </a>
                                                                                            </span>
                                                                                        @elseif($lesson->lesson_type == 'document_type' || $lesson->lesson_type == 'text')
                                                                                            <span>
                                                                                                <a style="cursor: pointer;"
                                                                                                    @if (!viewLesson($data['course']->id, $lesson->id)) onclick="showLessonError(event)" @endif
                                                                                                    class="btn-outline btn-outline-blue show-video-btn"
                                                                                                    href="{{ viewLesson($data['course']->id, $lesson->id) ? $url : 'javascript:void(0);' }}">
                                                                                                    فتح الملف
                                                                                                </a>
                                                                                            </span>
                                                                                        @elseif($lesson->lesson_type == 'video-url')
                                                                                            <span><a style="cursor: pointer;"
                                                                                                    @if (!viewLesson($data['course']->id, $lesson->id)) onclick="showLessonError(event)" @endif
                                                                                                    class="btn-outline btn-outline-yellow show-video-btn"
                                                                                                    href="{{ viewLesson($data['course']->id, $lesson->id) ? $url : 'javascript:void(0);' }}">شاهد
                                                                                                    الان</a>
                                                                                            </span>
                                                                                        @else
                                                                                            <span><a style="cursor: pointer;"
                                                                                                    @if (!viewLesson($data['course']->id, $lesson->id)) onclick="showLessonError(event)" @endif
                                                                                                    class="btn-outline btn-outline-yellow show-video-btn"
                                                                                                    href="{{ viewLesson($data['course']->id, $lesson->id) ? $url : 'javascript:void(0);' }}">شاهد
                                                                                                    الان</a>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                @endif
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- End Accordion Children -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('frontend/js/student/main.js') }}" type="module"></script>
    <script src="{{ asset('frontend/js/student/quiz.js') }}" type="module"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "نجاح!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "حسناً"
            });
        </script>
    @endif


    <script>
        function showLessonError(event) {
            event.preventDefault();
            Swal.fire({
                title: "خطأ!",
                text: "لا يمكن الدخول إلى الدرس، برجاء الرجوع إلى الدرس السابق",
                icon: "error",
                confirmButtonText: "حسناً"
            });
        }
        // window.showLessonError = showLessonError;
    </script>
    @include('theme::includes.addCart')
@endsection
