@if (get_theme_settings('book_status') == 1)

    <style>
        /* .text-primary-dark { color: #2C3E50; } */
        .text-primary-dark {
            color: var(--theme-color)
        }
    </style>

    <section class="books-pro" dir="rtl">
        <div class="container">
            <div class="text-center mb-5 pb-4">
                <h2 class="display-5 fw-bold text-primary-dark">مكتبة التفوق</h2>
                <p class="description-text mt-3 fs-5">تجربة فريدة تليق بطموحك.</p>
            </div>

            <div class="swiper" id="swiperBooks">
                <div class="swiper-wrapper">
                    @foreach ($books as $book)
                        @php
                            $bookQty = $cartItems[$book->id] ?? 0;
                        @endphp
                        <div class="swiper-slide">
                            <div class="pro-book-card">
                                <div class="circle-reveal"></div>
                                <div class="book-3d-container">
                                    <img src="{{ get_image($book->thumbnail ?? '') }}" alt="{{ $book->title }}"
                                        class="book-cover-3d">
                                </div>
                                <div class="card-content-pro text-center d-flex flex-column align-items-center">
                                    <a href="{{ route('theme.book.details', $book->id) }}">
                                        <h3 class="fs-4 fw-bold text-primary-dark mb-2">{{ $book->title }}</h3>
                                    </a>
                                    {{-- <p class="text-muted small mb-4"> {!! $book->disc !!} </p> --}}


                                    <div class="mb-4 d-flex align-items-center gap-3">
                                        @if ($book->if_discount == 1)
                                            <span
                                                class="price-current display-6 fw-bold text-primary-dark" style="font-size: 22px;">{{ $book->discount_price }}</span>
                                            <del
                                                class="price-current display-6 fw-bold text-primary-dark" style="font-size: 22px;">{{ $book->price }}</del>
                                        @else
                                            <span
                                                class="price-current display-6 fw-bold text-primary-dark" style="font-size: 22px;">{{ $book->price }}</span>
                                        @endif
                                        <span class="currency">جنيهًا</span>
                                    </div>

                                    <!-- الزر -->
                                    <button class="btn-pro-cart add-to-cart" id-element="{{ $book->id }}"
                                        element-type="book">
                                        <i class="fas fa-shopping-bag"></i>
                                        <span>أضف إلى السلة</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>


    {{-- <section class="books my-5">
        <div class="container">
            <h2 class="section-title" data-title="الكتب الدراسية">
                الكتب الدراسية
            </h2>

            <div class="row mt-5">
                @foreach ($books as $book)
                    @php
                        $bookQty = $cartItems[$book->id] ?? 0;
                    @endphp
                    <div class="col-lg-6 my-4">
                        <div class="book_card">

                            <img src="{{ get_image($book->thumbnail ?? '') }}" class="card-img-top"
                                alt="{{ $book->title }}" />

                            <div class="card-body">
                                <a href="{{ route('theme.book.details', $book->id) }}">
                                    <h5 class="card-title">
                                        {{ $book->title }}
                                    </h5>
                                </a>
                                <div class="item-price">
                                    <span id="total_qty">{{ $book->price }}</span>
                                    <span>جنيهًا</span>
                                </div>
                                <p class="card-text my-2">
                                    <span>{!! $book->disc !!}</span>
                                </p>
                                @if (auth()->check())
                                <button class="btn eBtn gradient text-white mt-auto add-to-cart"
                                    id-element="{{ $book->id }}" element-type="book"> أضف إلى السلة
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

@endif


@include('theme::includes.addCart')
<script defer>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.pro-book-card').forEach(card => {
        observer.observe(card);
    });

    const swiperBooks = new Swiper("#swiperBooks", {
        loop: true,
        slidesPerView: 1.25,
        spaceBetween: 20,
        // autoplay: {
        //     delay: 4000,
        //     disableOnInteraction: false,
        // },
        centeredSlides: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            576: {
                slidesPerView: 1.5,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 25,
            }
        },
        on: {
            slideChange: function() {
                document.querySelectorAll('.pro-book-card').forEach(card => {
                    card.classList.remove('is-visible');
                });
                setTimeout(() => {
                    document.querySelectorAll(
                        '.swiper-slide-active .pro-book-card, .swiper-slide-next .pro-book-card, .swiper-slide-prev .pro-book-card'
                        ).forEach(card => {
                        observer.observe(card);
                    });
                }, 100);
            }
        }
    });


    window.imagePaths = {
        biology01: "{{ asset('newFrontend/images/biology-icon/biology-01.png') }}",
        biology02: "{{ asset('newFrontend/images/biology-icon/biology-02.png') }}",
        biology03: "{{ asset('newFrontend/images/biology-icon/biology-03.png') }}",
        biology04: "{{ asset('newFrontend/images/biology-icon/biology-04.png') }}",
        biology05: "{{ asset('newFrontend/images/biology-icon/biology-05.png') }}",
        biology06: "{{ asset('newFrontend/images/biology-icon/biology-06.png') }}",
        biology07: "{{ asset('newFrontend/images/biology-icon/biology-07.png') }}",
        biology08: "{{ asset('newFrontend/images/biology-icon/biology-08.png') }}",
        biology09: "{{ asset('newFrontend/images/biology-icon/biology-09.png') }}",
        biology10: "{{ asset('newFrontend/images/biology-icon/biology-10.png') }}"
    };
</script>
