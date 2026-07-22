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
                    {{ get_phrase('All Social accounts') }} <span class="text-muted">({{ $social->count() }})</span>
                </h4>
                @if (has_permission('theme.social.create'))
                    <a href="{{ route('admin.theme.social.create') }}" class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                        <span class="fi-rr-plus"></span>
                        <span>{{ get_phrase('Add new social') }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>


    <div class="row g-4 all-category-list">
        @if (count($social) > 0)

            @foreach ($social as $row)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="ol-card category-card radious-10px h-100">
                        <img src="{{ get_image($row->thumbnail) }}" class="card-img-top" alt="...">
                        <h6 class="title fs-14px mb-12px px-3 pt-3 d-flex align-baseline">
                            <span style="font-size: 18px">{{ $row->title }}</span> <span class="text-muted d-inline-block ms-auto">  @if($row->status == 1)<i class="fi-rr-eye" style="color: rgb(54, 150, 10); font-size:22px;"></i> @else <i class="fas fa-eye-slash" style="color: #3f3d3d; font-size:22px;"></i>  @endif
                            </span>
                        </h6>

                        <p>  <span style="font-size: 18px">{{ $row->url }}</span></p>
                        <div class="category-footer ol-card-body text-center py-1">
                            
                                @if (has_permission('admin.theme.social.delete'))
                                    <a href="#" onclick="confirmModal('{{ route('admin.theme.social.delete', $row->id) }}')" class="btn text-12px fw-600"><i class="fi-rr-trash" style="color: rgb(248, 76, 76); font-size:22px;"></i></a>
                                @endif 
                                {{-- @if (has_permission('admin.bookstore.activation'))
                                    <a href="#" onclick="confirmModal('{{ route('admin.bookstore.activation', $row->id) }}')" class="btn text-12px fw-600">@if($social->status == 0)<i class="fi-rr-eye" style="color: rgb(54, 150, 10); font-size:22px;"></i> @else <i class="fas fa-eye-slash" style="color: #3f3d3d; font-size:22px;"></i>  @endif</a>
                                @endif --}}
                        </div>
                    </div>
                </div>
            @endforeach

        @else
            @include('admin.no_data')
        @endif
    </div>
@endsection
