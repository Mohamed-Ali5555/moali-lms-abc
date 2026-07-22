<div class="container-fluid p-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ get_phrase('مشاهدات الطلبة') }} - {{ $course->title }}</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggleView" checked>
                    <label class="form-check-label" for="toggleView">
                        <span id="toggleLabel">{{ get_phrase('الطلبة المشاهدين') }}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if(count($sectionsData) > 0)
            @foreach($sectionsData as $sectionData)
            <div class="col-12 mb-4">
                <!-- عنوان الـ Section -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fi-rr-folder me-2"></i>{{ $sectionData['section']->title }}
                        </h5>
                    </div>
                </div>

                <!-- الدروس -->
                @if($sectionData['lessons']->count() > 0)
                <div class="mb-3">
                    <h6 class="mb-2 text-muted">
                        <i class="fi-rr-play me-2"></i>{{ get_phrase('الدروس') }}
                    </h6>
                    <div class="list-group">
                        @foreach($sectionData['lessons'] as $lesson)
                        <div class="list-group-item list-group-item-action lesson-item" 
                             data-lesson-id="{{ $lesson->id }}" 
                             data-type="lesson"
                             style="cursor: pointer;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $lesson->title }}</h6>
                                </div>
                                <div>
                                    <i class="fi-rr-angle-left ms-2"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- الاختبارات -->
                @if($sectionData['quizzes']->count() > 0)
                <div class="mb-3">
                    <h6 class="mb-2 text-muted">
                        <i class="fi-rr-clipboard me-2"></i>{{ get_phrase('الاختبارات') }}
                    </h6>
                    <div class="list-group">
                        @foreach($sectionData['quizzes'] as $quiz)
                        <div class="list-group-item list-group-item-action quiz-item" 
                             data-quiz-id="{{ $quiz->id }}" 
                             data-type="quiz"
                             style="cursor: pointer;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $quiz->title }}</h6>
                                    <small class="text-muted">{{ get_phrase('اختبار') }}</small>
                                </div>
                                <div>
                                    <i class="fi-rr-angle-left ms-2"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- الواجبات -->
                @if($sectionData['assignments']->count() > 0)
                <div class="mb-3">
                    <h6 class="mb-2 text-muted">
                        <i class="fi-rr-file me-2"></i>{{ get_phrase('الواجبات') }}
                    </h6>
                    <div class="list-group">
                        @foreach($sectionData['assignments'] as $assignment)
                        <div class="list-group-item list-group-item-action assignment-item" 
                             data-assignment-id="{{ $assignment->id }}" 
                             data-type="assignment"
                             style="cursor: pointer;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $assignment->title }}</h6>
                                    <small class="text-muted">{{ get_phrase('واجب') }}</small>
                                </div>
                                <div>
                                    <i class="fi-rr-angle-left ms-2"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">{{ get_phrase('لا توجد أقسام في هذا الكورس') }}</div>
            </div>
        @endif
    </div>

    <!-- قائمة الطلبة -->
    <div id="studentsList" class="mt-4" style="display: none;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0" id="studentsListTitle">{{ get_phrase('قائمة الطلبة') }}</h6>
                <button type="button" class="btn-close" onclick="closeStudentsList()"></button>
            </div>
            <div class="card-body">
                <div id="studentsListContent">
                    <!-- سيتم ملؤها بـ AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let showViewed = true; // true = شاهدوا، false = مشاهدوش
    let currentItemId = null;
    let currentItemType = null;

    // Toggle بين شاهدوا ومشاهدوش
    document.getElementById('toggleView').addEventListener('change', function() {
        showViewed = this.checked;
        document.getElementById('toggleLabel').textContent = showViewed 
            ? '{{ get_phrase('الطلبة المشاهدين') }}' 
            : '{{ get_phrase('الطلبة غير المشاهدين') }}';
        
        // تحديث القائمة إذا كانت مفتوحة
        if (currentItemId && currentItemType) {
            loadStudents(currentItemId, currentItemType);
        }
    });

    // عند الضغط على درس/اختبار/واجب - استخدام event delegation
    $(document).on('click', '.lesson-item, .quiz-item, .assignment-item', function(e) {
        e.preventDefault();
        const itemId = $(this).data('lesson-id') || $(this).data('quiz-id') || $(this).data('assignment-id');
        const itemType = $(this).data('type');
        
        if (!itemId || !itemType) {
            return;
        }
        
        currentItemId = itemId;
        currentItemType = itemType;
        
        // إزالة active من جميع العناصر
        $('.lesson-item, .quiz-item, .assignment-item').removeClass('active');
        
        // إضافة active للعنصر المحدد
        $(this).addClass('active');
        
        // تحميل الطلبة
        loadStudents(itemId, itemType);
    });

    function loadStudents(itemId, itemType) {
        const studentsList = document.getElementById('studentsList');
        const studentsListContent = document.getElementById('studentsListContent');
        const studentsListTitle = document.getElementById('studentsListTitle');
        
        studentsListContent.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        studentsList.style.display = 'block';
        
        // تحديث العنوان
        let title = '';
        if (itemType === 'lesson') {
            title = '{{ get_phrase('طلبة شاهدوا الدرس') }}';
        } else if (itemType === 'quiz') {
            title = '{{ get_phrase('طلبة حلوا الاختبار') }}';
        } else if (itemType === 'assignment') {
            title = '{{ get_phrase('طلبة حلوا الواجب') }}';
        }
        
        if (!showViewed) {
            title = title.replace('شاهدوا', 'لم يشاهدوا').replace('حلوا', 'لم يحلوا');
        }
        
        studentsListTitle.textContent = title;
        
        // AJAX request
        $.ajax({
            url: '{{ route("admin.course.get_students") }}',
            type: 'GET',
            data: {
                course_id: {{ $course->id }},
                item_id: itemId,
                item_type: itemType,
                show_viewed: showViewed ? 1 : 0
            },
            success: function(response) {
                studentsListContent.innerHTML = response;
            },
            error: function() {
                studentsListContent.innerHTML = '<div class="alert alert-danger">{{ get_phrase('حدث خطأ أثناء تحميل البيانات') }}</div>';
            }
        });
    }

    function closeStudentsList() {
        document.getElementById('studentsList').style.display = 'none';
        document.querySelectorAll('.lesson-item, .quiz-item, .assignment-item').forEach(function(el) {
            el.classList.remove('active');
        });
        currentItemId = null;
        currentItemType = null;
    }

</script>

<style>
    .lesson-item:hover, .quiz-item:hover, .assignment-item:hover {
        background-color: #f8f9fa;
    }
    .lesson-item.active, .quiz-item.active, .assignment-item.active {
        background-color: #e7f3ff;
        border-color: #0d6efd;
    }
    .lesson-item.active h6, .quiz-item.active h6, .assignment-item.active h6 {
        color: #000 !important;
    }
    .lesson-item.active .text-muted, .quiz-item.active .text-muted, .assignment-item.active .text-muted {
        color: #6c757d !important;
    }
    #studentsList {
        position: sticky;
        bottom: 0;
        background: white;
        border-top: 2px solid #dee2e6;
        max-height: 400px;
        overflow-y: auto;
    }
    .card-header.bg-primary {
        background-color: #0d6efd !important;
    }
</style>
