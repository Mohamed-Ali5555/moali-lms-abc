@extends('layouts.admin')
@push('title', get_phrase('Student'))
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
                    {{ get_phrase('Student List') }}
                </h4>
                @if (has_permission('admin.student.create'))
                    <a href="{{ route('admin.student.create') }}" class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                        <span class="fi-rr-plus"></span>
                        <span>{{ get_phrase('Add new Student') }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="ol-card p-4">
        <div class="ol-card-body">
            <div class="row print-d-none mb-3 mt-3 row-gap-3">
                @if (has_permission('admin.student.export'))

                    <div class="col-md-6  pt-2 pt-md-0">
                        <div class="custom-dropdown">
                            <button class="dropdown-header btn ol-btn-light">
                                {{ get_phrase('Export') }}
                                <i class="fi-rr-file-export ms-2"></i>
                            </button>
                            <ul class="dropdown-list">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="downloadPDF('.print-table', 'student-list')"><i class="fi-rr-file-pdf"></i> {{ get_phrase('PDF') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="window.print();"><i class="fi-rr-print"></i> {{ get_phrase('Print') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if (has_permission('admin.student.search'))

                    <div class="col-md-6">
                        <form class="form-inline" action="{{ route('admin.student.index') }}" method="get">
                            <div class="row row-gap-3">
                                <div class="col-md-9">
                                    <input type="text" class="form-control ol-form-control" id="student_search_query" name="search" value="{{ request('search') }}" placeholder="{{ get_phrase('Search user') }}" />
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn ol-btn-primary w-100" id="submit-button"> {{ get_phrase('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.student.move') }}" method="post" id="student-move-form">
                @csrf
                <div class="ol-card radius-8px mb-4">
                    <div class="ol-card-body py-20px px-20px">
                        <h5 class="title fs-16px mb-3">{{ get_phrase('Move students between categories') }}</h5>
                        <div class="row gy-3 gx-3 align-items-end">

                          <div class="col-md-4">
                                <label class="form-label ol-form-label">{{ get_phrase('Source category') }}</label>
                                <select name="source_category" id="source_category" class="form-select ol-form-control" onchange="filterStudentsByCategory(this)">
                                    <option value="">{{ get_phrase('Select source category (optional)') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if(isset($selected_source_category) && $selected_source_category == $category->id) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label ol-form-label">{{ get_phrase('New Category') }}</label>
                                <select name="category" id="move_target_category" class="form-select ol-form-control" required>
                                    <option value="">{{ get_phrase('Select target category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 text-md-end">
                                <button type="submit" class="btn ol-btn-primary w-100" id="student-move-submit">{{ get_phrase('Move students') }}</button>
                            </div>
                        </div>
                        <p class="text-muted mt-2 mb-0">{{ get_phrase('حدد طلاب محددين من الجدول، أو اختر فئة مصدر لعرض الطلاب تلقائياً ثم انقلهم دفعة واحدة.') }}</p>
                    </div>
                </div>

                <div class="row mt-4">
                <div class="col-md-12">
                    <!-- Table -->
                    @if (count($students) > 0)
                        <div class="admin-tInfo-pagi d-flex justify-content-between justify-content-center align-items-center flex-wrap gr-15">
                            <p class="admin-tInfo">
                                {{ get_phrase('Showing') . ' ' . count($students) . ' ' . get_phrase('of') . ' ' . $students->total() . ' ' . get_phrase('data') }}
                            </p>
                        </div>
                        <div class="table-responsive course_list" id="course_list">
                            <table class="table eTable eTable-2 print-table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAllStudents" onchange="toggleAllStudents(this)">
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                        <th scope="col">{{ get_phrase('Name') }}</th>
                                        <th scope="col">{{ get_phrase('Phone') }}</th>
                                        <th scope="col">{{ get_phrase('Parent Phone') }}</th>
                                        <th scope="col">{{ get_phrase('category') }}</th>
                                        <th scope="col">{{ get_phrase('goverment') }}</th>
                                        {{-- <th scope="col">{{ get_phrase('national-id') }}</th> --}}
                                        <th scope="col">{{ get_phrase('address') }}</th>

                                        <th scope="col">{{ get_phrase('Enrolled Course') }}</th>
                                        <th scope="col">{{ get_phrase('Wallet balane') }}</th>

                                        <th class="print-d-none" scope="col">{{ get_phrase('Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $row)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input student-move-checkbox" type="checkbox" name="student_ids[]" value="{{ $row->id }}">
                                                </div>
                                            </td>
                                            <th scope="row">
                                                <p class="row-number">{{ ++$key }}</p>
                                            </th>
                                            <td>
                                                <div class="dAdmin_profile d-flex align-items-center min-w-100px">
                                                    <div class="dAdmin_profile_img">
                                                        <img class="img-fluid rounded-circle image-45" width="45" height="45" src="{{ get_image($row->photo) }}" />
                                                    </div>
                                                    <div class="ms-1">
                                                        <h4 class="title fs-14px">{{ $row->name }}</h4>
                                                        <p class="sub-title2 text-12px">{{ $row->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ $row->phone }}</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ $row->parent_phone }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ optional($row->get_category)->title }}</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ $row->goverment }}</p>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ $row->national_id }}</p>
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ $row->address }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <a style="color:blue;" href="{{route('admin.student.view_course', $row->id) }}">
                                                    {{ App\Models\Enrollment::where('user_id', $row->id)->count() }}
                                                    {{ get_phrase('Courses') }}
                                                </a>
                                            </td>

                                            <td>
                                                <div class="dAdmin_info_name min-w-150px">
                                                    <p>{{ number_format($row->wallet,2) }}</p>
                                                </div>
                                            </td>
                                            <td class="print-d-none">
                                                <div class="dropdown ol-icon-dropdown ol-icon-dropdown-transparent">
                                                    <button class="btn ol-btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="fi-rr-menu-dots-vertical"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @if (has_permission('admin.student.edit'))
                                                            <li>
                                                                <a class="dropdown-item text-center" href="{{ route('admin.student.edit', $row->id) }}">
                                                                    <i class="fa-solid fa-pen-to-square" style="color:#198754;font-size:20px"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (has_permission('admin.student.delete'))
                                                            <li>
                                                                <a class="dropdown-item text-center" onclick="confirmModal('{{ route('admin.student.delete', $row->id) }}')" href="javascript:void(0)">
                                                                    <i class="fa-solid fa-trash-can" style="color:#be1b2b;font-size:20px"></i>
                                                                </a>
                                                            </li>
                                                        @endif


                                                       @if (has_permission('admin.student.remove-device'))
                                                            <li>
                                                                <a class="dropdown-item text-center" onclick="confirmModal('{{ route('admin.student.remove-device', $row->id) }}')" href="javascript:void(0)">
                                                                    <i class="fa-solid fa-mobile-alt" style="color:#6a4fe1;font-size:20px"></i>
                                                                </a>
                                                            </li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('admin.no_data')
                    @endif

                    <!-- Data info and Pagination -->
                    @if (count($students) > 0)
                        <div class="admin-tInfo-pagi d-flex justify-content-between justify-content-center align-items-center flex-wrap gr-15">
                            <p class="admin-tInfo">
                                {{ get_phrase('Showing') . ' ' . count($students) . ' ' . get_phrase('of') . ' ' . $students->total() . ' ' . get_phrase('data') }}
                            </p>
                            {{ $students->links() }}
                        </div>
                    @endif
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection


@push('js')
    <script>
        const SELECTED_STUDENTS_KEY = 'selected_students';
        const EXCLUDED_STUDENTS_KEY = 'excluded_students';

        // حفظ الطلاب المستثنيين (المُلغاة تحديدهم)
        function saveExcludedStudents() {
            var excludedIds = [];
            document.querySelectorAll('.student-move-checkbox:not(:checked)').forEach(function (checkbox) {
                excludedIds.push(checkbox.value);
            });
            localStorage.setItem(EXCLUDED_STUDENTS_KEY, JSON.stringify(excludedIds));
        }

        // استرجاع الطلاب المستثنيين وإلغاء تحديدهم
        function restoreExcludedStudents() {
            var savedExcluded = localStorage.getItem(EXCLUDED_STUDENTS_KEY);
            if (savedExcluded) {
                var excludedIds = JSON.parse(savedExcluded);
                document.querySelectorAll('.student-move-checkbox').forEach(function (checkbox) {
                    if (excludedIds.includes(checkbox.value)) {
                        checkbox.checked = false;
                    } else {
                        checkbox.checked = true;
                    }
                });
                updateCheckAllState();
            }
        }

        // حفظ الطلاب المحددين (للمود العادي بدون source_category)
        function saveSelectedStudents() {
            var sourceCategory = document.getElementById('source_category').value;

            if (sourceCategory) {
                // إذا كان هناك source_category، احفظ المستثنيين بدلاً من المحددين
                saveExcludedStudents();
            } else {
                // إذا لم يكن هناك source_category، احفظ المحددين العاديين
                var selectedIds = [];
                document.querySelectorAll('.student-move-checkbox:checked').forEach(function (checkbox) {
                    selectedIds.push(checkbox.value);
                });
                localStorage.setItem(SELECTED_STUDENTS_KEY, JSON.stringify(selectedIds));
            }
        }

        // استرجاع الطلاب المحددين (المود العادي بدون source_category)
        function restoreSelectedStudents() {
            var savedIds = localStorage.getItem(SELECTED_STUDENTS_KEY);
            if (savedIds) {
                var selectedIds = JSON.parse(savedIds);
                document.querySelectorAll('.student-move-checkbox').forEach(function (checkbox) {
                    if (selectedIds.includes(checkbox.value)) {
                        checkbox.checked = true;
                    }
                });
                updateCheckAllState();
            }
        }

        // تحديث حالة "تحديد الكل"
        function updateCheckAllState() {
            var checkAll = document.getElementById('checkAllStudents');
            var allCheckboxes = document.querySelectorAll('.student-move-checkbox');
            var checkedCheckboxes = document.querySelectorAll('.student-move-checkbox:checked');

            if (checkAll) {
                checkAll.checked = allCheckboxes.length > 0 && allCheckboxes.length === checkedCheckboxes.length;
            }
        }

        function toggleAllStudents(source) {
            document.querySelectorAll('.student-move-checkbox').forEach(function (checkbox) {
                checkbox.checked = source.checked;
            });
            saveSelectedStudents();
        }

        function filterStudentsByCategory(select) {
            var sourceCategory = select.value;
            var targetCategory = document.getElementById('move_target_category') ? document.getElementById('move_target_category').value : '';
            var searchInput = document.getElementById('student_search_query');
            var query = [];

            if (sourceCategory) {
                query.push('source_category=' + sourceCategory);
            }
            if (targetCategory) {
                query.push('category=' + targetCategory);
            }
            if (searchInput && searchInput.value.trim() !== '') {
                query.push('search=' + encodeURIComponent(searchInput.value.trim()));
            }

            var url = window.location.pathname;
            if (query.length) {
                url += '?' + query.join('&');
            }
            window.location.href = url;
        }

        function prepareFormData(form) {
            var sourceCategory = document.getElementById('source_category').value;

            // إذا لم يتم اختيار source category، إرسل الطلاب المحددين فقط
            if (!sourceCategory) {
                return true;
            }

            // إذا تم اختيار source category:
            // احصل على الطلاب المستثنيين (المُلغاة تحديدهم)
            var excludedIds = [];
            document.querySelectorAll('.student-move-checkbox:not(:checked)').forEach(function (checkbox) {
                excludedIds.push(checkbox.value);
            });

            // إزالة أي حقول student_ids سابقة
            var inputs = form.querySelectorAll('input[name="student_ids[]"]');
            inputs.forEach(function(input) {
                input.remove();
            });

            // إذا كان هناك مستثنيين، أضفهم كحقول hidden
            if (excludedIds.length > 0) {
                excludedIds.forEach(function(id) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'student_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var sourceCategory = document.getElementById('source_category');

            if (sourceCategory && sourceCategory.value) {
                // Mode: اختيار source category
                // حدد الكل أولاً
                document.querySelectorAll('.student-move-checkbox').forEach(function (checkbox) {
                    checkbox.checked = true;
                });

                // ثم أرجع المستثنيين السابقين
                restoreExcludedStudents();

                // تحديث حالة Select All
                var checkAll = document.getElementById('checkAllStudents');
                if (checkAll) {
                    updateCheckAllState();
                }
            } else {
                // Mode: اختيار طلاب مفردين
                restoreSelectedStudents();
            }

            // إضافة listeners لكل checkbox
            document.querySelectorAll('.student-move-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function() {
                    saveSelectedStudents();
                    updateCheckAllState();
                });
            });

            // إضافة event listener لـ form submit
            var form = document.getElementById('student-move-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    prepareFormData(form);
                });
            }

            // مسح التحديل بعد الإرسال الناجح
            var successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                clearSelectedStudents();
            }
        });

        // دالة لمسح جميع التحديلات
        function clearSelectedStudents() {
            localStorage.removeItem(SELECTED_STUDENTS_KEY);
            localStorage.removeItem(EXCLUDED_STUDENTS_KEY);
            document.querySelectorAll('.student-move-checkbox').forEach(function (checkbox) {
                checkbox.checked = false;
            });
            updateCheckAllState();
        }
    </script>
@endpush
