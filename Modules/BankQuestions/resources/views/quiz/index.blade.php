@extends('layouts.admin')
@push('title', get_phrase('Course Manager'))
@section('content')
    <div class="ol-card radius-8px">
        <div class="ol-card-body my-3 py-12px px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('Exams List') }}
                </h4>

                <a onclick="ajaxModal('{{ route('modal', ['bankquestions::quiz.create']) }}', '{{ get_phrase('Add New Quiz') }}')" href="#"
                    class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                    <span class="fi-rr-plus"></span>
                    <span>{{ get_phrase('Add New Quiz') }}</span>
                </a>
            </div>
        </div>
    </div>


    <!-- Start Admin area -->
    <div class="row">
        <div class="col-12">
            <div class="ol-card">
                <div class="ol-card-body p-3 mb-5">
                    <div class="row mt-3 mb-4">
                        <div class="col-md-6 d-flex align-items-center gap-3">
                            <div class="custom-dropdown ms-2">
                                <button class="dropdown-header btn ol-btn-light">
                                    {{ get_phrase('Export') }}
                                    <i class="fi-rr-file-export ms-2"></i>
                                </button>
                                <ul class="dropdown-list">
                                    <li>
                                        <a class="dropdown-item export-btn" href="#" onclick="downloadPDF('.print-table', 'course-list')"><i class="fi-rr-file-pdf"></i> {{ get_phrase('PDF') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item export-btn" href="#" onclick="window.print();"><i class="fi-rr-print"></i> {{ get_phrase('Print') }}</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="custom-dropdown dropdown-filter @if (!isset($_GET) || (isset($_GET) && count($_GET) == 0))  @endif">
                                <button class="dropdown-header btn ol-btn-light">
                                    <i class="fi-rr-filter me-2"></i>
                                    {{ get_phrase('Filter') }}

                                    @if (isset($_GET) && count($_GET))
                                        <span class="text-12px">
                                            ({{count($_GET)}})
                                        </span>
                                    @endif
                                </button>
                                <ul class="dropdown-list w-250px">
                                    <li>
                                        <form id="filter-dropdown" action="{{ route('admin.bank.quizs.index') }}" method="get">
                                            <div class="filter-option d-flex flex-column gap-3">
                                                <div>
                                                    <label for="eDataList" class="form-label ol-form-label">{{ get_phrase('Category') }}</label>
                                                    <select class="form-control ol-form-control ol-select2" data-toggle="select2" name="category" data-placeholder="Type to search...">
                                                        <option value="all">{{ get_phrase('All') }}</option>

                                                        @foreach (App\Models\Category::where('parent_id', 0)->orderBy('title', 'desc')->get() as $category)
                                                            <option value="main_{{ $category->id }}"@if (isset($parent_cat) && $parent_cat == $category->id) selected @endif>
                                                                {{ $category->title }}</option>

                                                            @foreach ($category->bank_category as $sub_category)
                                                                <option value="sub_{{ $sub_category->id }}"@if (isset($child_cat) && $child_cat == $sub_category->id) selected @endif>
                                                                    --{{ $sub_category->title }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <div class="filter-button d-flex justify-content-end align-items-center mt-3">
                                                <button type="submit" class="ol-btn-primary">{{ get_phrase('Apply') }}</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            @if (isset($_GET) && count($_GET) > 0)
                                <a href="{{ route('admin.bank.quizs.index') }}" class="me-2" data-bs-toggle="tooltip" title="{{ get_phrase('Clear') }}"><i class="fi-rr-cross-circle"></i></a>
                            @endif
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <form action="{{ route('admin.bank.quizs.index') }}" method="get">
                                <div class="row row-gap-3">
                                    <div class="col-md-9">
                                        <div class="search-input flex-grow-1">
                                            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ get_phrase('Search Title') }}" class="ol-form-control form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn ol-btn-primary w-100" id="submit-button">{{ get_phrase('Search') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @if ($quizs->count() > 0)
                                <div class="admin-tInfo-pagi d-flex justify-content-between justify-content-center align-items-center flex-wrap gr-15">
                                    <p class="admin-tInfo">
                                        {{ get_phrase('Showing') . ' ' . count($quizs) . ' ' . get_phrase('of') . ' ' . $quizs->total() . ' ' . get_phrase('data') }}
                                    </p>
                                </div>
                                <div class="table-responsive overflow-auto course_list overflow-auto" id="course_list">
                                    <table class="table eTable eTable-2 print-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ get_phrase('Title') }}</th>
                                                <th scope="col">{{ get_phrase('Duration') }}</th>
                                                <th scope="col">{{ get_phrase('Total Mark') }}</th>
                                                <th scope="col">{{ get_phrase('retake') }}</th>
                                                <th scope="col" class="print-d-none">{{ get_phrase('Questions') }}</th>
                                                <th scope="col" class="print-d-none">{{ get_phrase('show') }}</th>
                                                <th scope="col" class="print-d-none">{{ get_phrase('Options') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quizs as $key => $row)
                                                <tr>
                                                    <th scope="row">
                                                        <p class="row-number">{{ ++$key }}</p>
                                                    </th>
                                                    <td>
                                                        <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                                            <div class="dAdmin_profile_name">
                                                                <h4 class="title fs-14px">
                                                                    {{ ucfirst($row->title) }}
                                                                </h4>
                                                                <p class="sub-title2 text-12px">
                                                                    {{ get_phrase('Category') }}:
                                                                    {{ $row->category->category->title ?? get_phrase('not found!') }}
                                                                </p>
                                                                <p class="sub-title2 text-12px">
                                                                    {{ get_phrase('Sub Category') }}:
                                                                    {{ $row->category->title ?? get_phrase('not found!') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="sub-title2 text-12px">
                                                            <p class="sub-title2 text-12px">{{$row->duration}}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sub-title2 text-12px">
                                                            <h4 class="title fs-12px">
                                                                {{ get_phrase('Total Mark') }}:
                                                                {{ ucfirst($row->total_mark) }}
                                                            </h4>
                                                            <h4 class="title fs-12px">
                                                                {{ get_phrase('Pass Mark') }}:
                                                                {{ ucfirst($row->pass_mark) }}
                                                            </h4>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="sub-title2 text-12px">
                                                            <p class="sub-title2 text-12px">{{$row->retake}}</p>
                                                        </div>
                                                    </td>

                                                    <td class="print-d-none">
                                                        <a href="#" data-bs-toggle="tooltip" title="{{ get_phrase('Bank Questions') }}" onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.index', 'id' => $row->id]) }}', '{{ get_phrase('Bank Questions') }}', 'modal-lg')" class="edit-delete">
                                                            <span class="btn btn-primary">{{$row->questions->count()}}</span>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <div class="sub-title2 text-12px">
                                                            <a href="{{ route('admin.bank.quizs.show',$row->id) }}" class="sub-title2 text-12px"><i class="fi-rr-eye" style="color: rgb(54, 150, 10); font-size:22px;"></i></a>
                                                        </div>
                                                    </td>

                                                    <td>

                                                        <div class="dropdown ol-icon-dropdown">
                                                            <button class="btn ol-btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="fi-rr-menu-dots-vertical"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="ajaxModal('{{ route('modal', ['bankquestions::quiz.edit', 'id' => $row->id]) }}', '{{ get_phrase('Edit category') }}')">{{ get_phrase('Edit') }}</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmModal('{{ route('admin.bank.quizs.destroy', $row->id) }}')">{{ get_phrase('Delete') }}</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="admin-tInfo-pagi d-flex justify-content-between justify-content-center align-items-center flex-wrap gr-15">
                                    <p class="admin-tInfo">
                                        {{ get_phrase('Showing') . ' ' . count($quizs) . ' ' . get_phrase('of') . ' ' . $quizs->total() . ' ' . get_phrase('data') }}
                                    </p>
                                    {{ $quizs->links() }}
                                </div>
                            @else
                                @include('admin.no_data')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Admin area -->
@endsection
