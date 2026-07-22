@php
    $quiz = \Modules\BankQuestions\App\Models\BankQuizs::find($id);
    $questions = \Modules\BankQuestions\App\Models\BankQuestions::whereHas('quizs', function ($query) use ($id) {
        $query->where('quiz_id', $id);
    })->orderBy('sort')->get();
@endphp

@if ($questions->count() > 0)
    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="#"
            onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.create', 'id' => $id, 'category_id' => $quiz->category_id]) }}', '{{ get_phrase('Add Question') }}', 'modal-lg')"
            class="btn btn-primary btn-sm">
            <i class="fi-rr-add me-1"></i> {{ get_phrase('Add Question') }}
        </a>

        <a href="#"
            onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.choose', 'id' => $id]) }}', '{{ get_phrase('Choose Question') }}', 'modal-lg')"
            class="btn btn-outline-primary btn-sm">
            <i class="fi-rr-list me-1"></i> {{ get_phrase('Choose Question') }}
        </a>

        <a href="#"
            onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.sort', 'id' => $id]) }}', '{{ get_phrase('Sort Questions') }}')"
            class="btn btn-outline-secondary btn-sm">
            <i class="fi-rr-drag me-1"></i> {{ get_phrase('Sort Questions') }}
        </a>
    </div>

    <ul class="list-group">
        @foreach ($questions as $key => $question)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex gap-2 align-items-start">
                        <span class="fw-bold">{{ $loop->iteration }}.</span>
                        <div>{!! $question->title !!}</div>
                    </div>

                    {{-- نوع السؤال كبادج --}}
                    <div>
                        <span class="badge rounded-pill border text-muted px-3 py-1" style="font-size: 12px; background-color:#9aa7f1;">
                            {{ ucfirst(str_replace('_', ' ', $question->type)) }}
                        </span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="#"
                        onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.edit', 'id' => $question->id]) }}', '{{ get_phrase('Edit Question') }}', 'modal-lg')"
                        class="btn btn-sm btn-outline-info rounded-circle" data-bs-toggle="tooltip" title="Edit">
                        <i class="fi-rr-pencil"></i>
                    </a>

                    <a href="#"
                        onclick="confirmModal('{{ route('admin.bank.question.delete', [$id,$question->id]) }}'); event.stopPropagation();"
                        class="btn btn-sm btn-outline-danger rounded-circle" data-bs-toggle="tooltip" title="Delete">
                        <i class="fi-rr-trash"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>

@else
    <div class="row g-3">
        <div class="col-md-6">
            <a onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.create', 'id' => $id, 'category_id' => $quiz->category_id]) }}', '{{ get_phrase('Add Question') }}', 'modal-lg')"
                href="#" class="add-section-block text-center border rounded p-4 h-100 d-block">
                <i class="fi-rr-add fs-3 mb-2 text-primary"></i>
                <h5 class="mb-0">{{ get_phrase('Add Question') }}</h5>
            </a>
        </div>
        <div class="col-md-6">
            <a onclick="ajaxModal('{{ route('modal', ['bankquestions::questions.choose', 'id' => $id, 'category_id' => $quiz->category_id]) }}', '{{ get_phrase('Choose Question') }}', 'modal-lg')"
                href="#" class="add-section-block text-center border rounded p-4 h-100 d-block">
                <i class="fi-rr-list fs-3 mb-2 text-success"></i>
                <h5 class="mb-0">{{ get_phrase('Choose Question') }}</h5>
            </a>
        </div>
    </div>
@endif
