<style>
    .select2-selection.select2-selection--multiple {
        cursor: pointer !important;
    }
</style>
<form class="ajaxForm" action="{{ route('admin.bank.question.store') }}" method="post">@csrf
    <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ol-form-label">
                {{ get_phrase('Category') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ol-form-control ol-select2" data-toggle="select2" id="category" name="category_id"
                data-placeholder="Type to search...">
                <option value="">{{ get_phrase('Choose Category') }}</option>

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


    <div class="row mb-3">
        <div class="col-sm-12 fpb-7">
            <label class="form-label ol-form-label">
                {{ get_phrase('quiz') }}
                <span class="text-danger ms-1">*</span>
            </label>
            <select class="form-control ol-form-control ol-select2" multiple data-toggle="select2" id="quiz_id"
                name="quiz_id[]" data-placeholder="Type to search...">
                <option disabled>{{ get_phrase('cheose') }}</option>

            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label ol-form-label">
                    {{ get_phrase('Question Type') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="type"
                    onchange="getOptionType(this)">
                    <option value="">{{ get_phrase('Select an option') }}</option>
                    <option value="mcq">{{ get_phrase('Multiple Choice') }}</option>
                    <option value="fill_blanks">{{ get_phrase('Fill in the blanks') }}</option>
                    <option value="true_false">{{ get_phrase('True or False') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="fpb-7 mb-3">
        <label for="title" class="form-label ol-form-label">
            {{ get_phrase('Write question') }}
            <span class="text-danger ms-1">*</span>
        </label>
        <textarea name="title" rows="5" class="form-control ol-form-control text_editor"></textarea>
    </div>

    <div class="load-question-type"></div>


    <div class="d-flex gap-3">
        <div class="fpb7">
            <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Add Question') }}</button>
        </div>
    </div>
</form>


@include('admin.init')
<script>
    // $(document).ready(function() {
    //     $('#category').on('change', function() {
    //         var categoryId = $(this).val();
    //         if (categoryId) {
    //             $.ajax({
    //                 url: '{{ route('admin.bank.quizs.using.category', ':id') }}'.replace(':id', categoryId),
    //                 type: 'GET',
    //                 success: function(response) {
    //                     $('#quiz_id').empty();
    //                     $.each(response, function(key, value) {
    //                         $('#quiz_id').append('<option value="' + value.id + '">' + value.title + '</option>');
    //                     });
    //                 }
    //             });
    //         } else {
    //             $('#quiz_id').empty().append('<option disabled value="">اختر عنصر</option>');
    //         }
    //     });
    // });
    $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            $('#quiz_id').empty();
            $('#quiz_id').append(
                '<option id="NotQuiz" value="0">{{ get_phrase('لا يوجد كويزات') }}</option>');

            if (categoryId) {
                $.ajax({
                    url: '{{ route('admin.bank.quizs.using.category', ':id') }}'.replace(':id',
                        categoryId),
                    type: 'GET',
                    success: function(response) {
                        $.each(response, function(key, value) {
                            $('#quiz_id').append(
                                '<option class="onlyQuiz" value="' + value.id +
                                '">' + value.title + '</option>');
                        });
                    }
                });
            }
        });


        $('#quiz_id').on('change', function() {
            var selected = $(this).val() || [];
            if (selected.includes("0")) {
                $('.onlyQuiz').prop('disabled', true).prop('selected', false);
            } else {
                $('#NotQuiz').prop('disabled', true).prop('selected', false);
                $('.onlyQuiz').prop('disabled', false);
            }

            if (selected.length === 0) {
                $('#NotQuiz').prop('disabled', false);
                $('.onlyQuiz').prop('disabled', false);
            }

            $('#quiz_id').trigger('change.select2');
        });
    });


    function getOptionType(elem) {
        let type = elem.value;
        setupQuestion(type)
    }

    function setupQuestion(type) {
        if (type) {
            $.ajax({
                type: "get",
                url: "{{ route('admin.bank.question.type') }}",
                data: {
                    type: type
                },
                success: function(response) {
                    $('.load-question-type').empty().append(response)
                }
            });
        }
    }

    // after response this function will call
    function responseBack() {
        location.reload();
    }
</script>
