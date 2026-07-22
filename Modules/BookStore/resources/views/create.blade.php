<form action="{{ route('admin.bookstore.store') }}" method="post" enctype="multipart/form-data">
    @CSRF
    <input type="hidden" name="parent_id" value="{{ $parent_id }}">

    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="category_id" class="form-label ol-form-label">{{ get_phrase('Category') }}<span class="text-danger ms-1">*</span></label>
                <select class="form-control ol-select2" name="category_id" id="category_id" required>
                    <option value="" disabled>{{ get_phrase('Select a category') }}</option>
                    @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'asc')->get() as $category)
                        <option value="{{ $category->id }}"> {{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book_name" class="form-label ol-form-label">{{ get_phrase('Book Name') }}<span class="text-danger ms-1">*</span></label>
                <input type="text" name="title" class="form-control ol-form-control" id="book_name" placeholder="{{ get_phrase('Enter your book name') }}"
                    aria-label="{{ get_phrase('Enter your unique category name') }}" required />
            </div>

            <div class="mb-3">
                <label for="price" class="form-label ol-form-label">{{ get_phrase('price') }}<span class="text-danger ms-1">*</span></label>
                <input type="number" min="0" name="price" class="form-control ol-form-control" oninput="this.value = Math.abs(this.value)" id="price" placeholder="{{ get_phrase('Enter your book price') }}"
                    aria-label="{{ get_phrase('Enter your unique category name') }}" required />
            </div>

            <div class="mb-3">
                <label for="if_discount" class="form-label ol-form-label">{{ get_phrase('if discount') }}<span class="text-danger ms-1">*</span></label>
                <input type="checkbox" name="if_discount" value="1" id="if_discount" class="form-check-input"/>
            </div>

            <div class="mb-3" id="discount_price">
                <label for="price" class="form-label ol-form-label">{{ get_phrase('Discount price') }}<span class="text-danger ms-1">*</span></label>
                <input type="number" min="0" name="discount_price" class="form-control ol-form-control" oninput="this.value = Math.abs(this.value)" placeholder="{{ get_phrase('Enter your book discountPrice') }}" />
            </div>


             <div class="fpb-7 mb-3">
                <label for="description" class="form-label ol-form-label">{{ get_phrase('Book Description') }}  <small class="text-muted">({{ get_phrase('optional') }})</small><small
                    class="text-muted">({{ get_phrase('optional') }})</small></label>

                    <textarea name="description" id="description"  value="{{old('description')}}" placeholder="{{ get_phrase('Enter Description') }}" class="form-control ol-form-control text_editor">{{old('description')}}</textarea>
             </div>


            <div class="mb-3">
                <label for="thumbnail" class="form-label ol-form-label">{{ get_phrase('Thumbnail') }} <small class="text-muted">({{ get_phrase('optional') }})</small></label>
                <input type="file" name="thumbnail" class="form-control ol-form-control" id="thumbnail" accept="image/*" />
            </div>
            <div class="mb-2">
                <button class="btn ol-btn-primary">{{ get_phrase('Submit') }}</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    "use strict";

    $(function() {
        if ($('.icon-picker').length) {
            $('.icon-picker').iconpicker();
        }
    });

</script>
<script>
    $(document).ready(function () {
        if ($('#if_discount').is(':checked')) {
            $('#discount_price').show();
        } else {
            $('#discount_price').hide();
        }

        $('#if_discount').change(function () {
            if ($(this).is(':checked')) {
                $('#discount_price').slideDown();
            } else {
                $('#discount_price').slideUp();
            }
        });
    });
</script>
@include('admin.init')
