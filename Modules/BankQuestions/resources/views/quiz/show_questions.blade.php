@extends('layouts.admin')
@push('title', get_phrase('Course Manager'))
@section('content')
    <div class="ol-card radius-8px">
        <div class="ol-card-body my-3 py-12px px-20px">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <h4 class="title fs-16px">
                    <i class="fi-rr-settings-sliders me-2"></i>
                    {{ get_phrase('questions  List') }}
                </h4>


            </div>
        </div>
    </div>


    <!-- Start Admin area -->
    <div class="row">
        <div class="col-12">
            <div class="ol-card">
                <div class="ol-card-body p-3 mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($questions->count() > 0)
                                <div id="div_printed">
                                    <div>
                                        <h3 class="text-center fw-bold mb-3">{{$quiz->title}}</h3>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div>Name: </div>
                                        <div>{{auth()->user()->name}}</div>
                                        <div>Degree: <span  class="badge text-bg-light fs-6">__</span> / <span class="badge text-bg-light fs-6">{{$quiz->total_mark}}</span> </div>
                                    </div>
                                    @foreach ($questions as $key => $question)
                                        <div class="px-4 mb-3 pb-3 border-bottom">
                                            <div class="mb-3 d-flex gap-2">
                                                <span class="serial">{{ ++$key }} - </span>
                                                <div class="question-title">{!! $question->title !!}</div>
                                            </div>

                                            <div class="row gap-0">
                                                @if ($question->type == 'mcq')
                                                    @php $options = json_decode($question->options, true) ?? []; @endphp
                                                    @foreach ($options as $index => $option)
                                                        <div class="col">
                                                            <input class="form-check-input" type="checkbox" name="{{ $question->id }}[]"
                                                                value="{{ $option }}" id="{{ $option }}-{{ $question->id }}">
                                                            <label class="form-check-label text-capitalize"
                                                                for="{{ $option }}-{{ $question->id }}">{{ $option }}</label>
                                                        </div>
                                                    @endforeach
                                                @elseif($question->type == 'fill_blanks')
                                                    {{-- <input type="text" class="form-control tagify" name="{{ $question->id }}" data-role="tagsinput"> --}}
                                                    <textarea class="form-control-plaintext" name="{{ $question->id }}" style="height: 100px; resize: none;"></textarea>
                                                @elseif($question->type == 'true_false')
                                                    <div class="col-sm-2">
                                                        <input class="form-check-input" type="radio" name="{{ $question->id }}" value="true"
                                                            id="question-{{ $question->id }}-true">
                                                        <label class="form-check-label"
                                                            for="question-{{ $question->id }}-true">{{ get_phrase('True') }}</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input class="form-check-input" type="radio" name="{{ $question->id }}" value="false"
                                                            id="question-{{ $question->id }}-false">
                                                        <label class="form-check-label"
                                                            for="question-{{ $question->id }}-false">{{ get_phrase('False') }}</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-primary" id="print">Print</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let printBtn=  document.getElementById("print");
        let divPrinted=  document.getElementById("div_printed");

        function printArea(element) {
            var printContents = element.innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            location.reload();

        }

        printBtn.addEventListener("click", function() {
            printArea(divPrinted)
        });
    })
</script>
