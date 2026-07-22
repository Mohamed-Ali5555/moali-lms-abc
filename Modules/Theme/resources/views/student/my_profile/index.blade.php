@extends('theme::layouts.master')

{{-- @extends('layouts.default') --}}

@push('title', get_phrase('My profile'))
@push('meta')@endpush
@push('css')@endpush
@section('content')
    <!------------ My profile area start  ------------>
    <section class="course-content main_content" dir="rtl">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')
                <div class="col-lg-9">
                    <h4 class="g-title mb-5">حسابى</h4>
                    <div class="my-panel message-panel edit_profile">
                        <form action="{{ route('theme.update.profile', $user_details->id) }}" method="post" enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="name" class="form-label">{{ get_phrase('الإسم :') }}</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user_details->name }}" id="name">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label">{{ get_phrase('البريد الإلكترونى : ') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user_details->email }}" id="email">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">{{ get_phrase('رقم الهاتف : ') }}</label>
                                        <input type="number" class="form-control" name="phone" value="{{ $user_details->phone }}" id="phone">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">{{ get_phrase('رقم هاتف ولى الأمر : ') }}</label>
                                        <input type="number" class="form-control" name="parent_phone" value="{{ old('parent_phone',$user_details->parent_phone) }}" id="parent_phone">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="national_id" class="form-label">{{ get_phrase('الرقم القومى : ') }}</label>
                                        <input type="number" min="1" class="form-control" name="national_id" value="{{ old('national_id',$user_details->national_id) }}" id="national_id">
                                    </div>
                                </div> --}}


                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">{{ get_phrase('النوع') }}</label>
                                            <select class="form-control" name="gender">
                                                <option disabled>اختر النوع</option>
                                                <option value="1" @selected($user_details->gender == 1)>ذكر</option>
                                                <option value="2" @selected($user_details->gender == 2)>أنثى</option>
                                            </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="goverment" class="form-label">{{ get_phrase('المحافظة : ') }}</label>
                                        <select class="ol-select2 form-control ol-select2-multiple" id="goverment" name="goverment" required>
                                            <option option value=""disabled>اختر المحافظة</option>
                                            @php
                                                $governorates = [
                                                    'القاهرة', 'الجيزة', 'الإسكندرية', 'الشرقية', 'الدقهلية', 'القليوبية', 'الغربية', 'المنوفية',
                                                    'البحيرة', 'كفر الشيخ', 'دمياط', 'بورسعيد', 'الإسماعيلية', 'السويس', 'مطروح', 'الفيوم',
                                                    'بني سويف', 'المنيا', 'أسيوط', 'سوهاج', 'قنا', 'الأقصر', 'أسوان', 'البحر الأحمر',
                                                    'الوادي الجديد', 'شمال سيناء', 'جنوب سيناء'
                                                ];
                                            @endphp

                                            @foreach($governorates as $gov)
                                                <option value="{{ $gov }}" {{ isset($user_details) && $user_details->goverment == $gov ? 'selected' : '' }}>
                                                    {{ $gov }}
                                                </option>
                                            @endforeach
                                    </select>

                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="category" class="form-label">{{ get_phrase('الصف الدراسى : ') }}</label>
                                        <select class="ol-select2 form-control ol-select2-multiple" id="category" name="category" required>
                                            <option value="" disabled>please select category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $user_details->category ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                                    @endforeach
                                        </select>

                                        @error('category')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>




                                {{-- <div class="col-12 my-3">
                                    <div class="national_container">
                                        <label class="form-label" for="national_image">
                                            <span> رفع </span>
                                            <p> ارفع شهادة ميلادك / بطاقتك </p>
                                        </label>
                                        <input type="file"  id="national_image" name="national_image" class="form-control">

                                    </div>
                                </div> --}}


                                <div class="col-12 my-3">
                                    <div class="national_container">
                                        <label class="form-label" for="photo">
                                            <p> ارفع صورتك </p>
                                        </label>
                                        <input type="file"  id="photo" name="photo" class="form-control">

                                    </div>
                                </div>
                               <div class="col-lg-12 mb-20">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{ get_phrase('address') }}</label>
                                        <input type="text" class="form-control" name="address" value="{{ $user_details->address }}" id="address">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="password" class="form-label">{{ get_phrase('كلمة السر القديمة : ') }}</label>
                                        <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" id="old_password">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="new_password" class="form-label">{{ get_phrase('كلمة السر الحديثه : ') }}</label>
                                        <input type="password" class="form-control" name="new_password"  value="{{ old('new_password') }}"  id="new_password">
                                    </div>
                                </div>
                            </div>
                            <button class="eBtn btn gradient mt-2">{{ get_phrase('حفظ التغيرات') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------ My profile area end  ------------>
@endsection
@push('js')

@endpush
