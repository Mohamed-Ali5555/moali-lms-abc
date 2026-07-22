<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="hero-section" id="hero-section" dir="rtl">
    <div class="shapes-background">
        <div class="animated-shape shape-1"></div>
        <div class="animated-shape shape-2"></div>
        <div class="animated-shape shape-3"></div>
    </div>

    <div class="container">
        <div class="row align-items-center flex-row-reverse row-gap-5">
            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <div class="hero-image-container">
                        <div class="pulsing-glow"></div>
                        <img src="{{ asset(get_theme_settings('thumbnail') ?? '') }}" alt="{{ get_theme_settings('name') }}" class="hero-image logo light" />
                        <img src="{{ asset(get_theme_settings('dark_thumbnail') ?? '') }}" alt="{{ get_theme_settings('name') }}" class="hero-image logo dark" />

                        <div class="orbiting-ring ring-1">
                            <div class="floating-icon icon-1">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>

                        <div class="orbiting-ring ring-2">
                            <div class="floating-icon icon-3">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="floating-icon icon-4">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-content-wrapper">
                    <p class="hero-welcome">أهلاً بكم في منصة</p>
                    <div class="hero-teacher-name-wrapper">
                        <h1 class="hero-teacher-name">{{ get_theme_settings('jop_title') }} / <br />
                            {{ get_theme_settings('name') }}</h1>
                    </div>
                    <span class="hero-subtitle">{!! get_theme_settings('instructor_description') !!}</span>
                    <div class="d-flex gap-3 hero-buttons justify-content-center justify-content-lg-start">

                        @if (!auth()->check())
                            <div class="d-flex gap-3 hero-buttons justify-content-center justify-content-lg-start mt-3">
                                <a href="{{ route('theme.show_register') }}" class="btn btn-hero-primary">
                                    <span><i class="fas fa-user-plus me-2"></i> انشئ حسابك الآن</span>
                                </a>
                                <a href="{{ route('theme.show_login') }}"class="btn btn-hero-secondary">
                                    <span>تسجيل الدخول</span>
                                </a>
                            </div>
                        @endif

                        @if (auth()->check())

                            @if (get_theme_settings('sub_status') == 1)
                                <div class="d-flex gap-3 hero-buttons justify-content-center justify-content-lg-start">
                                    <a href="{{ route('theme.my.courses') }}" class="btn btn-hero-primary">
                                        <span> اشتراكاتي </span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Animate hero section on load
        const heroSection = document.getElementById("hero-section");
        if (heroSection) {
            setTimeout(() => {
                heroSection.classList.add("is-visible");
            }, 100);
        }

        // 3D Parallax Effect for the image
        const imageWrapper = document.querySelector(".hero-image-wrapper");
        const imageContainer = document.querySelector(".hero-image-container");
        if (imageWrapper && imageContainer) {
            imageWrapper.addEventListener("mousemove", (e) => {
                const rect = imageWrapper.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;

                const rotateY = (x / rect.width) * 10; // Max rotation
                const rotateX = (y / rect.height) * -10; // Max rotation

                imageContainer.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            imageWrapper.addEventListener("mouseleave", () => {
                imageContainer.style.transform = "rotateX(0deg) rotateY(0deg)";
            });
        }
    });
</script>

<!-- Start Header -->
{{-- <header class="main-header">
    <!-- Start Main Section -->
    <main>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="main-image">
                        <img src="{{ asset(get_theme_settings('thumbnail') ?? '') }}" />
                    </div>
                </div>

                <div class="col-lg-5 col-md-6">
                    <div class="main-content">
                        <h2>{{ get_theme_settings('jop_title') }}</h2>
                        <div class="position-relative" style="width: fit-content">
                            <h1>{{ get_theme_settings('name') }}</h1>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 152.9 43.4"
                                style="enable-background: new 0 0 152.9 43.4" xml:space="preserve">
                                <path
                                    d="M151.9,13.6c0,0,3.3-9.5-85-8.3c-97,1.3-58.3,29-58.3,29s9.7,8.1,69.7,8.1c68.3,0,69.3-23.1,69.3-23.1 s1.7-10.5-14.7-18.4" />
                            </svg>
                        </div>
                        <p>{!! get_theme_settings('instructor_description') !!}</p>
                        @if (!auth()->check())
                            <div class="buttons">
                                <a href="{{ route('theme.show_login') }}">
                                    <span>تسجيل الدخول</span>
                                </a>
                                <a href="{{ route('theme.show_register') }}">
                                    <span>انشئ حسابك الآن</span>
                                </a>
                            </div>
                        @endif


                        @if (get_theme_settings('sub_status') == 1)
                            <div class="buttons">
                                <a href="{{ route('theme.my.courses') }}">
                                    <span> اشتراكاتي </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main Section -->
</header> --}}
<!-- End Header -->
