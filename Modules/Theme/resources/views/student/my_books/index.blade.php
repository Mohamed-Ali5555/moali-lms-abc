@extends('theme::layouts.master')

{{-- @extends('layouts.default') --}}

@push('title', get_phrase('My books'))
{{-- @push('meta')@endpush
@push('css')@endpush --}}
@section('content')
    <section class="myCourses main_content" dir="rtl">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')

                <div class="col-lg-9 px-4">
                    <h4 class="g-title">كتبي</h4>
                    <div class="row mt-5">
                        {{-- @php
                            $allItems = $books->flatMap->items;
                        @endphp --}}

                        @if ($books->count() > 0)
                            @foreach ($books as $row)
                                <div class="col-xxl-4 col-lg-6 mt-5">


                                    {{-- <div class="course-card offer">
                                        <div class="course-card-header">
                                            <img src="{{ get_image($row['book']->thumbnail) }}" class="card-img-top"
                                                alt="{{ $row['book']->title }}" />
                                        </div>
                                        <div class="course-card-body">
                                            <header>
                                                <div class="course-card-body-title">
                                                    <h4>{{ $row['book']->title }}</h4>
                                                    <div class="course-card-body-buttons">
                                                        @if (auth()->check())
                                                            <div class="course-subscribed text-center">
                                                                <p>لقد تم شراء هذا الكتاب </p>
                                                            </div>
                                                        @endif
                                                        <span>عدد مرات الشراء {{ $row['count']}}</span>
                                                    </div>
                                                </div>
                                                <div class="course-card-body-buttons">
                                                </div>
                                            </header>
                                            <hr class="separated-line" />
                                            <footer>
                                                <div class="course-date">
                                                    <div class="d-flex justify-content-between align-items-center gap-1">
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
                                                                        <mask id="{{ $row['book']->id }}">
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
                                                                        mask="url(#{{ $row['book']->id }})"></path>
                                                                </svg>
                                                            </span>
                                                            <span> الانشاء : </span>
                                                        </div>
                                                        <span>{{ \Carbon\Carbon::parse($row['book']->created_at)->isoFormat('dddd، D MMMM YYYY') }}</span>
                                                    </div>

                                                </div>
                                            </footer>
                                        </div>
                                    </div> --}}
                                    <div class="pro-book-card" style="opacity:1;">
                                        <div class="circle-reveal"></div>
                                        <div class="book-3d-container">
                                            <img src="{{ get_image($row['book']->thumbnail ?? '') }}"
                                                alt="{{ $row['book']->title }}" class="book-cover-3d">
                                        </div>
                                        <div class="card-content-pro text-center d-flex flex-column align-items-center">
                                            <a href="{{ route('theme.book.details', $row['book']->id) }}">
                                                <h3 class="fs-4 fw-bold text-primary-dark mb-2">{{ $row['book']->title }}
                                                </h3>
                                            </a>
                                            {{-- <p class="text-muted small mb-4"> {!! $book->disc !!} </p> --}}


                                            <div class="mb-4 d-flex align-items-center gap-3">
                                                {{-- <span class="price-current display-6 fw-bold text-primary-dark">{{ $row['book']->price }}</span>
                                            <span class="currency">جنيهًا</span> --}}
                                                <span class="price-current display-6 fw-bold text-primary-dark"
                                                    style="font-size:26px;">تم شراء هذا الكتاب</span>
                                                <span
                                                    style="background-color: #19b9a4;width: 22px;height: 25px;border-radius: 20px;">{{ $row['count'] }}</span>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
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
            @if (count($books) > 0)
                <div class="entry-pagination">
                    <nav aria-label="Page navigation example">
                        {{-- {{ $books->links() }} --}}
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
