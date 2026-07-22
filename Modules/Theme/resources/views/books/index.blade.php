@extends('theme::layouts.master')

@section('content')
    <div class="main_content" dir="rtl">
        <!-- Start Page Title -->
        <section class="page_title text-center">
            <div class="container">
                <h2 class="fs-1 fw-bold">{{ $data['book']->category->title }} </h2>
                <div class="sub_title">
                    <p class="fs-3 my-5"> </p>
                    @if ($data['book']->status == 0)
                        <div class="book_notAvailable">
                            <p class="fs-4">عفوًا, سيتم توفير هذا الكتاب مرة أخرى قريبًا..</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- End Page Title -->

        <section class="book_details mt-5">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-md-6">
                        <div class="book_image">
                            <img src="{{ get_image($data['book']->thumbnail ?? '') }}" alt="" class="w-100" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column gap-3 p-2">
                            <div class="book_details_title">
                                <h2>{{ $data['book']->title }} </h2>
                            </div>

                            <hr class="thick" />

                            <div class="book_details_description">

                                <span>{!! $data['book']->disc !!} </span>
                            </div>

                            <hr class="thin" />

                            <div class="book_details_price">
                                <p>{{ $data['book']->price }} جنيهًا</p>
                            </div>

                            <div class="book_buttons">
                                @if ($data['book']->status == 0)
                                    <div class="book_notAvailable">
                                        <p class="fs-4">غير متوفر الآن...</p>
                                    </div>
                                @else
                                    <button class="add_to_cart" id-element="{{ $data['book']->id }}" element-type="book">
                                        <img src="{{ asset('modules/theme/images/icons/cart-plus.svg') }}" alt="cart-plus"
                                            width="30" />
                                        <span>أضف إلى عربة التسوق !</span>
                                    </button>
                                    <a class="go_to_cart" href="{{ route('theme.cart') }}">
                                        <img src="{{ asset('modules/theme/images/icons/money-bill-wave.svg') }}"
                                            alt="money-bill-wave" width="30" />
                                        <span> مراجعة العربة و الذهاب للدفع </span>
                                        <img src="{{ asset('modules/theme/images/icons/money-bill-wave.svg') }}"
                                            alt="money-bill-wave" width="30" />
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

    <script>
        $('.add_to_cart').on('click', function() {
            let id = $(this).attr('id-element');
            //    let _token = $('input[name="_token"]').val();
            let type = $(this).attr('element-type');
            let cartNumber = +$('#cart-number').text();

            let url = "{{ route('theme.cart.store', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: id,
                    type: type,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.result) {
                        $('#cart-number').text(cartNumber + 1);

                        // If it's a successful cart addition
                        // $('#cart-number').text(response.data.total_cart);

                        if (response.action === 'added') {
                            Swal.fire({
                                icon: 'success',
                                title: 'تمت الإضافة',
                                text: response.message
                            });
                        } else if (response.action === 'incremented') {
                            Swal.fire({
                                icon: 'info',
                                title: 'تم التحديث',
                                text: response.message
                            });
                        }


                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: response.message,
                            text: 'يجب عليك تسجيل الدخول اولا لشراء الكورس',
                            showCancelButton: false,
                            confirmButtonText: 'تسجيل الدخول'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('theme.login') }}';
                            }
                        });
                    }
                },
                error: function(xhr) {
                    let message = 'حدث خطأ ما';

                    if (xhr.responseJSON) {
                        message = xhr.responseJSON.message;

                        // Check if error is due to not being logged in
                        if (message.includes('يجب ان تسجل دخول اولا')) {
                            Swal.fire({
                                icon: 'error',
                                title: message,
                                text: 'يجب عليك تسجيل الدخول اولا لشراء الكورس',
                                showCancelButton: false,
                                confirmButtonText: 'تسجيل الدخول'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        '{{ route('theme.show_login') }}';
                                }
                            });
                            return;
                        }


                    }

                    // Generic error handling for other types of errors
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: message
                    });
                }
            });
        });
    </script>
@endsection
