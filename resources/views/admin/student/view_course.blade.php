@extends('layouts.admin')

@push('title', get_phrase('viewEnrolCourse'))

@push('meta')
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #f72585;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border-radius: 12px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        /* بطاقات الدورات */
        .courses-section {
            margin-bottom: 40px;
            position: relative;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark);
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .courses-container {
            position: relative;
            overflow: hidden;
            padding: 10px 0;
        }

        .courses-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 25px;
            padding: 10px 5px;
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #f0f0f0;
        }

        .courses-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .courses-scroll::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 4px;
        }

        .courses-scroll::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        .course-card {
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            min-width: 320px;
            flex-shrink: 0;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .course-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .course-header {
            padding: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            position: relative;
        }

        .course-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: var(--accent);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .course-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .course-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .course-body {
            padding: 20px;
        }

        .course-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .progress-container {
            margin-bottom: 15px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .progress-bar {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--success), var(--primary));
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .course-date {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* تحسينات قسم الدروس */
        .course-lessons {
            margin-bottom: 15px;
            position: relative;
        }

        .lessons-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .lessons-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
        }

        .lessons-scroll-controls {
            display: flex;
            gap: 5px;
        }

        .lesson-scroll-btn {
            width: 24px;
            height: 24px;
            background-color: #f0f0f0;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            cursor: pointer;
            transition: var(--transition);
            color: var(--gray);
        }

        .lesson-scroll-btn:hover {
            background-color: var(--primary);
            color: white;
        }

        .lesson-scroll-btn.hidden {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .lesson-scroll-btn.hidden:hover {
            background-color: #f0f0f0;
            color: var(--gray);
        }

        .lessons-container {
            position: relative;
            overflow: hidden;
        }

        .lessons-scroll {
            display: flex;
            flex-direction: column;
            max-height: 200px;
            overflow-y: auto;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: var(--gray) #f0f0f0;
            padding-right: 5px;
        }

        .lessons-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .lessons-scroll::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 3px;
        }

        .lessons-scroll::-webkit-scrollbar-thumb {
            background: var(--gray);
            border-radius: 3px;
        }

        .lesson-item {
            display: flex;
            align-items: center;
            padding: 10px 8px;
            border-bottom: 1px solid #f0f0f0;
            transition: var(--transition);
        }

        .lesson-item:hover {
            background-color: #f8f9fa;
            border-radius: 6px;
        }

        .lesson-item:last-child {
            border-bottom: none;
        }

        .lesson-icon {
            width: 28px;
            height: 28px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            font-size: 12px;
            color: var(--gray);
            flex-shrink: 0;
            transition: var(--transition);
        }

        .lesson-completed .lesson-icon {
            background-color: var(--success);
            color: white;
        }

        .lesson-name {
            flex: 1;
            font-size: 14px;
            line-height: 1.4;
            margin-left: 8px;
        }

        .lesson-duration {
            font-size: 12px;
            color: var(--gray);
            flex-shrink: 0;
            background-color: #f8f9fa;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            width: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: white;
            border: none;
            border-radius: 50%;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: var(--transition);
        }

        .scroll-btn:hover {
            background-color: var(--primary);
            color: white;
        }

        .scroll-btn.prev {
            right: 10px;
        }

        .scroll-btn.next {
            left: 10px;
        }

        .scroll-btn.hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .course-card {
                min-width: 280px;
            }

            .scroll-btn {
                display: none;
            }

            .lessons-scroll-controls {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="ol-card radius-8px">
        <div class="ol-card-body my-3 py-12px px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('All Course') }} <span class="text-muted">({{ $courses->count() }})</span>
                </h4>
            </div>
        </div>
    </div>

    @if (count($courses) > 0)
        <div class="courses-section">
            <div class="section-header">
                <h2 class="section-title">جميع الدورات ({{ count($courses) }})</h2>
            </div>

            <div class="courses-container">
                <button class="scroll-btn prev hidden">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <div class="courses-scroll" id="coursesScroll">
                    @foreach ($courses as $enrol)
                        <div class="course-card">
                            <img src="{{ get_image($enrol->course->thumbnail ?? '') }}" class="course-image"
                                alt="{{ $enrol->course->title ?? '' }}">

                            <div class="course-header">
                                <h3 class="course-title">{{ $enrol->course->title ?? '' }}</h3>
                            </div>

                            <div class="course-body">
                                <div class="course-price">
                                    @if ($enrol->course->discount_price > 0)
                                        {{ $enrol->course->discount_price ?? '' }}   L.E
                                        <del> {{ $enrol->course->price ?? '' }}  L.E</del>
                                    @else
                                        {{ $enrol->course->price ?? '' }}  L.E
                                    @endif

                                </div>

                                <div class="progress-container">
                                    <div class="progress-info">
                                        @php $course_progress = progress_bar_admin($enrol->course->id , $enrol->user_id); @endphp
                                        <span>التقدم</span>
                                        <span>{{ $course_progress }}%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ $course_progress }}%"></div>
                                    </div>
                                </div>

                                <div class="course-date">
                                    <i class="far fa-calendar-alt"></i>
                                      <span>{{ optional($enrol->created_at)->format('Y-m-d') }}</span>
                                </div>

                                <div class="course-lessons">
                                    <div class="lessons-header">
                                        <div class="lessons-title">دروس الكورس ({{ count($enrol->course->lessons) }})</div>
                                        <div class="lessons-scroll-controls">
                                            <button class="lesson-scroll-btn lesson-prev-btn"
                                                data-course="{{ $enrol->course->id }}">
                                                <i class="fas fa-chevron-up"></i>
                                            </button>
                                            <button class="lesson-scroll-btn lesson-next-btn"
                                                data-course="{{ $enrol->course->id }}">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="lessons-container">
                                        <div class="lessons-scroll" id="lessonsScroll-{{ $enrol->course->id }}">
                                            @foreach ($enrol->course->lessons as $lesson)
                                                @php
                                                    $lessonCompleted = \App\Models\Watch_history::whereJsonContains(
                                                        'completed_lesson',
                                                        (string) $lesson->id,
                                                    )
                                                        ->where('student_id', $enrol->user_id)
                                                        ->exists();
                                                @endphp
                                                <div class="lesson-item {{ $lessonCompleted ? 'lesson-completed' : '' }}">
                                                    <div class="lesson-icon">
                                                        @if ($lessonCompleted)
                                                            <i class="fas fa-check"></i>
                                                        @else
                                                            <i class="far fa-play-circle"></i>
                                                        @endif
                                                    </div>
                                                    <div class="lesson-name">{{ $lesson->title ?? '' }}</div>
                                                    <div class="lesson-duration">{{ $lesson->duration ?? '' }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="scroll-btn next">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
        </div>
    @else
        @include('admin.no_data')
    @endif
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التمرير الأفقي للبطاقات
            const scrollContainer = document.getElementById('coursesScroll');
            const prevBtn = document.querySelector('.scroll-btn.prev');
            const nextBtn = document.querySelector('.scroll-btn.next');

            function updateScrollButtons() {
                const scrollLeft = scrollContainer.scrollLeft;
                const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

                if (scrollLeft <= 10) {
                    prevBtn.classList.add('hidden');
                } else {
                    prevBtn.classList.remove('hidden');
                }

                if (scrollLeft >= maxScrollLeft - 10) {
                    nextBtn.classList.add('hidden');
                } else {
                    nextBtn.classList.remove('hidden');
                }
            }

            nextBtn.addEventListener('click', function() {
                scrollContainer.scrollBy({
                    left: 350,
                    behavior: 'smooth'
                });
            });

            prevBtn.addEventListener('click', function() {
                scrollContainer.scrollBy({
                    left: -350,
                    behavior: 'smooth'
                });
            });

            scrollContainer.addEventListener('scroll', updateScrollButtons);
            window.addEventListener('resize', updateScrollButtons);
            updateScrollButtons();

            // التمرير العمودي للدروس
            document.querySelectorAll('.lessons-scroll').forEach(lessonScroll => {
                const courseId = lessonScroll.id.split('-')[1];
                const prevBtn = document.querySelector(`.lesson-prev-btn[data-course="${courseId}"]`);
                const nextBtn = document.querySelector(`.lesson-next-btn[data-course="${courseId}"]`);

                function updateLessonScrollButtons() {
                    const scrollTop = lessonScroll.scrollTop;
                    const maxScrollTop = lessonScroll.scrollHeight - lessonScroll.clientHeight;

                    if (scrollTop <= 10) {
                        prevBtn.classList.add('hidden');
                    } else {
                        prevBtn.classList.remove('hidden');
                    }

                    if (scrollTop >= maxScrollTop - 10) {
                        nextBtn.classList.add('hidden');
                    } else {
                        nextBtn.classList.remove('hidden');
                    }
                }

                if (prevBtn && nextBtn) {
                    prevBtn.addEventListener('click', function() {
                        lessonScroll.scrollBy({
                            top: -80,
                            behavior: 'smooth'
                        });
                    });

                    nextBtn.addEventListener('click', function() {
                        lessonScroll.scrollBy({
                            top: 80,
                            behavior: 'smooth'
                        });
                    });

                    lessonScroll.addEventListener('scroll', updateLessonScrollButtons);
                    updateLessonScrollButtons();
                }
            });
        });
    </script>
@endpush
