@php
    $sections = App\Models\Section::where('course_id', $course_details->id)
        ->orderBy('sort')
        ->get();

    $completed_lesson = json_decode(
        App\Models\Watch_history::where('course_id', $course_details->id)
            ->where('student_id', Auth()->user()->id)
            ->value('completed_lesson'),
        true,
    ) ?? [];
    $active_section = App\Models\Lesson::where('id', $history->watching_lesson_id ?? '')->value('section_id');

    $lesson_history = App\Models\Watch_history::where('course_id', $course_details->id)
        ->where('student_id', auth()->user()->id)
        ->firstOrNew();
    $completed_lesson_arr = json_decode($lesson_history->completed_lesson, true);
    $complated_lesson = is_array($completed_lesson_arr) ? count($completed_lesson_arr) : 0;
    $course_progress_out_of_100 = progress_bar($course_details->id);

    $user_id = Auth()->user()->id;
    $is_course_instructor = is_course_instructor($course_details->id, $user_id);

    $is_locked = 0;
    $locked_lesson_ids = array();
@endphp

<style>
    .checkbox-icon {
        color: rgb(var(--c-accent-rgb));
    }
</style>

<div class="course-content-playlist">
    <div class="row border-bottom pb-3">
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between flex-row-reverse">
                <h3 class="heading mb-2">{{ ucfirst($course_details->title) }}</h3>

                <div class="d-flex gap-2 align-items-center justify-content-center">
                    <div class="course-progress">
                        <svg width="40" height="40" viewBox="0 0 40 40">
                            <circle
                                cx="20"
                                cy="20"
                                r="17"
                                stroke="var(--theme-secondary-background)"
                                stroke-width="4"
                                fill="none"
                            />
                            <circle
                                cx="20"
                                cy="20"
                                r="17"
                                stroke="rgb(var(--c-accent-rgb))"
                                stroke-width="4"
                                fill="none"
                                stroke-dasharray="106.81"
                                stroke-dashoffset="calc(106.81 - (106.81 * {{ $course_progress_out_of_100 / 100 }}))"
                                transform="rotate(-90 20 20)"
                                stroke-linecap="round"
                            />
                            <text
                                x="50%"
                                y="50%"
                                text-anchor="middle"
                                dy=".3em"
                                font-size="10"
                                fill="var(--theme-color)"
                            >
                                {{ $complated_lesson }} of {{ lesson_count($course_details->id) }}
                            </text>
                        </svg>

                        {{-- <svg width="30" height="30" viewBox="0 0 30 30">
                            <circle
                                cx="15"
                                cy="15"
                                r="12"
                                stroke="var(--theme-secondary-background)"
                                stroke-width="4"
                                fill="none"
                            />
                            <circle
                                cx="15"
                                cy="15"
                                r="12"
                                stroke="rgb(var(--c-accent-rgb))"
                                stroke-width="4"
                                fill="none"
                                stroke-dasharray="75.4"
                                stroke-dashoffset="calc(75.4 - (75.4 * {{ $course_progress_out_of_100 / 100 }}))"
                                transform="rotate(-90 15 15)"
                                stroke-linecap="round"
                            />
                        </svg> --}}
                    </div>
                    {{-- <div class="progress-text me-2">
                        <p> {{ $complated_lesson }} of {{ lesson_count($course_details->id) }} </p>
                    </div> --}}
                </div>
            </div>

            {{-- <p class="info text-14px text-center mb-1">{{ $course_progress_out_of_100 }}% {{ get_phrase('Completed') }}
                ({{ $complated_lesson }}/{{ lesson_count($course_details->id) }})
            </p> --}}
        </div>
    </div>

    <div class="course-playlist-accordion" dir="rtl">
        <div class="accordion course-accordion" id="coursePlay">
            @foreach ($sections as $section)
                @php
                      $now = now()->format('Y-m-d H:i');


                    $lessons = App\Models\Lesson::where(['status'=>1,'section_id'=> $section->id])->active()
                        ->orderBy('sort')
                        ->get();

                        //  $lessons = App\Models\Lesson::where('status',1)->where('section_id',$section->id)
                        //  ->where('start_time','<=',$now)
                        // ->orderBy('sort')
                        // ->get();
                        // dd($lessons);
                @endphp

                <div class="accordion-item my-2 p-1 shadow rounded-1 border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button gap-2 @if ($active_section != $section->id) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $section->id }}" aria-expanded="@if ($section->id != $active_section) false @else true @endif" aria-controls="collapse_{{ $section->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                style="font-size: 1.5rem;" width="1em" height="1em"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                                <path fill="currentColor"
                                    d="M464 144H160c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16m-52 268H212V212h200zm452-268H560c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16m-52 268H612V212h200zm52 132H560c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V560c0-8.8-7.2-16-16-16m-52 268H612V612h200zM424 712H296V584c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v128H104c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h128v128c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V776h128c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8">
                                </path>
                            </svg>
                            <span> {{ ucfirst($section->title) }} </span>
                        </button>
                    </h2>
                    <div id="collapse_{{ $section->id }}" class="accordion-collapse collapse @if ($section->id == $active_section) show @endif" data-bs-parent="#coursePlay">
                        <div class="accordion-body" style="margin-top: 0.5rem;padding: 0.5rem;">
                            <ul class="coourse-playlist-list p-0 m-0">
                                @foreach ($lessons as $key => $lesson)
                                    @php $type = $lesson->lesson_type; @endphp
                                    <li class="coourse-playlist-item @if (isset($history->watching_lesson_id) && $lesson->id == $history->watching_lesson_id) active @else lock @endif">
                                        <div class="d-flex flex-grow-1 align-items-center">
                                            <a href="{{ route('course.player', ['slug' => $course_details->slug, 'id' => $lesson->id]) }}" class="d-flex flex-grow-1 align-items-center">
                                                <div class="play-lock-number">
                                                    <span>
                                                        @if (in_array($type, ['text', 'document_type', 'iframe', 'DocumentFile']))
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="book_icon" width="1.5em"
                                                                height="1.5em"
                                                                preserveAspectRatio="xMidYMid meet"
                                                                viewBox="0 0 48 48">
                                                                <defs>
                                                                    <mask
                                                                        id="iconifyReact_{{ $section->id }}">
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
                                                                    mask="url(#iconifyReact_{{ $section->id }})">
                                                                </path>
                                                            </svg>
                                                        @elseif (in_array($type, ['video-url', 'system-video', 'vimeo-url']))
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" role="img"
                                                                class="video_icon" width="1.5em"
                                                                height="1.5em"
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
                                                        @elseif ($type == 'Link')
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="book_icon" width="1.5em"
                                                                height="1.5em"
                                                                preserveAspectRatio="xMidYMid meet"
                                                                viewBox="0 0 256 256">
                                                                <g fill="currentColor">
                                                                    <path
                                                                        d="m218.34 119.6l-34.74 34.74a46.58 46.58 0 0 1-44.31 12.26c-.31.34-.62.67-.95 1l-34.74 34.74a46.63 46.63 0 1 1-65.94-65.94l34.74-34.74a46.6 46.6 0 0 1 44.31-12.26c.31-.34.62-.67 1-1l34.69-34.74a46.63 46.63 0 0 1 65.94 65.94"
                                                                        opacity=".2"></path>
                                                                    <path
                                                                        d="M240 88.23a54.43 54.43 0 0 1-16 37L189.25 160a54.27 54.27 0 0 1-38.63 16h-.05A54.63 54.63 0 0 1 96 119.84a8 8 0 0 1 16 .45A38.62 38.62 0 0 0 150.58 160a38.4 38.4 0 0 0 27.31-11.31l34.75-34.75a38.63 38.63 0 0 0-54.63-54.63l-11 11A8 8 0 0 1 135.7 59l11-11a54.65 54.65 0 0 1 77.3 0a54.86 54.86 0 0 1 16 40.23m-131 97.43l-11 11A38.4 38.4 0 0 1 70.6 208a38.63 38.63 0 0 1-27.29-65.94L78 107.31a38.63 38.63 0 0 1 66 28.4a8 8 0 0 0 7.78 8.22h.22a8 8 0 0 0 8-7.78A54.86 54.86 0 0 0 144 96a54.65 54.65 0 0 0-77.27 0L32 130.75A54.62 54.62 0 0 0 70.56 224a54.28 54.28 0 0 0 38.64-16l11-11a8 8 0 0 0-11.2-11.34">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        @elseif ($type == 'image')
                                                            <i class="fa-solid fa-image"></i>
                                                        @elseif ($type == 'google_drive')
                                                            <i class="fa-brands fa-google-drive"></i>
                                                        @else
                                                            @if ($lesson->type == 1)
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    aria-hidden="true" role="img"
                                                                    class="quiz_icon" width="1.5em"
                                                                    height="1.5em"
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
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    aria-hidden="true" role="img"
                                                                    class="homework_icon" width="1.5em"
                                                                    height="1.5em"
                                                                    preserveAspectRatio="xMidYMid meet"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill="currentColor"
                                                                        d="M8 4v12h12V4zm6.74 10.69a.96.96 0 0 1-.73.31c-.29 0-.54-.1-.74-.31a1 1 0 0 1-.31-.74c0-.29.1-.54.31-.74s.45-.3.74-.3s.54.1.74.3s.3.45.3.74s-.11.54-.31.74m1.77-5.86c-.23.34-.54.69-.92 1.06c-.3.27-.51.52-.64.75q-.18.345-.18.78v.4h-1.52v-.56c0-.42.09-.78.26-1.09c.18-.32.49-.67.95-1.07c.32-.29.55-.54.69-.74q.21-.3.21-.72q0-.54-.36-.87c-.24-.23-.57-.34-.99-.34c-.4 0-.72.12-.97.36s-.42.53-.53.87l-1.37-.57c.18-.55.52-1.03 1-1.45c.49-.43 1.11-.64 1.85-.64c.56 0 1.05.11 1.49.33q.66.33 1.02.93c.36.6.36.84.36 1.33s-.11.9-.35 1.24"
                                                                        opacity=".3"></path>
                                                                    <path fill="currentColor"
                                                                        d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H8V4h12zm-6.49-5.84c.41-.73 1.18-1.16 1.63-1.8c.48-.68.21-1.94-1.14-1.94c-.88 0-1.32.67-1.5 1.23l-1.37-.57C11.51 5.96 12.52 5 13.99 5c1.23 0 2.08.56 2.51 1.26c.37.6.58 1.73.01 2.57c-.63.93-1.23 1.21-1.56 1.81c-.13.24-.18.4-.18 1.18h-1.52c.01-.41-.06-1.08.26-1.66m-.56 3.79c0-.59.47-1.04 1.05-1.04c.59 0 1.04.45 1.04 1.04c0 .58-.44 1.05-1.04 1.05c-.58 0-1.05-.47-1.05-1.05">
                                                                    </path>
                                                                </svg>
                                                            {{-- <i class="fa-solid {{ $lesson->type == '2' ? 'fa-solid fa-file-pen' : 'fa-file' }}"></i> --}}
                                                            @endif
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <div class="check-title-area align-items-center">
                                                        @if($course_details->enable_drip_content)
                                                            <p class="d-none">{{ $lesson->lesson_type }}</p>
                                                            <span class="video-title">{{ $lesson->title }}</span>
                                                        @else
                                                            <input class="form-check-input flexCheckChecked mt-0" @if (in_array($lesson->id, $completed_lesson)) checked @endif type="checkbox" id="{{ $lesson->id }}">
                                                            <p class="d-none">{{ $lesson->lesson_type }}</p>
                                                            <span class="video-title">{{ $lesson->title }}</span>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (lesson_durations($lesson->id) != '00:00:00')
                                                            <small class="duration">{{ lesson_durations($lesson->id) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="me-auto">
                                            @if($is_locked)
                                                <i class="fas fa-lock" title="<?php echo get_phrase('Complete previous lesson to unlock it'); ?>" data-bs-toggle="tooltip"></i>
                                            @else
                                                @if(in_array($lesson->id, $completed_lesson_arr))
                                                    <i class="fas fa-check-circle checkbox-icon" title="<?php echo get_phrase('Lesson completed'); ?>"></i>
                                                @elseif(in_array($type, ['video-url', 'system-video', 'vimeo-url', 'google_drive']))
                                                    <i class="form-check-input flexCheckChecked mt-0" title="<?php echo get_phrase('Play Now'); ?>"></i>
                                                @else
                                                    <input class="form-check-input flexCheckChecked mt-0" @if (in_array($lesson->id, $completed_lesson)) checked @endif type="checkbox" id="{{ $lesson->id }}">
                                                @endif
                                            @endif
                                        </div>
                                    </li>

                                    @php
                                        if ($is_locked) {
                                            $locked_lesson_ids[] = $lesson->id;
                                        }

                                        if (
                                            !in_array($lesson->id, $completed_lesson_arr) &&
                                            !$is_locked &&
                                            $course_details->enable_drip_content == 1 &&
                                            auth()->user() &&  // Lowercase 'auth()' for consistency
                                            !$is_course_instructor
                                        ) {
                                            $is_locked = 1;
                                        }
                                    @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<form class="ajaxForm" action="{{ route('set.watch.history') }}" method="post" id="watch_history_form">
    @csrf
    <input type="hidden" class="course_id" name="course_id" value="{{ $course_details->id }}">
    <input type="hidden" class="lesson_id" name="lesson_id">
</form>
