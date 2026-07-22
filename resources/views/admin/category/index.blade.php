@extends('layouts.admin')

@push('title', get_phrase('Categories'))

@push('meta')
@endpush

@push('css')
@endpush



@section('content')
    <div class="ol-card radius-8px">
        <div class="ol-card-body my-3 py-12px px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('All Category') }} <span class="text-muted">({{ $categories->count() }})</span>
                </h4>
                @if (has_permission('admin.category.create'))
                    <a onclick="ajaxModal('{{ route('modal', ['admin.category.create', 'parent_id' => 0]) }}', '{{ get_phrase('Add new category') }}')"
                        href="#" class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                        <span class="fi-rr-plus"></span>
                        <span>{{ get_phrase('Add new category') }}</span>
                    </a>
                @endif

            </div>
        </div>
    </div>

    @if (count($categories) > 0)
        <div class="row g-4 all-category-list">
            @foreach ($categories as $category)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="ol-card category-card radious-10px h-100">
                        <img src="{{ get_image($category->thumbnail) }}" class="card-img-top" alt="...">
                        <h6 class="title fs-14px mb-12px px-3 pt-3 d-flex align-baseline">
                            <span style="font-size:22px;margin-right:20px;">
                                @if ($category->status == 1)
                                    <i class="fi-rr-eye" style="color: rgb(54, 150, 10); font-size:22px;"></i>
                                @else
                                    <i class="fas fa-eye-slash" style="color: #3f3d3d; font-size:22px;"></i>
                                @endif
                            </span>
                            <span style="font-size:18px;">{{ $category->title }} </span><span
                                class="text-muted d-inline-block ms-auto">({{ $category->childs->count() }})</span>
                        </h6>
                        <div class="ol-card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($category->childs as $child_category)
                                    <li class="list-group-item text-muted">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span style="font-size:22px;margin-right:20px;">
                                                    @if ($child_category->status == 1)
                                                        <i class="fi-rr-eye"
                                                            style="color: rgb(54, 150, 10); font-size:22px;"></i>
                                                    @else
                                                        <i class="fas fa-eye-slash"
                                                            style="color: #3f3d3d; font-size:22px;"></i>
                                                    @endif
                                                </span> <span font-size:18px;>{{ $child_category->title }}</span>
                                            </div>
                                            <div class="col-auto ms-auto d-flex subcategory-actions">
                                                @if (has_permission('admin.sub_categories.edit'))
                                                    <a onclick="ajaxModal('{{ route('modal', ['admin.category.edit', 'id' => $child_category->id]) }}', '{{ get_phrase('Edit category') }}')"
                                                        class="mx-1" data-bs-toggle="tooltip"
                                                        title="{{ get_phrase('Edit') }}" href="#"><i
                                                            style="color: rgb(54, 150, 10); font-size:16px;"
                                                            class="fi fi-rr-pen-clip"></i></a>
                                                @endif

                                                @if (has_permission('admin.sub_categories.delete'))
                                                    <a onclick="confirmModal('{{ route('admin.category.delete', $child_category->id) }}')"
                                                        class="mx-1" data-bs-toggle="tooltip"
                                                        title="{{ get_phrase('Delete') }}" href="#"><i
                                                            style="color: rgb(248, 76, 76); font-size:16px;"
                                                            class="fi fi-rr-trash"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="category-footer ol-card-body text-center py-1">
                            @if (has_permission('admin.sub_categories.create'))
                                <a onclick="ajaxModal('{{ route('modal', ['admin.category.create', 'parent_id' => $category->id]) }}', '{{ get_phrase('Add new category') }}')"
                                    href="#" class="btn fw-600" style="color: #2a72f7; font-size:22px;"><i
                                        class="fi fi-rr-plus"></i></i></a>
                            @endif
                            @if (has_permission('admin.category.edit'))
                                <a href="#"
                                    onclick="ajaxModal('{{ route('modal', ['admin.category.edit', 'id' => $category->id]) }}', '{{ get_phrase('Edit category') }}')"
                                    class="btn fw-600" style="color: rgb(54, 150, 10); font-size:22px;"><i
                                        class="fi fi-rr-pen-clip"></i></a>
                            @endif
                            @if (has_permission('admin.category.delete'))
                                <a href="#"
                                    onclick="confirmModal('{{ route('admin.category.delete', $category->id) }}')"
                                    class="btn text-12px fw-600"><i class="fi-rr-trash"
                                        style="color: rgb(248, 76, 76); font-size:22px;"></i></a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @include('admin.no_data')
    @endif
@endsection
