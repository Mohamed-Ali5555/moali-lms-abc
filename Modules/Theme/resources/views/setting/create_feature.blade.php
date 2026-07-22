@extends('layouts.admin')
@push('title', get_phrase('Notification settings'))
@push('meta')@endpush
@push('css')@endpush
@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="ol-card p-4">
                <h3 class="title text-14px mb-3">{{ get_phrase('create social') }}</h3>
                <div class="ol-card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <form class="required-form" action="{{ route('admin.theme.feature.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                            <div class="fpb-7 mb-3">
                                <label class="form-label ol-form-label" for="title">{{ get_phrase(' title') }}<span class="required">*</span></label>
                                <input type="text" name = "title" id = "title" class="form-control ol-form-control" value="{{ old('title') }}" required>
                            </div>


                            {{--  status --}}
                            <div class="fpb-7 mb-3">
                                <label class="form-label ol-form-label" for="status">{{ get_phrase('status') }}</label>
                                    <select for='status' class="form-control ol-form-control ol-select2"
                                        name="status" id="status" required>
                                        <option value="" disabled>{{ get_phrase('Choose status ...') }}</option>
                                        <option value="1" @if (old('status') == 1) selected @endif>
                                            {{ get_phrase('Active') }}</option>
                                        <option value="0" @if (old('status') == 0) selected @endif>
                                            {{ get_phrase('Inactive') }}</option>
                                    </select>
                            </div>



                                <button type="submit" class="btn ol-btn-primary"
                                    >{{ get_phrase('Save') }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div> <!-- end card-body-->
        </div>
    </div>
@endsection

