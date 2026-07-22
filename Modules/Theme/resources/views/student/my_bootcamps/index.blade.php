@extends('theme::layouts.master')

@push('title', get_phrase('My books'))
@section('content')
    <style>
        :root {
            --primary-color: #0891b2;
            --secondary-color: #0e7490;
            --accent-color: #06b6d4;
            --light-color: #f0f9ff;
            --dark-color: #164e63;
            --text-color: #334155;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --border-radius: 16px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }



        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* ======= Header ======= */
        .main-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            padding: 120px 0 60px;
            position: relative;
            overflow: hidden;
            margin-top: 70px;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .header-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .welcome-section {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .welcome-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            display: block;
        }

        .welcome-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ======= Stats Cards ======= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 25px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            display: block;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* ======= Main Content ======= */
        .main-container {
            max-width: 1400px;
            margin: 150px auto 60px;
            padding: 0 20px;
            position: relative;
        }

        /* ======= Bootcamps Dashboard ======= */
        .dashboard-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .dashboard-header {
            padding: 30px;
            border-bottom: 2px solid #f1f5f9;
            background: linear-gradient(to right, #f8fafc, white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dashboard-title {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .dashboard-title i {
            color: var(--primary-color);
            font-size: 2rem;
        }

        .dashboard-controls {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            background: var(--light-color);
            border: 2px solid var(--primary-color);
            border-radius: 8px;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
        }

        /* ======= Bootcamps List ======= */
        .bootcamps-list {
            padding: 30px;
        }

        .bootcamps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        /* ======= Bootcamp Card ======= */
        .my-bootcamp-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .my-bootcamp-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--accent-color);
        }

        .card-header {
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 2;
        }

        .card-badge.completed {
            background: var(--success-color);
        }

        .card-badge.in-progress {
            background: var(--warning-color);
        }

        .card-badge.not-started {
            background: #64748b;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .my-bootcamp-card:hover .card-image {
            transform: scale(1.05);
        }

        .card-content {
            padding: 25px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .card-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: var(--primary-color);
        }

        .card-description {
            color: #64748b;
            margin-bottom: 25px;
            font-size: 0.95rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 0.9rem;
        }

        .card-footer {
            display: flex;
            gap: 10px;
        }

        .card-button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .card-button.primary {
            background: var(--primary-color);
            color: white;
        }

        .card-button.primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .card-button.secondary {
            background: var(--light-color);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .card-button.secondary:hover {
            background: var(--primary-color);
            color: white;
        }

        /* ======= Empty State ======= */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 5rem;
            color: #cbd5e1;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 2rem;
            color: var(--dark-color);
            margin-bottom: 15px;
        }

        .empty-message {
            color: #64748b;
            max-width: 500px;
            margin: 0 auto 30px;
            font-size: 1.1rem;
        }

        .explore-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .explore-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(8, 145, 178, 0.2);
        }

        /* ======= Responsive Design ======= */
        @media (max-width: 1024px) {
            .bootcamps-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }

            .welcome-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-header {
                padding: 100px 0 40px;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .welcome-icon {
                font-size: 3rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .bootcamps-grid {
                grid-template-columns: 1fr;
            }

            .card-footer {
                flex-direction: column;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .dashboard-controls {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .welcome-title {
                font-size: 1.8rem;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }

            .card-content {
                padding: 20px;
            }
        }

        /* ======= Animation ======= */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bootcamp-card {
            animation: fadeInUp 0.6s ease forwards;
            animation-delay: calc(var(--order) * 0.1s);
            opacity: 0;
        }
    </style>

    <section class="myCourses main_content" dir="rtl">
        <!-- Main Header -->
        <div class="profile-banner-area"></div>

        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')

                <div class="col-lg-9 px-4">

                    <!-- Main Container -->
                    <main class="main-container">
                        <div class="dashboard-container">
                            <!-- Dashboard Header -->
                            <div class="dashboard-header">
                                <div class="dashboard-title">
                                    <i>📚</i>
                                    <span>معسكراتي المسجلة</span>
                                </div>


                            </div>

                            <!-- Bootcamps List -->
                            <div class="bootcamps-list">
                                @if (count($my_bootcamps) > 0)
                                    <div class="bootcamps-grid">
                                        @foreach ($my_bootcamps as $index => $bootcamp)
                                            @php

                                                // Get course duration or other info if needed
                                                $duration = count_bootcamp_classes($bootcamp->id);
                                                $date = date('d M Y', $bootcamp->publish_date);
                                            @endphp

                                            <article class="my-bootcamp-card bootcamp-card"
                                                     style="--order: {{ $index }}"

                                                    >
                                                <div class="card-header">
                                                    <img src="{{ get_image($bootcamp->thumbnail) }}"
                                                        alt="{{ $bootcamp->title }}"
                                                        class="card-image"
                                                        onerror="this.src='https://via.placeholder.com/400x200?text=Bootcamp+Image'">
                                                </div>

                                                <div class="card-content">
                                                    <h3 class="card-title">
                                                        <a href="{{ route('theme.my.bootcamp.details', $bootcamp->slug) }}">
                                                            {{ $bootcamp->title }}
                                                        </a>
                                                    </h3>

                                                    <p class="card-description">
                                                        {{ Str::limit(strip_tags($bootcamp->description), 120) }}
                                                    </p>

                                                    <div class="card-meta">
                                                        <div class="meta-item">
                                                            <span>📅</span>
                                                            <span>{{ $date }}</span>
                                                        </div>
                                                        <div class="meta-item">
                                                            <span>🎓</span>
                                                            <span>{{ $duration }} فصل</span>
                                                        </div>

                                                    </div>

                                                    <div class="card-footer">
                                                        <a href="{{ route('theme.my.bootcamp.details', $bootcamp->slug) }}"
                                                            class="card-button primary">
                                                            <span>🚀</span> متابعة التعلم
                                                        </a>


                                                    </div>
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <div class="empty-icon">📚</div>
                                        <h2 class="empty-title">لا توجد معسكرات مسجلة</h2>
                                        <p class="empty-message">
                                            لم تسجل في أي معسكر بعد. ابدأ رحلة التعلم اليوم واكتشف معسكراتنا التدريبية المتخصصة
                                        </p>
                                        <button class="explore-btn"
                                            onclick="window.location.href='{{ route('theme.bootcamps') }}'">
                                            <span>🔍</span> استكشاف المعسكرات
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.my-bootcamp-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.bootcamp-card').forEach(card => {
                observer.observe(card);
            });

            // Initialize filter buttons
            const filterBtns = document.querySelectorAll('.filter-btn');
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });

        function filterBootcamps(status) {
            const cards = document.querySelectorAll('.my-bootcamp-card');

            cards.forEach(card => {
                if (status === 'all') {
                    card.style.display = 'flex';
                } else {
                    const cardStatus = card.getAttribute('data-status');
                    card.style.display = cardStatus === status ? 'flex' : 'none';
                }
            });

            // Update count if needed
            updateActiveCount();
        }

        function updateActiveCount() {
            const activeCards = document.querySelectorAll('.my-bootcamp-card[style*="display: flex"]');
            const activeBtn = document.querySelector('.filter-btn:nth-child(2)');

            if (activeBtn) {
                const currentText = activeBtn.textContent;
                const newText = currentText.replace(/\([0-9]+\)/, `(${activeCards.length})`);
                activeBtn.textContent = newText;
            }
        }



        function continueLearning(url) {
            window.location.href = url;
        }
    </script>
@endsection
@push('js')
@endpush
