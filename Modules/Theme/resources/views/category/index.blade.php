@extends('theme::layouts.master')
<style>
    .courses,
    .lecuture {
        text-align: center;
        font-size: 33px;
        font-weight: 500;
    }

    .courses_button,
    .lecuture_button {
        padding: 0 !important;
        width: 150px;
        font-size: 2rem !important;
        background: #14b7ac !important;
        border: #14b7ac !important;

    }

    .courses_button.collapsed,
    .lecuture_button.collapsed {
        display: inline-block;
    }

    .courses_button:not(.collapsed),
    .lecuture_button:not(.collapsed) {
        display: none;
    }

    .section_courses_button {
        background: #DDD !important;
        color: #000 !important;
        border: 2px solid #777777 !important;
    }
</style>

@section('content')
    @include('theme::includes.banner')

    <!-- Start Features Section -->
    @include('theme::includes.features');
    <!-- End Features Section -->

    <!-- Start Courses Section-->
    <section class="courses-accordion-section" id="courses-accordion-section" dir="rtl">
        <h2 class="section-title-modern display-5 mb-5">{{ $mainCategory->title ?? '' }}</h2>
        <div class="section-background-container">
            <div class="animated-blob blob-1"></div>
            <div class="animated-blob blob-2"></div>
            <div class="animated-blob blob-3"></div>
            <svg class="animated-svg svg-1" viewBox="0 0 100 100">
                <path d="M 10 10 L 90 90 M 10 90 L 90 10" stroke-dasharray="4, 4" />
            </svg>
            <svg class="animated-svg svg-2" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke-dasharray="8, 8" />
            </svg>
            <svg class="animated-svg svg-3" viewBox="0 0 100 100">
                <rect x="10" y="10" width="80" height="80" rx="15" />
            </svg>
            <svg class="animated-svg svg-4" viewBox="0 0 100 100">
                <path d="M 20 20 C 80 20, 20 80, 80 80" stroke-dasharray="5, 5" />
            </svg>
        </div>

        <div class="container-fluid">
            <div class="news_courses_content">
                <div
                    class="flex items-center md:space-x-20 md:space-x-reverse flex-col md:flex-row space-y-8 md:space-y-0 flex-wrap">
                    @foreach ($categories as $category)
                        <div class="course-category-item">
                            <div class="category-header {{ $loop->first ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                                data-bs-target="#collapseSystem{{ $category->id }}"
                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                aria-controls="collapseSystem{{ $category->id }}">
                                @php
                                    $text = $category->title;
                                    $length = Str::length($text);
                                    $half = floor($length / 2);
                                    $firstHalf = Str::substr($text, 0, $half);
                                    $secondHalf = Str::substr($text, $half);
                                @endphp
                                <h2 class="category-title">
                                    {{ $firstHalf }}
                                    <span class="subtitle-tag">{{ $secondHalf }}</span>
                                </h2>
                                <button class="toggle-btn">
                                    <i data-lucide="chevron-down"></i>
                                </button>
                            </div>


                            <div class="collapse {{ $loop->first ? 'show' : '' }}" id="collapseSystem{{ $category->id }}">
                                <div class="courses-grid">
                                    <div class="row g-5">
                                        @php
                                            $systemCourses = $courses->where('category_id', $category->id);
                                        @endphp
                                        @if ($systemCourses->isNotEmpty())
                                            @foreach ($systemCourses as $course)
                                                <div
                                                    class="col-xxl-3 col-lg-4 col-md-6 d-flex align-items-stretch course-card-wrapper @if (auth()->check() &&
                                                            \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $course->id)->exists()) is-enrolled @elseif ($course->is_paid == 0 && ($course->price == 0 || $course->price < 0 || $course->price === null)) is-free @endif">
                                                    <div class="course-card">
                                                        <div class="card-image-layer">
                                                            <img src="{{ get_image($course->thumbnail ?? '') }}"
                                                                class="card-image" alt="{{ $course->title }}" />
                                                        </div>
                                                        <div class="card-content-area">
                                                            <div class="hover-background"></div>
                                                            <div class="price-orb">
                                                                @if (auth()->check() &&
                                                                        \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $course->id)->exists())
                                                                    <span class="status-text">مشترك</span>
                                                                @elseif ($course->is_paid == 0 && ($course->price == 0 || $course->price < 0 || $course->price === null))
                                                                    <span class="status-text">مجاني</span>
                                                                @else
                                                                    @if ($course->discount_flag == 1)
                                                                        <span class="old-price-orb"><s>{{ $course->price }}
                                                                                جنيهًا</s></span>
                                                                        <span
                                                                            class="current-price-orb">{{ $course->discount_price }}</span>
                                                                    @else
                                                                        <span
                                                                            class="current-price-orb">{{ $course->price }}
                                                                            </br>
                                                                            جنيهًا </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="card-body">
                                                                <a href="{{ route('theme.course.details', $course->id) }}"
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
                                                                            تحديث:{{ \Carbon\Carbon::parse(lastUpdate($course->id))->isoFormat('dddd، D MMMM YYYY') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                @php
                                                                    if (auth()->check()) {
                                                                        $watch_history = App\Models\Watch_history::where(
                                                                            'course_id',
                                                                            $course->id,
                                                                        )
                                                                            ->where('student_id', auth()->user()->id)
                                                                            ->first();
                                                                        $lesson = App\Models\Lesson::where(
                                                                            'course_id',
                                                                            $course->id,
                                                                        )
                                                                            ->orderBy('sort', 'asc')
                                                                            ->first();
                                                                        $lesson_id = null;

                                                                        if (
                                                                            $watch_history &&
                                                                            $watch_history->watching_lesson_id
                                                                        ) {
                                                                            $lesson_id =
                                                                                $watch_history->watching_lesson_id;
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
                                                                        $url = route('course.player', [
                                                                            'slug' => $course->slug,
                                                                        ]);
                                                                    }
                                                                @endphp
                                                                @if (auth()->check() &&
                                                                        \App\Models\Enrollments::where('user_id', auth()->user()->id)->where('course_id', $course->id)->exists())
                                                                    {{-- <a href="{{ route('theme.course.details', $course->id) }}" class="btn btn-view-course">
                                                                            <i data-lucide="play-circle" class="me-2"></i>
                                                                            عرض الكورس
                                                                        </a> --}}



                                                                    <button class="btn btn-view-course"
                                                                        onclick="window.location='{{ $url }}'">
                                                                        <i data-lucide="play-circle" class="me-2"></i>
                                                                        عرض الكورس
                                                                    </button>
                                                                @elseif($course->is_paid == 0 && ($course->price == 0 || $course->price < 0 || $course->price === null))
                                                                    <button type="button" class="btn btn-action"
                                                                        onclick="window.location.href='{{ route('payment.successFree', $course->id) }}'">
                                                                        <i data-lucide="gift" class="me-2"></i>
                                                                        ابدأ مجانًا
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-action add-to-cart"
                                                                        element-type="course"
                                                                        id-element="{{ $course->id }}">
                                                                        <i data-lucide="shopping-cart" class="me-2"></i>
                                                                        اشترك الآن
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>لا توجد كورسات متاحة لهذا النظام.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>







            </div>
        </div>
    </section>
    <!-- End Courses Section-->
    <!-- start bootcamp secction -->
    <section class="academic-years-tilt-section" id="years-section" dir="rtl" style="padding: 0px 0px 70px 0px;">
        <div class="section-bg-shapes">
            <div class="shape-1"></div>
            <div class="shape-2"></div>
            <div class="shape-3"></div>
            <div class="shape-4"></div>
        </div>
        <div class="container">
            <h2 class="section-title-modern display-5">المعسكرات  </h2>


            <div class="row g-5 justify-content-center">
                @foreach ($bootcampCategories as $bootcamp_cat)

                    <div class="col-lg-4 col-md-6 ">
                        <a href="{{ route('theme.bootcamps',$bootcamp_cat->slug) }}" class="year-card-tilt">
                            <div class="card-inner-content">
                                <img src="{{ get_image($bootcamp_cat->thumbnail ?? '') }}" class="card-img-top"
                                    alt=">{{ $bootcamp_cat->title }}" />
                                <div class="card-content-wrapper">
                                    <h3 class="year-title">{{ $bootcamp_cat->title }}</h3>
                                </div>
                                <span class="btn btn-view-courses">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <span>عرض الحصص</span>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- end bootcamp section -->

    {{-- // book section  --}}
    @include('theme::includes.book')
    {{-- @include('theme::includes.addCart') --}}


    <!-- End Books Section -->
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const section = document.getElementById("courses-accordion-section");
            if (section) {
                section.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', 'YOUR_PIXEL_ID'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=YOUR_PIXEL_ID&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();

            // Animate cards on scroll into view
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const wrappersInView = entry.target.querySelectorAll(
                                ".course-card-wrapper"
                            );
                            wrappersInView.forEach((wrapper, index) => {
                                setTimeout(() => {
                                    wrapper.classList.add("is-visible");
                                }, index * 150);
                            });
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                }
            );

            const sectionToObserve = document.querySelector(".courses-section");
            if (sectionToObserve) {
                observer.observe(sectionToObserve);
            }

            const collapses = document.querySelectorAll('.collapse');
            collapses.forEach(collapse => {
                collapse.addEventListener('shown.bs.collapse', function() {
                    initReadMoreButtons(collapse);
                });
            });

            // ممكن تشغلها مبدئيا لأي عنصر مفتوح بشكل افتراضي
            document.querySelectorAll('.collapse.show').forEach(openCollapse => {
                initReadMoreButtons(openCollapse);
            });

            function initReadMoreButtons(container) {
                const wrappers = container.querySelectorAll(".course-card-wrapper");

                wrappers.forEach((wrapper) => {
                    const oldBtn = wrapper.querySelector(".btn-read-more");
                    const drawer = wrapper.querySelector(".description-wrapper");
                    const content = wrapper.querySelector(".info-content");

                    if (!oldBtn || !drawer || !content) return;

                    // ننسخ الزرار عشان نمسح أي events قديمة
                    const newBtn = oldBtn.cloneNode(true);
                    oldBtn.parentNode.replaceChild(newBtn, oldBtn);

                    const btnText = newBtn.querySelector(".btn-text");

                    // إخفاء الزرار لو المحتوى قصير
                    if (content.scrollHeight <= 50) {
                        newBtn.style.display = "none";
                    }

                    // إعادة ربط الحدث
                    newBtn.addEventListener("click", () => {
                        drawer.classList.toggle("expanded");
                        btnText.textContent = drawer.classList.contains("expanded") ?
                            "إخفاء" :
                            "اقرأ المزيد";
                    });
                });
            }

        });
    </script>
@endsection
