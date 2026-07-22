@extends('layouts.admin')

@push('title', get_phrase('features'))

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
                    {{ get_phrase('All feature') }} <span class="text-muted">({{ $features->count() }})</span>
                </h4>
                @if (has_permission('theme.feature.create'))
                    <a href="{{ route('admin.theme.feature.create') }}"
                        class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                        <span class="fi-rr-plus"></span>
                        <span>{{ get_phrase('Add new feature') }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            @if ($features->count() > 0)
                <div
                    class="admin-tInfo-pagi d-flex justify-content-between justify-content-center align-items-center flex-wrap gr-15">

                </div>
                <div class="table-responsive overflow-auto course_list overflow-auto" id="course_list">
                    <table class="table eTable eTable-2 print-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ get_phrase('Title') }}</th>
                                <th scope="col" class="print-d-none">{{ get_phrase('Status') }}</th>
                                <th scope="col" class="print-d-none">{{ get_phrase('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($features as $key => $row)
                                <tr>
                                    <th scope="row">
                                        <p class="row-number">{{ ++$key }}</p>
                                    </th>

                                    <td>
                                        <div class="sub-title2 text-12px">
                                            <span>{{ $row->title ?? '' }}</span>
                                        </div>
                                    </td>





                                    <td>
                                        <span
                                            class="badge @if ($row->status == '1') bg-success   @else bg-danger @endif">
                                            @if ($row->status == '1')
                                                مفعلة
                                            @else
                                                غير مفعل
                                            @endif
                                        </span>
                                    </td>

                                    <td class="print-d-none">

                                        <div class="dropdown ol-icon-dropdown ol-icon-dropdown-transparent">
                                            <button class="btn ol-btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="fi-rr-menu-dots-vertical"></span>
                                            </button>

                                            <ul class="dropdown-menu">


                                                @if (has_permission('admin.theme.feature.status'))
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmModal('{{ route('admin.theme.feature.activeFeature', $row->id) }}')"
                                                            class="btn text-12px fw-600">
                                                         {{ get_phrase('change status') }}</a>
                                                        </a>

                                                    </li>
                                                @endif
                                                @if (has_permission('admin.theme.feature.delete'))
                                                    <li>
                                                        <a class="dropdown-item"
                                                            onclick="confirmModal('{{ route('admin.theme.feature.delete', $row->id) }}')"
                                                            href="javascript:void(0)">{{ get_phrase('Delete featrue') }}</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @include('admin.no_data')
            @endif
        </div>
    </div>
@endsection
