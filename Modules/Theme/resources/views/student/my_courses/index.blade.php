@extends('theme::layouts.master')

{{-- @extends('layouts.default') --}}

@push('title', get_phrase('My courses'))
{{-- @push('meta')@endpush
@push('css')@endpush --}}
@section('content')
    <section class="myCourses main_content" dir="rtl">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')

                <div class="col-lg-9 px-4">
                    <h4 class="g-title">كورساتى</h4>
                    <div class="row mt-5 row-gap-5">
                        @foreach ($my_courses as $course)
                            @php
                                $course_progress = progress_bar($course->course_id);
                            @endphp
                            {{-- <div class="col-xxl-4 col-lg-6 mt-5">

                                <div class="course-card offer">
                                    <div class="course-card-header">
                                        <img src="{{ get_image($course->thumbnail) }}" class="card-img-top"
                                            alt="{{ $course->title }}" />
                                    </div>
                                    <div class="course-card-body">
                                        <header>
                                            <div class="course-card-body-title">
                                                <h4>{{ $course->title }}</h4>
                                                <div class="single-progress">
                                                    <p>{{ $course_progress }}%</p>
                                                    <div class="course_progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="course_progress-bar" style="width: {{ $course_progress }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-card-body-buttons">


                                                @php
                                                    $watch_history = App\Models\Watch_history::where('course_id', $course->course_id)
                                                        ->where('student_id', auth()->user()->id)
                                                        ->first();

                                                    $lesson = App\Models\Lesson::where('course_id', $course->course_id)
                                                        ->orderBy('sort', 'asc')
                                                        ->first();

                                                    if (!$watch_history && !$lesson) {
                                                        $url = route('course.player', ['slug' => $course->slug]);
                                                    } else {
                                                        if ($watch_history) {
                                                            $lesson_id = $watch_history->watching_lesson_id;
                                                        } elseif ($lesson) {
                                                            $lesson_id = $lesson->id;
                                                        }
                                                        $url = route('course.player', ['slug' => $course->slug, 'id' => $lesson_id]);
                                                    }

                                                @endphp


                                                @if ($course->expiry_date > 0 && $course->expiry_date < time())
                                                    <a href="{{ route('theme.purchase.course', ['course_id' => $course->course_id]) }}">
                                                        <button class="button-outline">تجديد</button>
                                                    </a>
                                                @else
                                                    @if ($course_progress > 0)
                                                        <a href="{{ $url }}">
                                                            <button class="button-outline">إستكمال الكورس</button>
                                                        </a>
                                                    @else
                                                        <a href="{{ $url }}">
                                                            <button class="button-outline">أبدأ الأن</button>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </header>
                                        <hr class="separated-line" />
                                        <footer>
                                            <div class="course-date">
                                                <div
                                                    class="d-flex justify-content-between align-items-center gap-1">
                                                    @php
                                                        \Carbon\Carbon::setLocale('ar');
                                                    @endphp
                                                    <div>
                                                        <span>
                                                            <!-- SVG Icon for created_at -->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="iconify iconify--icon-park-twotone"
                                                                width="1em" height="1em"
                                                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48">
                                                                <defs>
                                                                    <mask id="{{ $course->id }}">
                                                                        <g fill="none" stroke="#fff"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="4">
                                                                            <path fill="#555"
                                                                                d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20">
                                                                            </path>
                                                                            <path
                                                                                d="M33.542 27c-1.274 4.057-5.064 7-9.542 7c-4.477 0-8.268-2.943-9.542-7v6m19.084-18v6c-1.274-4.057-5.064-7-9.542-7c-4.477 0-8.268 2.943-9.542 7">
                                                                            </path>
                                                                        </g>
                                                                    </mask>
                                                                </defs>
                                                                <path fill="currentColor" d="M0 0h48v48H0z"
                                                                    mask="url(#{{ $course->id }})"></path>
                                                            </svg>
                                                        </span>
                                                        <span> الانشاء : </span>
                                                    </div>
                                                    <span>{{ \Carbon\Carbon::parse($course->created_at)->isoFormat('dddd، D MMMM YYYY') }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center gap-1">
                                                    <div>
                                                        <span>
                                                            <!-- SVG Icon for updated_at -->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="iconify iconify--ic" width="1em"
                                                                height="1em" preserveAspectRatio="xMidYMid meet"
                                                                viewBox="0 0 24 24">
                                                                <path fill="currentColor"
                                                                    d="m11.17 8l-.59-.59L9.17 6H4v12h16V8zM14 10h2v2h2v2h-2v2h-2v-2h-2v-2h2z"
                                                                    opacity=".3"></path>
                                                                <path fill="currentColor"
                                                                    d="M20 6h-8l-2-2H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2m0 12H4V6h5.17l1.41 1.41l.59.59H20zm-8-4h2v2h2v-2h2v-2h-2v-2h-2v2h-2z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                        <span> أخر تحديث : </span>
                                                    </div>
                                                    <span>{{ \Carbon\Carbon::parse(lastUpdate($course->course_id))->isoFormat('dddd، D MMMM YYYY') }}</span>
                                                </div>
                                            </div>
                                        </footer>
                                    </div>
                                </div>

                            </div> --}}


                            <div
                                class="col-lg-4 col-md-6 d-flex align-items-stretch course-card-wrapper
                            @if (auth()->check() &&
                                    \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $course->course_id)->exists()) is-enrolled @elseif ($course->is_paid == 0 && ($course->price == 0 || $course->price < 0 || $course->price === null)) is-free @endif">
                                <div class="course-card">
                                    <div class="card-image-layer">
                                        <img src="{{ get_image($course->thumbnail ?? '') }}" class="card-image"
                                            alt="{{ $course->title }}" />
                                    </div>
                                    <div class="card-content-area">
                                        <div class="hover-background"></div>
                                        <div class="price-orb">
                                            @if (auth()->check() &&
                                                    \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $course->course_id)->exists())
                                                <span class="status-text">مشترك</span>
                                            @elseif ($course->is_paid == 0 && ($course->price == 0 || $course->price < 0 || $course->price === null))
                                                <span class="status-text">مجاني</span>
                                            @else
                                                @if ($course->discount_flag == 1)
                                                    <span class="old-price-orb"><s>{{ $course->price }}
                                                            جنيهًا</s></span>
                                                    <span class="current-price-orb">{{ $course->discount_price }}</span>
                                                @else
                                                    <span class="current-price-orb">{{ $course->price }} </br>
                                                        جنيهًا </span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ route('theme.course.details', $course->course_id) }}"
                                                class="course-title">{{ $course->title }}</a>
                                            <div class="description-wrapper">
                                                <div class="info-content">
                                                    <p>
                                                        @if (get_theme_settings('course_status') == 1)
                                                            <p>{!! $course->description !!}</p>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <button class="btn-read-more">
                                                <span class="btn-text">اقرأ المزيد</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <div class="course-dates">
                                                @php
                                                    \Carbon\Carbon::setLocale('ar');
                                                @endphp
                                                <div class="date-item">
                                                    <i data-lucide="calendar-plus"></i>
                                                    <span>تاريخ الإنشاء:
                                                        {{ \Carbon\Carbon::parse($course->created_at)->isoFormat('dddd، D MMMM YYYY') }}</span>
                                                </div>
                                                <div class="date-item">
                                                    <i data-lucide="history"></i>
                                                    <span>آخر
                                                        تحديث:{{ \Carbon\Carbon::parse(lastUpdate($course->course_id))->isoFormat('dddd، D MMMM YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @php
                                                if (auth()->check()) {
                                                    $watch_history = App\Models\Watch_history::where(
                                                        'course_id',
                                                        $course->course_id,
                                                    )
                                                        ->where('student_id', auth()->user()->id)
                                                        ->first();
                                                    $lesson = App\Models\Lesson::where('course_id', $course->course_id)
                                                        ->orderBy('sort', 'asc')
                                                        ->first();
                                                    $lesson_id = null;

                                                    if ($watch_history && $watch_history->watching_lesson_id) {
                                                        $lesson_id = $watch_history->watching_lesson_id;
                                                    } elseif ($lesson) {
                                                        $lesson_id = $lesson->id;
                                                    }

                                                    if ($lesson_id) {
                                                        $url = route('course.player', [
                                                            'slug' => $course->slug,
                                                            'id' => $lesson_id,
                                                        ]);
                                                    } else {
                                                        $url = route('course.player', [
                                                            'slug' => $course->slug,
                                                        ]);
                                                    }
                                                } else {
                                                    $url = route('course.player', ['slug' => $course->slug]);
                                                }
                                            @endphp
                                            @if (auth()->check() &&
                                                    \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $course->course_id)->exists())
                                                <button class="btn btn-view-course"
                                                    onclick="window.location='{{ $url }}'">
                                                    <i data-lucide="play-circle" class="me-2"></i>
                                                    عرض الكورس
                                                </button>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($my_courses->count() == 0)
                            <div class="row bg-white radius-10">
                                <div class="com-md-12">
                                    @include('frontend.default.empty')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if (count($my_courses) > 0)
                <div class="entry-pagination">
                    <nav aria-label="Page navigation example">
                        {{ $my_courses->links() }}
                    </nav>
                </div>
            @endif
            <!-- Pagination -->
        </div>
    </section>
    <!------------ My wishlist area End  ------------>
@endsection
@push('js')

@endpush
