<form action="{{ route('admin.course.quiz.store') }}" method="post">@csrf

    <input type="hidden" name="course_id" value="{{ $id }}">

    <div class="fpb7 mb-3">
        <label for="type" class="form-label ol-form-label">{{ get_phrase('type') }}</label>
        <select  class="form-control ol-form-control ol-select2" data-toggle="select2" id="type" name="type">
            <option value="1"> quiz</option>
            <option value="2"> assignment</option>
        </select>
    </div>


    <div class="fpb7 mb-3">
        <label class="form-label ol-form-label" for="title">
            {{ get_phrase('Title') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <input class="form-control ol-form-control" type="text" id="title" name="title" required>
    </div>



    {{-- <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ol-form-label">
                {{ get_phrase('level') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="level" required>
                <option value="">{{ get_phrase('Select a level') }}</option>
                @foreach (['Beginner','Intermediate','Advanced'] as $level)
                    <option @selected($level == 'Advanced') value="{{ $level }}">{{ get_phrase($level)}}</option>
                @endforeach
            </select>
        </div>
    </div> --}}

    <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ol-form-label">
                {{ get_phrase('Section') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="section">
                <option value="" disabled>{{ get_phrase('Select an option') }}</option>
                @foreach (App\Models\Section::where('course_id', $id)->get() as $section)
                    <option value="{{ $section->id }}">{{ $section->title }}</option>
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
                <label>hour</label>
                <input class="form-control ol-form-control" type="number" min="0" max="23" value="1" name="hour"
                    placeholder="00 hour">
            </div>
            <div class="col-4">
                <label>minute</label>
                <input class="form-control ol-form-control" type="number" min="0" max="59" value="1" name="minute"
                    placeholder="00 minute">
            </div>
            <div class="col-4">
                <label>second</label>
                <input class="form-control ol-form-control" type="number" min="0" max="59" value="1" name="second"
                    placeholder="00 second">
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="total_mark">
                {{ get_phrase('Total Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" value="10" id="total_mark" name="total_mark"
                required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="pass_mark">
                {{ get_phrase('Pass Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" value="5" id="pass_mark" name="pass_mark"
                required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="retake">
                {{ get_phrase('Retake') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" value="3" id="retake" name="retake"
                value="1" required>
        </div>
    </div>


    <div class="row mb-3">
        <div class="fpb7 col-sm-6 mb-3">
            <label class="form-label ol-form-label" for="title">
                {{ get_phrase('Start Time') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="datetime-local" name="start_time" value="{{now()}}">
        </div>
        <div class="fpb7 col-sm-6 mb-3">
            <label class="form-label ol-form-label" for="title">
                {{ get_phrase('End Time') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="datetime-local" name="end_time" value="{{ old('end_time') }}">
        </div>
    </div>

    <div class="fpb-7 mb-3">
        <label for="description"
            class="form-label ol-form-label col-form-label">{{ get_phrase('Description') }}</label>
        <textarea name="description" rows="5" class="form-control ol-form-control text_editor"></textarea>
    </div>

    <div class="fpb7">
        <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Add Quiz') }}</button>
    </div>
</form>

@include('admin.init')
