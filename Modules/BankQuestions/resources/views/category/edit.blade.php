@php
        $BankQuestionsCategory = \Modules\BankQuestions\App\Models\BankQuestionsCategory::where('id',$id)->first();
@endphp
<form action="{{ route('admin.category.bank.questions.update', $BankQuestionsCategory->id) }}" method="post">
    @csrf
    <div class="fpb7 mb-2">
        <label for="category_id" class="form-label ol-form-label col-sm-2 col-form-label">{{ get_phrase('Category') }}<span class="text-danger ms-1">*</span></label>
        <select class="form-control ol-form-control ol-select2" name="category_id" id="category_id" required>
            <option value="">{{ get_phrase('Select a category') }}</option>
            @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'desc')->get() as $category)
                <option @selected($BankQuestionsCategory->category_id == $category->id) value="{{ $category->id }}"> {{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="fpb7 mb-2">
        <label class="form-label ol-form-label" for="title">{{ get_phrase('Title') }}</label>
        <input class="form-control ol-form-control" type="text" id="title" name="title" value="{{ $BankQuestionsCategory->title }}" required>
    </div>

    <div class="fpb7 mb-2 mt-2 text-center">
        <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Update') }}</button>
    </div>
</form>
