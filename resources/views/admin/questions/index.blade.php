@php
    $questions = App\Models\Question::where('quiz_id', $id)->orderBy('sort')->get();
@endphp

@if ($questions->count() > 0)
    <div class="row mb-3">
        <div class="col-12 d-flex gap-2 flex-wrap">
            <a href="#"
                onclick="ajaxModal('{{ route('modal', ['admin.questions.create', 'id' => $id]) }}', '{{ get_phrase('Add Question') }}', 'modal-lg')"
                class="btn btn-sm btn-outline-primary">
                <i class="fi-rr-add me-1"></i>{{ get_phrase('Add Question') }}
            </a>

            <a href="#"
                onclick="ajaxModal('{{ route('modal', ['admin.questions.choose', 'id' => $id]) }}', '{{ get_phrase('Choose Question') }}', 'modal-lg')"
                class="btn btn-sm btn-outline-secondary">
                <i class="fi-rr-list me-1"></i>{{ get_phrase('Choose Question') }}
            </a>

            <a href="#"
                onclick="ajaxModal('{{ route('modal', ['admin.questions.sort', 'id' => $id]) }}', '{{ get_phrase('Sort Questions') }}')"
                class="btn btn-sm btn-outline-dark">
                <i class="fi-rr-sort me-1"></i>{{ get_phrase('Sort Questions') }}
            </a>
        </div>
    </div>

    <ul class="list-group">
        @foreach ($questions as $key => $question)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="d-flex flex-column">
                    <div class="d-flex gap-2 align-items-start">
                        <span class="fw-bold">{{ $loop->iteration }}.</span>
                        <div>{!! $question->title !!}</div>
                    </div>

                    <div>
                        <span class="badge rounded-pill border mt-2 px-3 py-1 text-muted" style="font-size: 12px; background-color:#f8f9fa;">
                            {{ ucfirst(str_replace('_', ' ', $question->type)) }}
                        </span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="#"
                        onclick="ajaxModal('{{ route('modal', ['admin.questions.edit', 'id' => $question->id]) }}', '{{ get_phrase('Edit Question') }}', 'modal-lg')"
                        class="btn btn-sm btn-outline-info rounded-circle" data-bs-toggle="tooltip" title="Edit">
                        <i class="fi-rr-pencil"></i>
                    </a>

                    <a href="#"
                        onclick="confirmModal('{{ route('admin.course.question.delete', $question->id) }}'); event.stopPropagation();"
                        class="btn btn-sm btn-outline-danger rounded-circle" data-bs-toggle="tooltip" title="Delete">
                        <i class="fi-rr-trash"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="row d-flex">
        <div class="col-md-6">
            <a onclick="ajaxModal('{{ route('modal', ['admin.questions.create', 'id' => $id]) }}', '{{ get_phrase('Add Question') }}', 'modal-lg')"
                href="#" class="add-section-block text-center">
                <p class="sub-title"><i class="fi-rr-add"></i></p>
                <h3 class="title text-15px mt-2 fw-500">{{ get_phrase('Add Question') }}</h3>
            </a>
        </div>
        <div class="col-md-6">
            <a onclick="ajaxModal('{{ route('modal', ['admin.questions.choose', 'id' => $id]) }}', '{{ get_phrase('choose Question') }}', 'modal-lg')"
                href="#" class="add-section-block text-center">
                <p class="sub-title"><i class="fi-rr-list"></i></p>
                <h3 class="title text-15px mt-2 fw-500">{{ get_phrase('choose Question') }}</h3>
            </a>
        </div>
    </div>
@endif
