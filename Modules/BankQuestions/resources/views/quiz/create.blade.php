<form action="{{ route('admin.bank.quizs.store') }}" method="post">@csrf

    <div class="fpb7 mb-3">
        <label class="form-label ol-form-label" for="title">
            {{ get_phrase('Title') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <input class="form-control ol-form-control" type="text" id="title" name="title" required>
    </div>



    <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ol-form-label">
                {{ get_phrase('Category') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="category"
                data-placeholder="Type to search...">
                <option value="" disabled>{{ get_phrase('Select Category') }}</option>

                @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'desc')->get() as $category)
                    <option class="text-center" disabled>
                        {{ $category->title }}</option>

                    @foreach ($category->bank_category as $sub_category)
                        <option value="{{ $sub_category->id }}">
                            {{ '-- ' . $category->title }} | {{ $sub_category->title }} </option>
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
                <label class="form-label ol-form-label" for="hour">
                    {{ get_phrase('hour') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <input class="form-control ol-form-control" type="number" min="0" max="23" name="hour"
                    value="1" placeholder="00 hour">
            </div>
            <div class="col-4">
                <label class="form-label ol-form-label" for="minute">
                    {{ get_phrase('minute') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <input class="form-control ol-form-control" type="number" min="0" max="59" name="minute"
                    value="1" placeholder="00 minute">
            </div>
            <div class="col-4">

                <label class="form-label ol-form-label" for="second">
                    {{ get_phrase('second') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <input class="form-control ol-form-control" type="number" min="0" max="59" name="second"
                    value="1" placeholder="00 second">
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
                value="10" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="pass_mark">
                {{ get_phrase('Pass Mark') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" id="pass_mark" name="pass_mark"
                value="5" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label ol-form-label" for="retake">
                {{ get_phrase('Retake') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <input class="form-control ol-form-control" type="number" min="1" id="retake" name="retake"
                value="3" value="1" required>
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
