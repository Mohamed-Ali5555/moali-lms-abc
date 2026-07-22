@extends('layouts.admin')
@push('title', get_phrase('Assign Permission'))
@push('meta')@endpush
@push('css')@endpush
@section('content')
    <div class="ol-card radius-8px">
        <div class="ol-card-body my-3 py-12px px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('Admin Permissions') }}
                </h4>

                <a href="{{ route('admin.admins.index') }}" class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                    <span class="fi-rr-arrow-alt-left"></span>
                    <span>{{ get_phrase('Back') }}</span>
                </a>
            </div>
        </div>
    </div>
    @php
        $allRoutes = [
            // 1. Bookstore
            'bookstore' => [
                'admin.bookstore' => get_phrase('View'),
                'admin.bookstore.activation' => get_phrase('Activation'),
                'admin.bookstore.edit' => get_phrase('Edit'),
                'admin.bookstore.create' => get_phrase('Create'),
                'admin.bookstore.delete' => get_phrase('Delete'),
                'admin.bookstore.sort' => get_phrase('sort'),

            ],

            // 2. Dashboard
            'dashboard' => [
                'admin.dashboard.index' => get_phrase('View'),
                'admin.phpinfo' => get_phrase('View PHP Info'),
                'admin.revenue' => get_phrase('admin-revenue'),
                'admin.dashboard' => get_phrase('index'),

            ],

            // 3. Categories
            'categories' => [
                'admin.categories' => get_phrase('View'),
                'admin.category.create' => get_phrase('Create'),
                'admin.category.edit' => get_phrase('Edit'),
                'admin.category.delete' => get_phrase('Delete'),
            ],

             // 3.sub_Categories
            'sub_categories' => [
                'admin.sub_categories.create' => get_phrase('Create'),
                'admin.sub_categories.edit' => get_phrase('Edit'),
                'admin.sub_categories.delete' => get_phrase('Delete'),
            ],


            // 4. Wallet
            'wallet' => [
                'admin.wallet.index' => get_phrase('View'),
                'admin.wallet.create' => get_phrase('Create'),
                // 'admin.wallet.edit' => get_phrase('Edit'),
                'admin.wallet.destroy' => get_phrase('Delete'),

                'admin.wallet.create_decreas' => get_phrase('create_decreas'),
                'admin.wallet.export' => get_phrase('button export'),
                'admin.wallet.search' => get_phrase('search input'),


            ],

            // 5. Wallet Category
            'wallet_category' => [
                'admin.wallet_category.index' => get_phrase('View'),
                'admin.wallet_category.create' => get_phrase('Create'),
                // 'admin.wallet_category.edit' => get_phrase('Edit'),
                'admin.wallet_category.destroy' => get_phrase('Delete'),

                'admin.wallet_category.search' => get_phrase('search input'),
                'admin.wallet_category.export' => get_phrase('button export'),

            ],

            // 6. Courses
            'courses' => [
                'admin.courses' => get_phrase('View'),
                'admin.course.create' => get_phrase('Create'),
                'admin.course.edit' => get_phrase('Edit'),
                'admin.course.duplicate' => get_phrase('Duplicate'),
                'admin.course.status' => get_phrase('Change Status'),
                'admin.course.delete' => get_phrase('Delete'),
                'admin.course.draft' => get_phrase('Draft'),
                'admin.course.approval' => get_phrase('Approval'),


                'admin.course.export' => get_phrase('button export'),
                'admin.course.search' => get_phrase('search input'),
                'admin.course.filter' => get_phrase('filter'),
                'admin.course.view_on_front' => get_phrase('view_on_front'),
                'admin.course.course_playing' => get_phrase('course_playing'),

            ],

            // 7. Invoice
            'invoice' => [
                'admin.invoice' => get_phrase('View'),
            ],

            // 8. Curriculum
            'curriculum' => [
                'admin.section.delete' => get_phrase('Delete'),
                'admin.section.sort' => get_phrase('Sort'),
                'admin.section.create' => get_phrase('Create'),
                'admin.section.edit' => get_phrase('Edit'),
                'admin.lesson.delete' => get_phrase('Delete'),
                'admin.lesson.sort' => get_phrase('Sort'),
                'admin.lesson.create' => get_phrase('Create'),

                'admin.quiz.create' => get_phrase('Create quiz'),
                'admin.quiz.choose' => get_phrase('choose quiz'),
                'admin.assingemnt.choose' => get_phrase('choose assingemnt'),
                'admin.assingemnt.choose' => get_phrase('choose assingemnt'),
                'admin.lesson.edit' => get_phrase('lesson edit'),
                'admin.quiz_result.index' => get_phrase('quiz_result view'),

            ],

            // 9. Users (Admins, Instructors, Students)
            'admins' => [
                'admin.admins.index' => get_phrase('View'),
                'admin.admins.create' => get_phrase('Create'),
                'admin.admins.edit' => get_phrase('Edit'),
                'admin.admins.delete' => get_phrase('Delete'),
                'admin.admins.permission' => get_phrase('Manage Permissions'),
                'admin.manage.profile' => get_phrase('Manage Profile'),
            ],

            'student' => [
                'admin.student.index' => get_phrase('View'),
                'admin.student.create' => get_phrase('Create'),
                'admin.student.edit' => get_phrase('Edit'),
                'admin.student.delete' => get_phrase('Delete'),
                'admin.student.view_course' => get_phrase('View Courses'),
                'admin.student.remove-device' => get_phrase('Remove Device'),
                'admin.enroll.history' => get_phrase('View Enroll History'),
                'admin.enroll.history.delete' => get_phrase('Delete Enroll History'),
                'admin.student.enroll' => get_phrase('Enroll Student'),
                'admin.student.get' => get_phrase('Get Students'),
                'admin.student.post' => get_phrase('Post Students'),
                'admin.student.not_enroll' => get_phrase('View Not Enrolled Students'),


                'admin.enroll.history.search' => get_phrase('input search on enroll history'),
                'admin.student.not_enroll.search' => get_phrase('input search on not_enroll history'),
                'admin.student.not_enroll.export' => get_phrase('export button on not_enroll history'),

                'admin.student.search' => get_phrase('input search'),
                'admin.student.export' => get_phrase('button export'),


            ],

            'instructor' => [
                'admin.instructor.index' => get_phrase('View'),
                'admin.instructor.create' => get_phrase('Create'),
                'admin.instructor.edit' => get_phrase('Edit'),
                'admin.instructor.delete' => get_phrase('Delete'),
                'admin.instructor.course' => get_phrase('View Courses'),
                'admin.instructor.payout' => get_phrase('View Payout'),
                'admin.instructor.payout.filter' => get_phrase('Filter Payout'),
                'admin.instructor.payout.invoice' => get_phrase('View Payout Invoice'),
                'admin.instructor.payment' => get_phrase('Payment'),
                'admin.instructor.setting' => get_phrase('Settings'),
                'admin.instructor.application' => get_phrase('View Applications'),
                'admin.instructor.application.approve' => get_phrase('Approve Application'),
                'admin.instructor.application.delete' => get_phrase('Delete Application'),
                'admin.instructor.application.download' => get_phrase('Download Application'),
            ],

            'bank_questions_category' => [
                'admin.category.bank.questions.index' => get_phrase('View Bank Questions Categories'),
                'admin.category.bank.questions.create' => get_phrase('Create Bank Questions Category'),
                'admin.category.bank.questions.edit' => get_phrase('Edit Bank Questions Category'),
                'admin.category.bank.questions.delete' => get_phrase('Delete Bank Questions Category'),
            ],

            'bank_quizs' => [
                'admin.bank.quizs.index' => get_phrase('View Bank Quizzes'),
                'admin.bank.quizs.create' => get_phrase('Create Bank Quiz'),
                'admin.bank.quizs.edit' => get_phrase('Edit Bank Quiz'),
                'admin.bank.quizs.delete' => get_phrase('Delete Bank Quiz'),


                'admin.bank.quizs.export' => get_phrase('export Bank Quiz'),
                'admin.bank.quizs.search' => get_phrase('search on Bank Quiz'),
                'admin.bank.quizs.filter' => get_phrase('filter Bank Quiz'),
                'admin.bank.quizs.show_question' => get_phrase('show_question Bank Quiz'),
            ],

            'bank_questions' => [
                'admin.bank.question.index' => get_phrase('View Bank Questions'),
                'admin.bank.question.delete' => get_phrase('Delete Bank Question'),
                'admin.bank.question.sort' => get_phrase('Sort Bank Questions'),
                'admin.bank.question.type' => get_phrase('Load Question Type'),
                'admin.bank.quizs.using.category' => get_phrase('View Quizzes Using Category'),


                'admin.bank.question.edit' => get_phrase('edit Bank Question'),
                'admin.bank.question.search' => get_phrase('search input on bank questions'),
                'admin.bank.question.filter' => get_phrase('filter button on bank questions'),
                'admin.bank.question.export' => get_phrase('export on bank questions'),
                'admin.bank.question.sort' => get_phrase('Sort Bank Questions'),

            ],



            // 10. Reports
            'reports' => [
                'admin.revenue' => get_phrase('View Revenue'),
                'admin.revenue.delete' => get_phrase('Delete Revenue'),
                'admin.instructor.revenue' => get_phrase('View Instructor Revenue'),
                'admin.instructor_revenue.delete' => get_phrase('Delete Instructor Revenue'),
                // 'admin.purchase.history' => get_phrase('View Purchase History'),
                // 'admin.purchase.history.invoice' => get_phrase('View Purchase Invoice'),


                'admin.revenue.export' => get_phrase('export Revenue'),
                'admin.revenue.search' => get_phrase('search Revenue'),

                'admin.instructor.revenue.export' => get_phrase('export Instructor Revenue'),
                'admin.instructor.revenue.search' => get_phrase('search Instructor Revenue'),

                'admin.purchase.history.course' => get_phrase('View Purchase History course'),
                'admin.purchase.history.book' => get_phrase('View Purchase History book'),
                'admin.purchase.history.course.invoice' => get_phrase('View Purchase invoice course'),
                'admin.purchase.history.book.invoice' => get_phrase('View Purchase invoice book'),
                'admin.purchase.history.course.search' => get_phrase('input search Purchase course History'),
                'admin.purchase.history.book.search' => get_phrase('input search Purchase book History'),
                'admin.purchase.history.course.export' => get_phrase('export Purchase course History'),
                'admin.purchase.history.book.export' => get_phrase('export Purchase book History'),

            ],

            // 11. Newsletter
            'newsletter' => [
                'admin.newsletter' => get_phrase('View'),
                'admin.newsletter.delete' => get_phrase('Delete'),
                'admin.subscribed_user' => get_phrase('View Subscribers'),
                'admin.subscribed_user.delete' => get_phrase('Delete Subscribers'),
                'admin.newsletters.form' => get_phrase('View Newsletter Form'),
                'admin.get.user' => get_phrase('Get Users'),
                'admin.send.newsletters' => get_phrase('Send Newsletters'),


                'admin.newsletter.create' => get_phrase('create newsletter'),
                'admin.newsletter.edit' => get_phrase('edit newsletter'),
                'admin.subscribed_user.export' => get_phrase('export Subscribers'),
                'admin.subscribed_user.search' => get_phrase('search Subscribers'),

            ],

            // 12. Blogs
            'blogs' => [
                'admin.blogs' => get_phrase('View'),
                'admin.blog.create' => get_phrase('Create'),
                'admin.blog.edit' => get_phrase('Edit'),
                'admin.blog.delete' => get_phrase('Delete'),
                'admin.blog.status' => get_phrase('Change Status'),
                'admin.blog.pending' => get_phrase('View Pending Blogs'),
                'admin.blog.settings' => get_phrase('View Blog Settings'),


                'admin.blog.export' => get_phrase('export button on Blogs'),
                'admin.blog.view_front' => get_phrase('Blogs view_front'),
                'admin.blog.search' => get_phrase('input search on Blogs'),
                'admin.blog.pending.search' => get_phrase('search input on View Pending Blogs'),
                'admin.blog.pending.export' => get_phrase('export button on View Pending Blogs'),

            ],

            // 13. Blog Categories
            'blog_categories' => [
                'admin.blog.category' => get_phrase('View'),
                'admin.blog.category.create' => get_phrase('Create'),
                'admin.blog.category.delete' => get_phrase('Delete'),

                'admin.blog.category.edit' => get_phrase('edit'),

            ],

            // 22. Offline Payments
            'offline_payments' => [
                'admin.offline.payments' => get_phrase('View Offline Payments'),
                'admin.offline.payment.doc' => get_phrase('Download Document'),
                'admin.offline.payment.accept' => get_phrase('Accept Payment'),
                'admin.offline.payment.decline' => get_phrase('Decline Payment'),
                'admin.offline.payment.delete' => get_phrase('Delete Payment'),
            ],

            // 23. Coupons
            'coupons' => [
                'admin.coupons' => get_phrase('View Coupons'),
                'admin.coupon.create' => get_phrase('Create Coupon'),
                'admin.coupon.delete' => get_phrase('Delete Coupon'),
                'admin.coupon.edit' => get_phrase('Edit Coupon'),
                'admin.coupon.status' => get_phrase('Change Coupon Status'),

                'admin.coupon.search' => get_phrase('Coupon input search'),
                'admin.coupon.export' => get_phrase('Coupon export button'),

            ],

            // 24. Course Quiz
            'course_quiz' => [
                'admin.course.quiz.delete' => get_phrase('Delete Quiz'),
                'admin.quiz.participant.result' => get_phrase('View Quiz Results'),
                'admin.quiz.result.preview' => get_phrase('Preview Quiz Results'),
                'admin.course.quiz.create' => get_phrase('Create Quiz'),
                'admin.course.quiz.edit' => get_phrase('Edit Quiz'),
            ],

            // 24. exams&assinments
            'exams_and_assinments' => [
                'admin.exams.list' => get_phrase('View Exams List'),
                'admin.assignments.list' => get_phrase('View assignments List'),


                'admin.exams.search' => get_phrase('search Exams List'),
                'admin.exams.filter' => get_phrase('filter Exams List'),
                'admin.exams.export' => get_phrase('button export Exams '),
                'admin.exams.activation' => get_phrase('Activate Exam'),


                'admin.assignments.search' => get_phrase('search assignments List'),
                'admin.assignments.filter' => get_phrase('filter assignments List'),
                'admin.assignments.export' => get_phrase('button export assignments'),
                'admin.assignments.activation' => get_phrase('Activate assignment'),
            ],

            // 25. Questions
            'questions' => [
                'admin.course.question.delete' => get_phrase('Delete Question'),
                'admin.course.question.sort' => get_phrase('Sort Questions'),
                'admin.load.question.type' => get_phrase('Load Question Type'),
                'admin.question.bank' => get_phrase('View Question Bank'),
            ],

            // 26. Bootcamp Categories
            'bootcamp_categories' => [
                'admin.bootcamp.categories' => get_phrase('View Bootcamp Categories'),
                'admin.bootcamp.category.delete' => get_phrase('Delete Bootcamp Category'),


                'admin.bootcamp.category.edit' => get_phrase('edit Bootcamp Categories'),
                'admin.bootcamp.category.create' => get_phrase('create Bootcamp Categories'),

            ],

            // 27. Bootcamps
            'bootcamps' => [
                'admin.bootcamps' => get_phrase('View Bootcamps'),
                'admin.bootcamp.create' => get_phrase('Create Bootcamp'),
                'admin.bootcamp.edit' => get_phrase('Edit Bootcamp'),
                'admin.bootcamp.delete' => get_phrase('Delete Bootcamp'),
                'admin.bootcamp.status' => get_phrase('Change Bootcamp Status'),
                'admin.bootcamp.duplicate' => get_phrase('Duplicate Bootcamp'),
                'admin.bootcamp.purchase.history' => get_phrase('View Purchase History'),
                'admin.bootcamp.purchase.invoice' => get_phrase('View Purchase Invoice'),

                'admin.bootcamp.view_front' => get_phrase('view Bootcamp on frontend'),
                'admin.bootcamp.search' => get_phrase('search input on Bootcamp'),
                'admin.bootcamp.filter' => get_phrase('filter on Bootcamp'),
                'admin.bootcamp.export' => get_phrase('export button on Bootcamp'),

            ],

            // 28. Bootcamp Modules
            'bootcamp_modules' => [
                'admin.bootcamp.module.delete' => get_phrase('Delete Module'),
                'admin.bootcamp.module.sort' => get_phrase('Sort Modules'),


                'admin.bootcamp.module.create' => get_phrase('create Modules'),
                'admin.bootcamp.module.edit' => get_phrase('edit Modules'),

            ],

            // 29. Bootcamp Live Classes
            'bootcamp_live_classes' => [
                'admin.bootcamp.live.class.delete' => get_phrase('Delete Live Class'),
                'admin.bootcamp.live.class.join' => get_phrase('Join Live Class'),
                'admin.bootcamp.class.end' => get_phrase('End Live Class'),
                'admin.update.on.end.class' => get_phrase('Update On End Class'),
            ],

            // 30. Bootcamp Resources
            'bootcamp_resources' => [
                'admin.bootcamp.resource.delete' => get_phrase('Delete Resource'),
                'admin.bootcamp.resource.download' => get_phrase('Download Resource'),
            ],

            // 31. Team Training
            'team_training' => [
                'admin.team.packages' => get_phrase('View Team Packages'),
                'admin.team.packages.create' => get_phrase('Create Team Package'),
                'admin.team.packages.purchase.history' => get_phrase('View Purchase History'),
                'admin.team.packages.edit' => get_phrase('Edit Team Package'),
                'admin.team.packages.delete' => get_phrase('Delete Team Package'),
                'admin.team.packages.duplicate' => get_phrase('Duplicate Team Package'),
                'admin.team.toggle.status' => get_phrase('Toggle Team Package Status'),
                'admin.team.packages.purchase.invoice' => get_phrase('View Purchase Invoice'),
                'admin.get.courses.by.privacy' => get_phrase('Get Courses By Privacy'),
                'admin.get.course.price' => get_phrase('Get Course Price'),
            ],

            // 32. Tutor Booking
            'tutor_booking' => [
                'admin.tutor_subjects' => get_phrase('View Tutor Subjects'),
                'admin.tutor_subject_create' => get_phrase('Create Tutor Subject'),
                'admin.tutor_subject_edit' => get_phrase('Edit Tutor Subject'),
                'admin.tutor_subject_status' => get_phrase('Change Tutor Subject Status'),
                'admin.tutor_subject_delete' => get_phrase('Delete Tutor Subject'),
                'admin.tutor_categories' => get_phrase('View Tutor Categories'),
                'admin.tutor_category_create' => get_phrase('Create Tutor Category'),
                'admin.tutor_category_edit' => get_phrase('Edit Tutor Category'),
                'admin.tutor_category_status' => get_phrase('Change Tutor Category Status'),
                'admin.tutor_category_delete' => get_phrase('Delete Tutor Category'),
            ],

            // 18. Contact
            'contact' => [
                'admin.contacts' => get_phrase('View Contacts'),
                'admin.contact.reply' => get_phrase('Reply'),
                'admin.contact.delete' => get_phrase('Delete Contact'),


               'admin.contact.search' => get_phrase('Search Input'),
               'admin.contact.export' => get_phrase('export button'),

            ],

            // 19. Messages
            'messages' => [
                'admin.message.create' => get_phrase('Create Message'),
                'admin.message.thread.store' => get_phrase('Create Thread'),
                'admin.message' => get_phrase('View Messages'),
            ],

            // 20. SEO
            // 'seo' => [
            // ],

            // 21. API Configurations
            'api_configurations' => [
                'admin.api.configurations' => get_phrase('View API Configurations'),
            ],

            // 14. Settings
            'settings' => [
                'admin.system.settings' => get_phrase('View System Settings'),
                'admin.website.settings' => get_phrase('View Website Settings'),
                'admin.drip.settings' => get_phrase('View Drip Content Settings'),
                'admin.payment.settings' => get_phrase('View Payment Settings'),
                'admin.manage.language' => get_phrase('Manage Languages'),
                'admin.language.delete' => get_phrase('Delete Language'),
                'admin.language.phrase.edit' => get_phrase('Edit Phrase'),
                'admin.language.phrase.import' => get_phrase('Import Phrase'),
                'admin.notification.settings' => get_phrase('View Notification Settings'),
                'admin.player.settings' => get_phrase('View Player Settings'),
                'admin.about' => get_phrase('View About'),
                'admin.certificate.settings' => get_phrase('View Certificate Settings'),
                'admin.certificate.builder' => get_phrase('View Certificate Builder'),
                'admin.review.create' => get_phrase('Create Review'),
                'admin.review.edit' => get_phrase('Edit Review'),
                'admin.review.delete' => get_phrase('Delete Review'),
                'admin.update.home' => get_phrase('Update Home'),

                'admin.seo.settings' => get_phrase('View SEO Settings'),
                'admin.pages' => get_phrase('View pages'),
                'admin.language.phrase.create' => get_phrase('create language Phrase'),



                'admin.theme.settings' => get_phrase('View theme Settings'),
                'admin.theme.settings.social' => get_phrase('View theme social Settings'),
                'admin.theme.settings.feature' => get_phrase('View theme feature Settings'),
                'admin.settings.smtp' => get_phrase('View smtp Settings'),
                'admin.settings.home_page' => get_phrase('View home page Settings'),


            ],

            // 15. Live Classes
            'live_classes' => [
                'admin.live.class.delete' => get_phrase('Delete'),
                'admin.live.class.start' => get_phrase('Start Live Class'),
                'admin.live.class.settings' => get_phrase('View Live Class Settings'),
            ],

            // 16. OpenAI
            'open_ai' => [
                'admin.open.ai.settings' => get_phrase('View OpenAI Settings'),
                'admin.open.ai.generate' => get_phrase('Generate Content'),
            ],
        ];
        $permission_row = DB::table('permissions')
            ->where('admin_id', $admin->id)
            ->first();
        $permissions = json_decode($permission_row->permissions ?? '{}', true);
    @endphp

    <div class="row">
        <div class="col-xl-8">
            <div class="ol-card p-4">
                <div class="ol-card-body">
                    <div class="col-6 pt-3">
                        <p class="column-title">{{ get_phrase('Assign permission for') }}: {{ $admin->name }}</p>
                    </div>
                    <div class="pb-3">
                        <small> <strong>{{ get_phrase('Note') }}</strong> :
                            {{ get_phrase('You can toggle the switch for enabling or disabling a feature to access') }}</small>
                    </div>
                    <div class="accordion" id="permissionsAccordion">
                        @foreach ($allRoutes as $section => $routes)
                            <div class="accordion-item mb-3 border border-2">
                                <h2 class="accordion-header" id="heading-{{ $section }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $section }}" aria-expanded="false" aria-controls="collapse-{{ $section }}">
                                        {{ ucfirst($section) }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $section }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $section }}" data-bs-parent="#permissionsAccordion">
                                    <div class="accordion-body">
                                        <!-- Add a toggle button for the entire section -->
                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="toggleAllPermissions('{{ $section }}', '{{ $admin->id }}')">
                                                {{ get_phrase('Toggle All') }}
                                            </button>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center gap-4">
                                            @foreach ($routes as $permission => $routeName)
                                                <div class="d-flex align-items-center gap-2">
                                                    <label for="{{$permission}}" class="form-label mb-0">
                                                        {{ ucfirst($routeName) }}
                                                    </label>
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input permission-checkbox"
                                                        id="{{$permission}}"
                                                        {{-- id="{{ $admin->id . '-' . $routeName }}"  --}}
                                                        data-section="{{$section}}"
                                                        data-route-name="{{ $permission }}"
                                                        data-switch="bool"
                                                        onchange="setPermission('{{ $admin->id }}', this)"
                                                        @if (is_array($permissions) && in_array($permission, $permissions)) checked @endif
                                                    >
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="accordion" id="permissionsAccordion">
                        @foreach ($allRoutes as $section => $routes)
                            <div class="accordion-item mb-3 border border-2">
                                <h2 class="accordion-header" id="heading-{{ $section }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $section }}" aria-expanded="false" aria-controls="collapse-{{ $section }}">
                                        {{ ucfirst($section) }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $section }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $section }}" data-bs-parent="#permissionsAccordion">
                                    <div class="accordion-body">
                                        <div class="d-flex flex-wrap align-items-center gap-4">
                                            @foreach ($routes as $permission => $routeName)
                                                <div class="d-flex align-items-center gap-2">
                                                    <label for="{{ $admin->id . '-' . $routeName }}" class="form-label mb-0">
                                                        {{ ucfirst($routeName) }}
                                                    </label>
                                                    <input type="checkbox" class="form-check-input" id="{{ $admin->id . '-' . $routeName }}" data-switch="bool"
                                                        onchange="setPermission('{{ $admin->id }}', '{{ $permission }}')"
                                                        @if (is_array($permissions) && in_array($permission, $permissions)) checked @endif>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    "use strict";

    function setPermission(user_id, inputElement) {
        const permission = inputElement.getAttribute('data-route-name'); // استخراج اسم الـ route من الـ data attribute
        const isChecked = inputElement.checked; // حالة التفعيل (true/false)

        $.ajax({
            type: "post",
            url: "{{ route('admin.admins.permission.store') }}/" + user_id,
            data: {
                user_id: user_id,
                permission: permission,
                is_checked: isChecked, // إرسال حالة التفعيل
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response == 1) {
                    success("{{ get_phrase('Permission updated') }}");
                }
            }
        });
    }

    function toggleAllPermissions(section, user_id) {
        const checkboxes = document.querySelectorAll(`.permission-checkbox[data-section="${section}"]`);
        const isAnyUnchecked = Array.from(checkboxes).some(checkbox => !checkbox.checked);

        checkboxes.forEach(checkbox => {
            if (isAnyUnchecked) {
                if (!checkbox.checked) {
                    checkbox.checked = true;
                    setPermission(user_id, checkbox); // تمرير الـ input نفسه
                }
            } else {
                if (checkbox.checked) {
                    checkbox.checked = false;
                    setPermission(user_id, checkbox); // تمرير الـ input نفسه
                }
            }
        });
    }
</script>
@endpush
