@php
    $book = Modules\BookStore\App\Models\Book::where('id', $id)->first();
    $parent_categories = App\Models\Category::where('parent_id', 0)->orderBy('title', 'asc')->get();
@endphp
<form action="{{ route('admin.bookstore.update', $book->id) }}" method="post" enctype="multipart/form-data">
    @CSRF
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="category_id" class="form-label ol-form-label">{{ get_phrase('Category') }}<span class="text-danger ms-1">*</span></label>
                <select class="form-control ol-select2" name="category_id" id="category_id" required>
                    <option value="">{{ get_phrase('Select a category') }}</option>
                    @foreach ($parent_categories as $parent_category)
                        <option value="{{ $parent_category->id }}" @if ($book->category_id == $parent_category->id) selected @endif>
                            {{ $parent_category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book_name" class="form-label ol-form-label">{{ get_phrase('Book Name') }}<span
                        class="text-danger ms-1">*</span></label>
                <input type="text" name="title" class="form-control ol-form-control" value="{{ $book->title }}"
                    id="book_name" placeholder="{{ get_phrase('Enter your book name') }}"
                    aria-label="{{ get_phrase('Enter your unique category name') }}" required />
            </div>

            <div class="mb-3">
                <label for="price" class="form-label ol-form-label">{{ get_phrase('price') }}<span
                        class="text-danger ms-1">*</span></label>
                <input type="number" min="0" name="price" class="form-control ol-form-control"
                    oninput="this.value = Math.abs(this.value)" id="price"
                    placeholder="{{ get_phrase('Enter your book price') }}"
                    aria-label="{{ get_phrase('Enter your unique category name') }}" value="{{ $book->price }}"
                    required />
            </div>

            <div class="mb-3">
                <label for="if_discount" class="form-label ol-form-label">
                    {{ get_phrase('if_discount') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <input type="checkbox" name="if_discount" id="if_discount" class="form-check-input" value="1"
                    {{ $book->if_discount ? 'checked' : '' }} />
            </div>

            <div class="mb-3" id="discount_price" style="display: none;">
                <label for="discount_priceInput" class="form-label ol-form-label">
                    {{ get_phrase('discount_price') }}
                    <span class="text-danger ms-1">*</span>
                </label>
                <input type="number" min="0" name="discount_price" id="discount_priceInput"
                    class="form-control ol-form-control" oninput="this.value = Math.abs(this.value)"
                    placeholder="{{ get_phrase('Enter your book discount_price') }}"
                    value="{{ $book->discount_price }}" />
            </div>

            <div class="mb-3">
                <label for="description" class="form-label ol-form-label">{{ get_phrase('Book Description') }} <small
                        class="text-muted">({{ get_phrase('optional') }})</small><small
                        class="text-muted">({{ get_phrase('optional') }})</small></label>
                <textarea name="description" rows="4" class="form-control ol-form-control text_editor" id="description"
                    placeholder="{{ get_phrase('Enter your description') }}" aria-label="{{ get_phrase('Enter your description') }}">{{ $book->disc }}</textarea>
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label ol-form-label">{{ get_phrase('Thumbnail') }} <small
                        class="text-muted">({{ get_phrase('optional') }})</small></label>
                <input type="file" name="thumbnail" class="form-control ol-form-control" id="thumbnail"
                    accept="image/*" />
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
    $('.ol-select2').select2({
        dropdownParent: $("#ajaxModal")
    });
</script>
<script>
    $(document).ready(function() {

        if ($('#if_discount').is(':checked')) {
            $('#discount_price').show();
        } else {
            $('#discount_price').hide();
        }

        $('#if_discount').change(function() {
            if ($(this).is(':checked')) {
                $('#discount_price').slideDown();
            } else {
                $('#discount_price').slideUp();
                $('#discount_priceInput').val('');
            }
        });
    });
</script>

@include('admin.init')
