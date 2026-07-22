@extends('layouts.admin')

@push('title', get_phrase('Categories'))

@push('meta')
@endpush

@push('css')
@endpush



@section('content')
    <div class="ol-card radius-8px">
        <div class="ol-card-body my-3 py-12px px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('All Books') }} <span class="text-muted">({{ $books->count() }})</span>
                </h4>
                @if (has_permission('admin.bookstore.create'))
                    <a onclick="ajaxModal('{{ route('modal', ['bookstore::create', 'parent_id' => 0]) }}', '{{ get_phrase('Add new book') }}')"
                        href="#" class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                        <span class="fi-rr-plus"></span>
                        <span>{{ get_phrase('Add new book') }}</span>
                    </a>
                @endif
                @if (count($books) > 0)
                    @if (has_permission('admin.bookstore.sort'))
                        <a href="#"
                            onclick="ajaxModal('{{ route('modal', ['bookstore::book_sort']) }}', '{{ get_phrase('Sort books') }}')"
                            class="btn ol-btn-light ol-btn-sm">
                            <h6 class="title" style="display: flex;align-items: center; gap: 8px;">
                                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#7e4af7">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M16 18L16 16M16 6L20 10.125M16 6L12 10.125M16 6L16 13" stroke="<span>"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8 18L12 13.875M8 18L4 13.875M8 18L8 11M8 6V8" stroke="<span>"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                <span>{{ get_phrase('Sort book') }}</span>
                            </h6>
                        </a>
                    @endif
                @endif

            </div>
        </div>
    </div>

    @if (count($books) > 0)
        <div class="row g-4 all-category-list">
            @foreach ($books as $book)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="ol-card category-card radious-10px h-100">
                        <img src="{{ get_image($book->thumbnail) }}" class="card-img-top" alt="...">
                        <h6 class="title fs-14px mb-12px px-3 pt-3 d-flex align-baseline">
                            @if ($book->status == 0)
                                <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path opacity="0.5"
                                            d="M4.72718 2.73332C5.03258 2.42535 5.46135 2.22456 6.27103 2.11478C7.10452 2.00177 8.2092 2 9.7931 2H14.2069C15.7908 2 16.8955 2.00177 17.729 2.11478C18.5387 2.22456 18.9674 2.42535 19.2728 2.73332C19.5782 3.0413 19.7773 3.47368 19.8862 4.2902C19.9982 5.13073 20 6.24474 20 7.84202L20 18H7.42598C6.34236 18 5.96352 18.0057 5.67321 18.0681C5.15982 18.1785 4.71351 18.4151 4.38811 18.7347C4.27837 18.8425 4.22351 18.8964 4.09696 19.2397C4.02435 19.4367 4 19.5687 4 19.7003V7.84202C4 6.24474 4.00176 5.13073 4.11382 4.2902C4.22268 3.47368 4.42179 3.0413 4.72718 2.73332Z"
                                            fill="#41444e"></path>
                                        <path
                                            d="M20 18H7.42598C6.34236 18 5.96352 18.0057 5.67321 18.0681C5.15982 18.1785 4.71351 18.4151 4.38811 18.7347C4.27837 18.8425 4.22351 18.8964 4.09696 19.2397C3.97041 19.5831 3.99045 19.7288 4.03053 20.02C4.03761 20.0714 4.04522 20.1216 4.05343 20.1706C4.16271 20.8228 4.36259 21.1682 4.66916 21.4142C4.97573 21.6602 5.40616 21.8206 6.21896 21.9083C7.05566 21.9986 8.1646 22 9.75461 22H14.1854C15.7754 22 16.8844 21.9986 17.7211 21.9083C18.5339 21.8206 18.9643 21.6602 19.2709 21.4142C19.4705 21.254 19.6249 21.0517 19.7385 20.75H8C7.58579 20.75 7.25 20.4142 7.25 20C7.25 19.5858 7.58579 19.25 8 19.25H19.9754C19.9926 18.8868 19.9982 18.4741 20 18Z"
                                            fill="#41444e"></path>
                                        <path
                                            d="M7.25 7C7.25 6.58579 7.58579 6.25 8 6.25H16C16.4142 6.25 16.75 6.58579 16.75 7C16.75 7.41421 16.4142 7.75 16 7.75H8C7.58579 7.75 7.25 7.41421 7.25 7Z"
                                            fill="#41444e"></path>
                                        <path
                                            d="M8 9.75C7.58579 9.75 7.25 10.0858 7.25 10.5C7.25 10.9142 7.58579 11.25 8 11.25H13C13.4142 11.25 13.75 10.9142 13.75 10.5C13.75 10.0858 13.4142 9.75 13 9.75H8Z"
                                            fill="#41444e"></path>
                                    </g>
                                </svg>
                            @else
                                <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path opacity="0.5"
                                            d="M4.72718 2.73332C5.03258 2.42535 5.46135 2.22456 6.27103 2.11478C7.10452 2.00177 8.2092 2 9.7931 2H14.2069C15.7908 2 16.8955 2.00177 17.729 2.11478C18.5387 2.22456 18.9674 2.42535 19.2728 2.73332C19.5782 3.0413 19.7773 3.47368 19.8862 4.2902C19.9982 5.13073 20 6.24474 20 7.84202L20 18H7.42598C6.34236 18 5.96352 18.0057 5.67321 18.0681C5.15982 18.1785 4.71351 18.4151 4.38811 18.7347C4.27837 18.8425 4.22351 18.8964 4.09696 19.2397C4.02435 19.4367 4 19.5687 4 19.7003V7.84202C4 6.24474 4.00176 5.13073 4.11382 4.2902C4.22268 3.47368 4.42179 3.0413 4.72718 2.73332Z"
                                            fill="#0429ae"></path>
                                        <path
                                            d="M20 18H7.42598C6.34236 18 5.96352 18.0057 5.67321 18.0681C5.15982 18.1785 4.71351 18.4151 4.38811 18.7347C4.27837 18.8425 4.22351 18.8964 4.09696 19.2397C3.97041 19.5831 3.99045 19.7288 4.03053 20.02C4.03761 20.0714 4.04522 20.1216 4.05343 20.1706C4.16271 20.8228 4.36259 21.1682 4.66916 21.4142C4.97573 21.6602 5.40616 21.8206 6.21896 21.9083C7.05566 21.9986 8.1646 22 9.75461 22H14.1854C15.7754 22 16.8844 21.9986 17.7211 21.9083C18.5339 21.8206 18.9643 21.6602 19.2709 21.4142C19.4705 21.254 19.6249 21.0517 19.7385 20.75H8C7.58579 20.75 7.25 20.4142 7.25 20C7.25 19.5858 7.58579 19.25 8 19.25H19.9754C19.9926 18.8868 19.9982 18.4741 20 18Z"
                                            fill="#0429ae"></path>
                                        <path
                                            d="M7.25 7C7.25 6.58579 7.58579 6.25 8 6.25H16C16.4142 6.25 16.75 6.58579 16.75 7C16.75 7.41421 16.4142 7.75 16 7.75H8C7.58579 7.75 7.25 7.41421 7.25 7Z"
                                            fill="#0429ae"></path>
                                        <path
                                            d="M8 9.75C7.58579 9.75 7.25 10.0858 7.25 10.5C7.25 10.9142 7.58579 11.25 8 11.25H13C13.4142 11.25 13.75 10.9142 13.75 10.5C13.75 10.0858 13.4142 9.75 13 9.75H8Z"
                                            fill="#0429ae"></path>
                                    </g>
                                </svg>
                            @endif
                            {{-- <i class="me-2 fas fa-book" @if ($book->status == 0) style="color: red; font-size:22px;" @else style="color: green; font-size:22px;" @endif></i> --}}
                            <span style="font-size: 18px">{{ $book->title }}</span>
                            @if ($book->if_discount == 1)
                                <del class="text-muted d-inline-block ms-auto">({{ $book->price }})</del>
                                <span class="text-muted d-inline-block ms-auto">({{ $book->discount_price }})</span>
                            @else
                                <span class="text-muted d-inline-block ms-auto">({{ $book->price }})</span>
                            @endif
                        </h6>
                        <div class="category-footer ol-card-body text-center py-1">
                            @if (has_permission('admin.bookstore.edit'))
                                <a href="#"
                                    onclick="ajaxModal('{{ route('modal', ['bookstore::edit', 'id' => $book->id]) }}', '{{ get_phrase('Edit book') }}')"
                                    class="btn text-12px fw-600"><i class="fi fi-rr-pen-clip"
                                        style="color: #2a72f7; font-size:22px;"></i></a>
                            @endif
                            @if (has_permission('admin.bookstore.delete'))
                                <a href="#"
                                    onclick="confirmModal('{{ route('admin.bookstore.delete', $book->id) }}')"
                                    class="btn text-12px fw-600"><i class="fi-rr-trash"
                                        style="color: rgb(248, 76, 76); font-size:22px;"></i></a>
                            @endif
                            @if (has_permission('admin.bookstore.activation'))
                                <a href="#"
                                    onclick="confirmModal('{{ route('admin.bookstore.activation', $book->id) }}')"
                                    class="btn text-12px fw-600">
                                    @if ($book->status == 1)
                                        <i class="fi-rr-eye" style="color: rgb(54, 150, 10); font-size:22px;"></i>
                                    @else
                                        <i class="fas fa-eye-slash" style="color: #3f3d3d; font-size:22px;"></i>
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @include('admin.no_data')
    @endif
@endsection
