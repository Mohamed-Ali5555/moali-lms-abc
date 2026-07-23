@extends('layouts.admin')
@push('title', get_phrase('Theme settings'))
@push('meta')@endpush
@push('css')
<style>
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 10px;
    }
    .image-preview {
        position: relative;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background: #f9f9f9;
        text-align: center;
    }
    .image-preview img {
        max-width: 150px;
        max-height: 100px;
        object-fit: contain;
    }
    .image-preview .current-image-text {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
    .settings-section {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        color: #333;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control:focus {
        border-color: #4A90E2;
        box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
    }
    .toggle-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .toggle-label {
        margin-bottom: 0;
    }
</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="ol-card p-4">
                <h3 class="title text-14px mb-4">{{ get_phrase('Theme Settings') }}</h3>
                <div class="ol-card-body">
                    <form class="required-form" action="{{ route('admin.theme.settings.store', 'theme_settings') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- قسم الصور -->
                        <div class="settings-section">
                            <h4 class="section-title">{{ get_phrase('Images & Logos') }}</h4>

                            <div class="row">
                                <!-- Logo -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo" class="form-label ol-form-label">{{ get_phrase('Logo') }} <small class="text-muted">({{ get_phrase('optional') }})</small></label>
                                        <input type="file" name="logo" class="form-control ol-form-control" id="logo" accept="image/*" />

                                        @if(get_theme_settings('logo'))
                                            <div class="image-preview-container">
                                                <div class="image-preview">
                                                    <img src="{{ asset(get_theme_settings('logo')) }}" alt="Current Logo">
                                                    <div class="current-image-text">{{ get_phrase('Current Logo') }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Dark Logo -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dark_logo" class="form-label ol-form-label">{{ get_phrase('Dark Logo') }} <small class="text-muted">({{ get_phrase('optional') }})</small></label>
                                        <input type="file" name="dark_logo" class="form-control ol-form-control" id="dark_logo" accept="image/*" />

                                        @if(get_theme_settings('dark_logo'))
                                        <div class="image-preview-container">
                                            <div class="image-preview">
                                                <img src="{{ asset(get_theme_settings('dark_logo')) }}" alt="Current Dark Logo">
                                                <div class="current-image-text">{{ get_phrase('Current Dark Logo') }}</div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Thumbnail -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumbnail" class="form-label ol-form-label">{{ get_phrase('Thumbnail') }} <small class="text-muted">({{ get_phrase('optional') }})</small></label>
                                        <input type="file" name="thumbnail" class="form-control ol-form-control" id="thumbnail" accept="image/*" />

                                        @if(get_theme_settings('thumbnail'))
                                        <div class="image-preview-container">
                                            <div class="image-preview">
                                                <img src="{{ asset(get_theme_settings('thumbnail')) }}" alt="Current Thumbnail">
                                                <div class="current-image-text">{{ get_phrase('Current Thumbnail') }}</div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Dark Thumbnail -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dark_thumbnail" class="form-label ol-form-label">{{ get_phrase('Dark Thumbnail') }} <small class="text-muted">({{ get_phrase('optional') }})</small></label>
                                        <input type="file" name="dark_thumbnail" class="form-control ol-form-control" id="dark_thumbnail" accept="image/*" />

                                        @if(get_theme_settings('dark_thumbnail'))
                                        <div class="image-preview-container">
                                            <div class="image-preview">
                                                <img src="{{ asset(get_theme_settings('dark_thumbnail')) }}" alt="Current Dark Thumbnail">
                                                <div class="current-image-text">{{ get_phrase('Current Dark Thumbnail') }}</div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- قسم المعلومات الأساسية -->
                        <div class="settings-section">
                            <h4 class="section-title">{{ get_phrase('Basic Information') }}</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label ol-form-label" for="jop_title">{{ get_phrase('Job Title') }}<span class="required">*</span></label>
                                        <input type="text" name="jop_title" id="jop_title" class="form-control ol-form-control" value="{{ get_theme_settings('jop_title') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label ol-form-label" for="name">{{ get_phrase('Owner Name') }}<span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control ol-form-control" value="{{ get_theme_settings('name') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="instructor_description" class="form-label ol-form-label">{{ get_phrase('Instructor Description') }}<span class="required">*</span></label>
                                <textarea name="instructor_description" rows="4" class="form-control ol-form-control text_editor" id="instructor_description" placeholder="{{ get_phrase('Enter your instructor description') }}" aria-label="{{ get_phrase('Enter your instructor description') }}" required>{{ get_theme_settings('instructor_description') }}</textarea>
                            </div>
                        </div>

                        <!-- قسم إعدادات الميزات -->
                        <div class="settings-section">
                            <h4 class="section-title">{{ get_phrase('Feature Settings') }}</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="toggle-group">
                                            <label class="form-label ol-form-label toggle-label" for="book_status">{{ get_phrase('Book Status') }}</label>
                                            <select class="form-control ol-form-control ol-select2" name="book_status" id="book_status" required>
                                                <option value="">{{ get_phrase('Choose status ...') }}</option>
                                                <option value="1" @if (get_theme_settings('book_status') == 1) selected @endif>{{ get_phrase('Active') }}</option>
                                                <option value="0" @if (get_theme_settings('book_status') == 0) selected @endif>{{ get_phrase('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="toggle-group">
                                            <label class="form-label ol-form-label toggle-label" for="course_status">{{ get_phrase('Course Description Status') }}</label>
                                            <select class="form-control ol-form-control ol-select2" name="course_status" id="course_status" required>
                                                <option value="">{{ get_phrase('Choose status ...') }}</option>
                                                <option value="1" @if (get_theme_settings('course_status') == 1) selected @endif>{{ get_phrase('Active') }}</option>
                                                <option value="0" @if (get_theme_settings('course_status') == 0) selected @endif>{{ get_phrase('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="toggle-group">
                                            <label class="form-label ol-form-label toggle-label" for="sub_status">{{ get_phrase('Subscription Button Status') }}</label>
                                            <select class="form-control ol-form-control ol-select2" name="sub_status" id="sub_status" required>
                                                <option value="">{{ get_phrase('Choose status ...') }}</option>
                                                <option value="1" @if (get_theme_settings('sub_status') == 1) selected @endif>{{ get_phrase('Active') }}</option>
                                                <option value="0" @if (get_theme_settings('sub_status') == 0) selected @endif>{{ get_phrase('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="toggle-group">
                                            <label class="form-label ol-form-label toggle-label" for="terms_status">{{ get_phrase('Terms Status') }}</label>
                                            <select class="form-control ol-form-control ol-select2" name="terms_status" id="terms_status" required>
                                                <option value="">{{ get_phrase('Choose status ...') }}</option>
                                                <option value="1" @if (get_theme_settings('terms_status') == 1) selected @endif>{{ get_phrase('Active') }}</option>
                                                <option value="0" @if (get_theme_settings('terms_status') == 0) selected @endif>{{ get_phrase('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- قسم الدعم الفني -->
                        <div class="settings-section">
                            <h4 class="section-title">{{ get_phrase('Technical Support') }}</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="toggle-group">
                                            <label class="form-label ol-form-label toggle-label" for="technical_status">{{ get_phrase('Technical Support Status') }}</label>
                                            <select class="form-control ol-form-control ol-select2" name="technical_status" id="technical_status" required>
                                                <option value="">{{ get_phrase('Choose status ...') }}</option>
                                                <option value="1" @if (get_theme_settings('technical_status') == 1) selected @endif>{{ get_phrase('Active') }}</option>
                                                <option value="0" @if (get_theme_settings('technical_status') == 0) selected @endif>{{ get_phrase('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label ol-form-label" for="technical">{{ get_phrase('Technical Support') }}<span class="required">*</span></label>
                                        <input type="text" name="technical" id="technical" class="form-control ol-form-control" value="{{ get_theme_settings('technical') }}" required>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label class="form-label ol-form-label" for="telegram_username">{{ get_phrase('Telegram Username') }}<span class="required">*</span></label>
                                <input type="text" name="telegram_username" id="telegram_username" class="form-control ol-form-control" value="{{ get_theme_settings('telegram_username') }}" required>
                            </div> --}}
                        </div>

                        <!-- قسم التذييل -->
                        <div class="settings-section">
                            <h4 class="section-title">{{ get_phrase('Footer Settings') }}</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="toggle-group">
                                            <label class="form-label ol-form-label toggle-label" for="copyright_status">{{ get_phrase('Copyright Status') }}</label>
                                            <select class="form-control ol-form-control ol-select2" name="copyright_status" id="copyright_status" required>
                                                <option value="1" @if (get_theme_settings('copyright_status') != 0) selected @endif>{{ get_phrase('Active') }}</option>
                                                <option value="0" @if (get_theme_settings('copyright_status') == 0) selected @endif>{{ get_phrase('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label ol-form-label" for="copyright_text">{{ get_phrase('Copyright Text') }}</label>
                                        <input type="text" name="copyright_text" id="copyright_text" class="form-control ol-form-control" value="{{ get_theme_settings('copyright_text') ?: 'Arkan' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label ol-form-label" for="copyright_prefix">{{ get_phrase('Copyright Prefix') }}</label>
                                <input type="text" name="copyright_prefix" id="copyright_prefix" class="form-control ol-form-control" value="{{ get_theme_settings('copyright_prefix') ?: 'جميع الحقوق محفوظة لـ' }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label ol-form-label" for="copyright_url">{{ get_phrase('Copyright Link') }}</label>
                                <input type="url" name="copyright_url" id="copyright_url" class="form-control ol-form-control" value="{{ get_theme_settings('copyright_url') ?: 'https://wa.me/+201044445330' }}">
                            </div>

                            <div class="form-group">
                                <label for="footer_description" class="form-label ol-form-label">{{ get_phrase('Footer Description') }}<span class="required">*</span></label>
                                <textarea name="footer_description" rows="4" class="form-control ol-form-control text_editor" id="footer_description" placeholder="{{ get_phrase('Enter your footer description') }}" aria-label="{{ get_phrase('Enter your footer description') }}" required>{{ get_theme_settings('footer_description') }}</textarea>
                            </div>
                        </div>


                             <!-- قسم سياسه الخصوصيه -->
                        <div class="settings-section">
                            <h4 class="section-title">{{ get_phrase('Terms & conditions Settings') }}</h4>

                            <div class="form-group">
                                <label for="terms_condition" class="form-label ol-form-label">{{ get_phrase('terms & condition') }}<span class="required">*</span></label>
                                <textarea name="terms_condition" rows="4" class="form-control ol-form-control text_editor" id="terms_condition" placeholder="{{ get_phrase('Enter your terms & condition') }}" aria-label="{{ get_phrase('Enter your terms & condition') }}">{{ get_theme_settings('terms_condition') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save Settings') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
    "use strict";
    $(document).ready(function() {
        // تهيئة محرر النصوص
        if($('.text_editor').length > 0) {
            $('.text_editor').each(function() {
                // يمكنك إضافة محرر النصوص هنا حسب المكتبة التي تستخدمها
                // مثلاً: tinymce.init({ selector: '.text_editor' });
            });
        }

        // معاينة الصور قبل الرفع
        $('input[type="file"]').on('change', function(e) {
            const input = this;
            const container = $(this).siblings('.image-preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // إزالة المعاينات السابقة إن وجدت
                    container.find('.image-preview').remove();

                    // إضافة المعاينة الجديدة
                    container.append(`
                        <div class="image-preview">
                            <img src="${e.target.result}" alt="Preview">
                            <div class="current-image-text">{{ get_phrase('New Image Preview') }}</div>
                        </div>
                    `);
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endpush
