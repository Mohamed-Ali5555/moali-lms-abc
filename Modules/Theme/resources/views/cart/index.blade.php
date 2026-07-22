{{-- @extends('layouts.default') --}}
@extends('theme::layouts.master')
@push('title', get_phrase('Cart'))
{{-- @push('meta')@endpush
@push('css')@endpush --}}
@section('content')
    <!------------------- Breadcum Area Start  ------>
    <section class="cart-page-section">
        <div class="section-background-aurora">
            <div class="animated-blob blob-1"></div>
            <div class="animated-blob blob-2"></div>
        </div>
        <div class="container" style="position: relative; z-index: 2" dir="rtl">
            <h1 class="page-title">{{ get_phrase('عربة التسوق') }}</h1>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="glass-panel">
                        @php $count_items_price = 0; @endphp
                        @if (count($cart_items) > 0 || count($cart_items_books) > 0)
                            @foreach ($cart_items as $course)
                                <div class="cart-item">
                                    <div class="item-image">
                                        <img src="{{ get_image($course->thumbnail) }}" alt="{{ ucfirst($course->title) }}">
                                    </div>

                                    <div class="item-details">
                                        <h3 class="item-title">{{ ucfirst($course->title) }}</h3>
                                        <p class="item-price">
                                            @if ($course->discount_flag == 1)
                                                @php
                                                    $count_items_price += $course->discount_price;
                                                @endphp
                                                @php $discount_price = number_format(($course->discount_price), 2) @endphp
                                                <s class="old-price">{{ currency($course->price, 2) }}</s>
                                                <span>{{ currency($discount_price) }}</span>
                                            @else
                                                @php
                                                    $count_items_price += $course->price;
                                                @endphp
                                                <span>{{ currency($course->price, 2) }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div></div>
                                    <div class="item-total-price">
                                        @if ($course->discount_flag == 1)
                                            {{ currency($course->discount_price, 2) }}
                                        @else
                                            {{ currency($course->price, 2) }}
                                        @endif
                                    </div>
                                    <a data-bs-toggle="tooltip" title="{{ get_phrase('حذف') }}" class="delete-cart-item"
                                        href="{{ route('theme.cart.delete', ['id' => $course->id, 'type' => 'course']) }}">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21 4H17.9C17.6679 2.87141 17.0538 1.85735 16.1613 1.12872C15.2687 0.40009 14.1522 0.00145452 13 0L11 0C9.8478 0.00145452 8.73132 0.40009 7.83875 1.12872C6.94618 1.85735 6.3321 2.87141 6.1 4H3C2.73478 4 2.48043 4.10536 2.29289 4.29289C2.10536 4.48043 2 4.73478 2 5C2 5.26522 2.10536 5.51957 2.29289 5.70711C2.48043 5.89464 2.73478 6 3 6H4V19C4.00159 20.3256 4.52888 21.5964 5.46622 22.5338C6.40356 23.4711 7.67441 23.9984 9 24H15C16.3256 23.9984 17.5964 23.4711 18.5338 22.5338C19.4711 21.5964 19.9984 20.3256 20 19V6H21C21.2652 6 21.5196 5.89464 21.7071 5.70711C21.8946 5.51957 22 5.26522 22 5C22 4.73478 21.8946 4.48043 21.7071 4.29289C21.5196 4.10536 21.2652 4 21 4ZM11 2H13C13.6203 2.00076 14.2251 2.19338 14.7316 2.55144C15.2381 2.90951 15.6214 3.41549 15.829 4H8.171C8.37858 3.41549 8.7619 2.90951 9.26839 2.55144C9.77487 2.19338 10.3797 2.00076 11 2ZM18 19C18 19.7956 17.6839 20.5587 17.1213 21.1213C16.5587 21.6839 15.7956 22 15 22H9C8.20435 22 7.44129 21.6839 6.87868 21.1213C6.31607 20.5587 6 19.7956 6 19V6H18V19Z"
                                                fill="#192335" />
                                            <path
                                                d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18Z"
                                                fill="#192335" />
                                            <path
                                                d="M14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z"
                                                fill="#192335" />
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                            {{-- /////////////// --}}
                            @foreach ($cart_items_books as $book)
                                <div class="cart-item">
                                    <div class="item-image">
                                        <img src="{{ get_image($book->thumbnail) }}" alt="{{ ucfirst($book->title) }}">
                                    </div>



                                    @if ($book->if_discount == 1)
                                        @php
                                            $count_items_price += $book->discount_price * $book->qty;
                                        @endphp

                                    @else
                                        @php
                                            $count_items_price += $book->price * $book->qty;
                                        @endphp
                                    @endif
                                    <div class="item-details">
                                        <h3 class="item-title">{{ ucfirst($book->title) }}</h3>
                                        <p class="item-price">
                                            <span>
                                                @if ($book->if_discount == 1)
                                                    <s class="old-price">{{ currency($book->price, 2) }}</s> <br>

                                                    <span> {{ currency($book->discount_price, 2) }}</span>
                                                @else
                                                    {{ currency($book->price, 2) }}
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div class="quantity-selector">
                                        <button class="btn quantity-btn increase" data-id="{{ $book->cart_id }}"
                                            data-url="{{ route('theme.cartBooks.updateQuantity', $book->cart_id) }}"
                                            element-type="book" book-price="{{ $book->price }}" book-type="book">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>
                                        <span class="quantity-input">{{ $book->qty }}</span>

                                        <button class="btn quantity-btn decrease" data-id ="{{ $book->cart_id }}"
                                            data-url="{{ route('theme.cartBooks.updateQuantity', $book->cart_id) }}"
                                            element-type="book">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M6 12L18 12" stroke="#000000" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="item-total-price">
                                        @if ($book->if_discount == 1)
                                            {{ currency($book->discount_price * $book->qty, 2) }}
                                        @else
                                        {{ currency($book->price * $book->qty, 2) }}
                                        @endif
                                    </div>

                                    <a data-bs-toggle="tooltip" title="{{ get_phrase('حذف') }}" class="delete-cart-item"
                                        href="{{ route('cart.delete', ['id' => $book->id, 'type' => 'book']) }}">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21 4H17.9C17.6679 2.87141 17.0538 1.85735 16.1613 1.12872C15.2687 0.40009 14.1522 0.00145452 13 0L11 0C9.8478 0.00145452 8.73132 0.40009 7.83875 1.12872C6.94618 1.85735 6.3321 2.87141 6.1 4H3C2.73478 4 2.48043 4.10536 2.29289 4.29289C2.10536 4.48043 2 4.73478 2 5C2 5.26522 2.10536 5.51957 2.29289 5.70711C2.48043 5.89464 2.73478 6 3 6H4V19C4.00159 20.3256 4.52888 21.5964 5.46622 22.5338C6.40356 23.4711 7.67441 23.9984 9 24H15C16.3256 23.9984 17.5964 23.4711 18.5338 22.5338C19.4711 21.5964 19.9984 20.3256 20 19V6H21C21.2652 6 21.5196 5.89464 21.7071 5.70711C21.8946 5.51957 22 5.26522 22 5C22 4.73478 21.8946 4.48043 21.7071 4.29289C21.5196 4.10536 21.2652 4 21 4ZM11 2H13C13.6203 2.00076 14.2251 2.19338 14.7316 2.55144C15.2381 2.90951 15.6214 3.41549 15.829 4H8.171C8.37858 3.41549 8.7619 2.90951 9.26839 2.55144C9.77487 2.19338 10.3797 2.00076 11 2ZM18 19C18 19.7956 17.6839 20.5587 17.1213 21.1213C16.5587 21.6839 15.7956 22 15 22H9C8.20435 22 7.44129 21.6839 6.87868 21.1213C6.31607 20.5587 6 19.7956 6 19V6H18V19Z"
                                                fill="#192335" />
                                            <path
                                                d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18Z"
                                                fill="#192335" />
                                            <path
                                                d="M14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z"
                                                fill="#192335" />
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            @include('frontend.default.empty')
                        @endif

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="glass-panel">
                        <h4>{{ get_phrase('ملخص الفاتورة') }}</h4>

                        <div class="summary-row">
                            <span>{{ get_phrase('المجموع') }}</span>
                            <span>{{ currency($count_items_price, 2) }}</span>
                        </div>

                        @php
                            $coupon_discount = $count_items_price * ($discount / 100);
                            $tax = (get_settings('course_selling_tax') / 100) * ($count_items_price - $coupon_discount);
                        @endphp

                        @if ($discount)
                            <div class="summary-row">
                                <span>
                                    {{ get_phrase('الخصم') }}
                                    ({{ $discount }}{{ get_phrase('%') }})
                                </span>
                                <span>- {{ currency($coupon_discount, 2) }}</span>
                            </div>
                        @endif

                        <div class="summary-row">
                            <span>
                                {{ get_phrase('ضريبة') }}
                                ({{ get_settings('course_selling_tax') }}{{ get_phrase('%') }})
                            </span>
                            <span>+ {{ currency($tax, 2) }}</span>
                        </div>


                        <div class="summary-row total">
                            <span>{{ get_phrase('الإجمالى') }}</span>
                            @php $payable = $count_items_price - ($coupon_discount) + $tax; @endphp
                            <span>{{ currency($payable, 2) }}</span>
                        </div>

                        <hr style="border-color: rgba(var(--c-border-rgb), 0.2)" />

                        <form action="{{ route('theme.payout') }}" method="post" class="mt-20">@csrf
                            <input type="hidden" name="payable" value="{{ $payable }}">
                            <input type="hidden" name="coupon_code" value="{{ request()->query('coupon') }}">
                            <input type="hidden" name="coupon_discount" value="{{ $coupon_discount }}">
                            <input type="hidden" name="tax" value="{{ $tax }}">
                            <input type="hidden" name="items"
                                value="{{ json_encode($cart_items->map(fn($item) => ['id' => $item->id, 'qty' => $item->qty])) }}">
                            <input type="hidden" name="books"
                                value="{{ json_encode($cart_items_books->map(fn($item) => ['id' => $item->id, 'qty' => $item->qty])) }}">
                            <div class="mt-20">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (request()->has('coupon') && isset($coupon) && $coupon_discount > 0)
                                            <div class="alert w-100 alert-purple show d-flex align-items-center py-2">
                                                <div>
                                                    {{ get_phrase('الكود') }} <strong>{{ get_phrase('مفعل') }}
                                                        ({{ $coupon->discount }}%) !</strong>
                                                </div>
                                                <a href="{{ route('cart') }}" type="button" class="btn ms-auto mt-2"><i
                                                        class="fi-rr-cross-circle text-14px"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row g-1">
                                    <div class="col-md-12">
                                        <p class="mb-2">لديك كود خصم؟</p>
                                        <div class="coupon-group mb-3">
                                            <input type="text" class="form-control" name="coupon" dir="rtl"
                                                placeholder="{{ get_phrase('كود الخصم') }}"
                                                value="{{ request()->query('coupon') }}">
                                            <button type="button" value="{{ get_phrase('Apply') }}"
                                                class="eBtn gradient m-0 text-white" id="apply-coupon">
                                                {{ get_phrase('تفعيل') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-20 send_gift_check">
                                <div class="form-check-reverse d-flex align-items-center gap-2 my-2">
                                    <input class="form-check-input mt-0" type="checkbox" name="is_gift" value="1"
                                        id="send_gift">
                                    <label class="form-check-label"
                                        for="send_gift">{{ get_phrase('إرسال كهدية') }}</label>
                                </div>

                                <input type="email" class="form-control my-2 gifted_user d-none" name=""
                                    placeholder="{{ get_phrase('ادخل البريد الإلكترونى ') }}">
                            </div>

                            <div class="mt-20">
                                <input type="submit" class="form-control eBtn gradient text-white"
                                    value="{{ get_phrase('مواصلة الدفع') }}"
                                    @if ($count_items_price == 0) disabled @endif>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------- Breadcum Area End  --------->


    <!-------------- Cart list Item Start   --------------->

    <div class="eNtery-item cart-items">
        <div class="container">

        </div>
    </div>
    <!-------------- Cart list Item End  --------------->
    <script>
        $(document).ready(function() {
            $('.increase').click(function() {
                let btn = $(this);
                let parent = btn.closest(".item-price-details-books");
                let url = btn.data('url');
                updateQuantity(url, "increase", parent);

            });

            $('.decrease').click(function() {
                let btn = $(this);
                let parent = btn.closest(".item-price-details-books");
                let url = btn.data('url');
                updateQuantity(url, "decrease", parent);

            });

            function updateQuantity(url, action, parent) {
                $.ajax({
                    url: url,
                    type: "post",
                    data: {
                        action: action,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.success) {
                            parent.find(".quantity").text(data.qty);

                            let price = parseFloat(parent.find(".increase").attr("book-price"));
                            let total = price * data.qty;
                            parent.closest(".creator").find(".item-price b").text("L.E" + total);



                            if (data.qty <= 1) {
                                parent.find(".decrease").prop("disabled", true);
                            } else {
                                parent.find(".decrease").prop("disabled", false);
                            }
                            Swal.fire({
                                icon: 'success',
                                title: 'تم الاضافه',
                                text: 'تم تديث المنتج '
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();

                                }
                            });

                        } else {
                            alert("error " + data.message);
                        }
                    },


                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('error on system');
                    }
                });
            }




        })
    </script>

    <script>
        "use strict";
        $(document).ready(function() {

            // Confirm Delete Item
            $('.delete-cart-item').on('click', function(e) {
                e.preventDefault();
                let href = $(this).attr('href');

                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "! لن تتمكن من التراجع عن هذا",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم ,إحذف',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });

            // submit coupon
            $('#apply-coupon').on('click', function(e) {
                e.preventDefault();
                let code = $('input[name="coupon"]').val();
                window.location.href = "{{ route('theme.cart') }}" + "?coupon=" + code;
            });

            // cancel coupon
            $('#cancel-coupon').on('click', function(e) {
                e.preventDefault();
                window.location.href = "{{ route('theme.cart') }}";
            });

            $('#send_gift').on('change', function() {
                if ($(this).prop('checked')) {
                    $('.gifted_user').attr({
                        'name': 'gifted_user_email',
                        'required': '1'
                    }).removeClass('d-none');
                } else {
                    $('.gifted_user').removeAttr('name required').addClass('d-none');
                }
            })
        });
    </script>
@endsection
