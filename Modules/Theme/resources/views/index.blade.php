@extends('theme::layouts.master')
@section('content')
@include('theme::includes.banner')

  <!-- Start Features Section -->
  @include('theme::includes.features',['features'=>$features])
  <!-- End Features Section -->

    <section class="academic-years-tilt-section" id="years-section" dir="rtl">
        <div class="section-bg-shapes">
            <div class="shape-1"></div>
            <div class="shape-2"></div>
            <div class="shape-3"></div>
            <div class="shape-4"></div>
        </div>
      <div class="container">
        <h2 class="section-title-modern display-5">السنوات الدراسية</h2>
        <p class="section-subtitle description-text">
          كل ما تحتاجه للتفوق في مكان واحد. اختر سنتك الدراسية وانطلق نحو مستقبل
          مشرق.
        </p>

        <div class="row g-5 justify-content-center">
            @foreach($categories as $category)
                <div class="col-lg-4 col-md-6 card-tilt-wrapper">
                    <a href="{{route('theme.category',$category->id)}}" class="year-card-tilt">
                    <div class="card-inner-content">
                        <img src="{{ get_image($category->thumbnail ?? '') }}" class="card-img-top" alt=">{{$category->title}}" />
                        <div class="card-content-wrapper">
                            <h3 class="year-title">{{$category->title}}</h3>
                            <p class="year-desc">{!! $category->description !!}</p>
                        </div>
                        <span class="btn btn-view-courses">
                            <i class="fa-solid fa-arrow-right"></i>
                            <span>عرض الكورسات</span>
                        </span>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
      </div>
    </section>



  <!-- Start Courses Section-->
  {{-- <section class="courses py-5">
    <div class="container">
      <h2 class="section-title" data-title="السنوات الدراسية">
        السنوات الدراسية
      </h2>
      <div class="row mb-5 flex-row-reverse">
        @foreach($categories as $category)
        <div class="col-lg-4 col-md-6 mt-5">
          <div class="classroom-card">
            <div class="classroom-card-header">
              <img src="{{ get_image($category->thumbnail ?? '') }}" alt="course-1" />
            </div>
            <div class="classroom-card-body">
              <a href="{{route('theme.category',$category->id)}}">
                <div class="">
                  <h4>{{$category->title}}</h4>
                  <hr />
                  <p>{!! $category->description !!}</p>
                </div>
              </a>
            </div>
          </div>
        </div>

        @endforeach


      </div>
    </div>
  </section> --}}
  <!-- End Courses Section-->
  @include('theme::includes.book')

    <script>
      document.addEventListener("DOMContentLoaded", function () {

        // Animate cards on scroll into view
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                const wrappersInView =
                  entry.target.querySelectorAll(".card-tilt-wrapper");
                wrappersInView.forEach((wrapper, index) => {
                  setTimeout(() => {
                    wrapper.classList.add("is-visible");
                  }, index * 150);
                });
                observer.unobserve(entry.target);
              }
            });
          },
          {
            threshold: 0.1,
          }
        );

        const sectionToObserve = document.getElementById("years-section");
        if (sectionToObserve) {
          observer.observe(sectionToObserve);
        }

        // 3D Tilt Effect Logic
        const tiltWrappers = document.querySelectorAll(".card-tilt-wrapper");
        tiltWrappers.forEach((wrapper) => {
          const tiltCard = wrapper.querySelector(".year-card-tilt");
          wrapper.addEventListener("mousemove", (e) => {
            const rect = wrapper.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * -20; // Max rotation 8 degrees
            const rotateY = ((x - centerX) / centerX) * 20; // Max rotation 8 degrees

            tiltCard.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

            // Update glowing border position
            tiltCard.style.setProperty("--mouse-x", `${x}px`);
            tiltCard.style.setProperty("--mouse-y", `${y}px`);
          });

          wrapper.addEventListener("mouseleave", () => {
            tiltCard.style.transform = "rotateX(0deg) rotateY(0deg)";
          });
        });
      });
    </script>

@endsection
