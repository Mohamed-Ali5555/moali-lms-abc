@extends('theme::layouts.master')

@section('content')
@include('theme::includes.banner')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>{!! get_theme_settings('terms_condition') !!}</p>

        </div>
    </div>
</div>

@endsection
