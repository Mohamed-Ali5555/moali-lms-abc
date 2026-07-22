@php

    $quiz           = \Modules\BankQuestions\App\Models\BankQuizs::where('id',$id)->first();
    $duration = $quiz->duration ? explode(':', $quiz->duration) : [];
@endphp

<form action="{{ route('admin.bank.quizs.update', $quiz->id) }}" method="post">@csrf
    <div class="fpb7 mb-3">
        <label class="form-label ol-form-label" for="title">
            {{ get_phrase('Title') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <input class="form-control ol-form-control" type="text" id="title" name="title" value="{{ $quiz->title }}"
            required>
    </div>




    <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ol-form-label">
                {{ get_phrase('Section') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="category" data-placeholder="Type to search...">
                <option value="" disabled>{{ get_phrase('All') }}</option>

                @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'desc')->get() as $category)
                    <option class="text-center" disabled>
                        {{ $category->title }}</option>

                    @foreach ($category->bank_category as $sub_category)
                        <option value="{{ $sub_category->id }}"    @selected($quiz->category_id == $sub_category->id)>
                            {{"-- ".$category->title}} | {{ $sub_category->title }} </option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label ol-form-label" for="duration">
            {{ get_phrase('Duration') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <div class="row">
            <div class="col-4">
                <input class="form-control ol-form-control" type="number" min="0" max="23" name="hour"
                    placeholder="00 hour" value="{{ $duration[0] }}">
            </div>
            <div class="col-4">
                <input class="form-control ol-form-control" type="number" min="0" max="59" name="minute"
                    placeholder="00 minute" value="{{ $duration[1] }}">
            </div>
            <div class="col-4">
                <input class="form-control ol-form-control" type="number" min="0" max="59" name="second"
                    placeholder="00 second" value="{{ $duration[2] }}">
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="total_mark">
                {{ get_phrase('Total Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" id="total_mark" name="total_mark"
                value="{{ $quiz->total_mark }}" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="pass_mark">
                {{ get_phrase('Pass Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" id="pass_mark" name="pass_mark"
                value="{{ $quiz->pass_mark }}" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="retake">
                {{ get_phrase('Retake') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" id="retake" name="retake"
                value="{{ $quiz->retake }}" required>
        </div>
    </div>

    <div class="fpb-7 mb-3">
        <label for="description"
            class="form-label ol-form-label col-form-label">{{ get_phrase('Description') }}</label>
        <textarea name="description" rows="5" class="form-control ol-form-control text_editor">{!! $quiz->description !!}</textarea>
    </div>

    <div class="fpb7">
        <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Update Quiz') }}</button>
    </div>
</form>

@include('admin.init')
