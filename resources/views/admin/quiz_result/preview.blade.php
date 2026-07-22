<style>
/* Accordion Styling */
.accordion-button {
    font-size: 14px;
    font-weight: 500;
    background: #fff;
    border-radius: 10px;
    padding: 12px 20px;
    transition: background 0.3s, box-shadow 0.3s;
}
.accordion-button:not(.collapsed) {
    background: #f4f7fe;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}
.accordion-button:focus {
    box-shadow: none;
}
.accordion-button span.ms-5 {
    font-size: 12px;
    color: #888;
}

/* Question Container */
.result-question {
    background: #fff;
    padding: 18px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: background 0.4s, transform 0.3s;
    cursor: pointer;
}

/* Hover effect */
.result-question:hover {
    transform: translateY(-5px);
    background: #eef5ff;
}

/* Correct / Wrong Highlight */
.result-question.correct {
    background: #d4edda; /* أخضر فاتح */
    animation: correctPulse 1s ease infinite alternate;
}
.result-question.wrong {
    background: #f8d7da; /* أحمر فاتح */
    animation: wrongPulse 1s ease infinite alternate;
}

/* Pulse Animations */
@keyframes correctPulse {
    0% { background: #d4edda; }
    100% { background: #c3e6cb; }
}
@keyframes wrongPulse {
    0% { background: #f8d7da; }
    100% { background: #f5c6cb; }
}

/* Serial Number */
.result-question .serial {
    font-weight: 700;
    background: #6c5ce7;
    color: #fff;
    padding: 6px 12px;
    border-radius: 50%;
    margin-right: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s;
}
.result-question:hover .serial {
    transform: scale(1.1);
}

/* Question Title */
.result-question .mb-1 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
}

/* Answer Options */
.answer-container {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    transition: all 0.3s;
    margin-bottom: 8px;
    background: #fafafa;
}
.answer-container:hover {
    background: #f0f0ff;
}
.answer-container input:disabled {
    cursor: not-allowed;
}
.answer-container img {
    border-radius: 8px;
    max-width: 100px;
    max-height: 100px;
}

/* Fill Blanks */
.tagify {
    background: #f1f3f8;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* Answer Display */
p.text-success {
    font-weight: 600;
    margin-top: 10px;
    font-size: 14px;
}
p.text-success img {
    border: 2px solid #00b894;
    border-radius: 8px;
    margin-right: 5px;
    transition: transform 0.3s;
}
p.text-success img:hover {
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px){
    .result-question .mb-1 {
        flex-direction: column;
        align-items: flex-start;
    }
    .result-question .serial {
        margin-bottom: 5px;
    }
}
</style>

<div class="accordion" id="accordionExample">
    @foreach ($results as $key => $result)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $result->id }}" aria-expanded="false"
                    aria-controls="collapse-{{ $result->id }}">
                    {{ get_phrase('Attempt ') }}{{ ++$key }}
                    <span class="ms-5">{{ date('d M, Y H:i', strtotime($result->created_at)) }}</span>
                </button>
            </h2>
            <div id="collapse-{{ $result->id }}" class="accordion-collapse collapse"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="result">
                        @php
                            $submits = $result->submits ? json_decode($result->submits, true) : [];
                            $correct_answers = $result->correct_answer ? json_decode($result->correct_answer, true) : [];
                            $wrong_answers = $result->wrong_answer ? json_decode($result->wrong_answer, true) : [];
                            $mark_per_question = $quiz->total_mark / $questions->count();
                        @endphp

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-3 p-3">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-clock me-2 text-primary"></i>{{ get_phrase('Duration') }}</h6>
                            @php $duration = explode(':', $quiz->duration); @endphp
                            <p class="mb-0 text-muted">
                                {{ $duration[0] }} {{ get_phrase('Hour') }}
                                {{ $duration[1] }} {{ get_phrase('Minute') }}
                                {{ $duration[2] }} {{ get_phrase('Second') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-3 p-3">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-star me-2 text-warning"></i>{{ get_phrase('Total Mark') }}</h6>
                            <p class="mb-0 text-muted">{{ $quiz->total_mark }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-3 p-3">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-check-circle me-2 text-success"></i>{{ get_phrase('Pass Mark') }}</h6>
                            <p class="mb-0 text-muted">{{ $quiz->pass_mark }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-3 p-3">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-user-check me-2 text-success"></i>{{ get_phrase('Correct Answers') }}</h6>
                            <p class="mb-0 text-muted">{{ count($correct_answers) }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-3 p-3">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-user-times me-2 text-danger"></i>{{ get_phrase('Wrong Answers') }}</h6>
                            <p class="mb-0 text-muted">{{ count($wrong_answers) }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 rounded-3 p-3">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-medal me-2 text-info"></i>{{ get_phrase('Obtained Marks') }}</h6>
                            <p class="mb-0 text-muted">{{ count($correct_answers) * $mark_per_question }}</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3 p-3 text-center">
                            <h6 class="fw-bold mb-2"><i class="fi fi-rr-edit-alt me-2"></i>{{ get_phrase('Result') }}</h6>
                            @if (count($correct_answers) * $mark_per_question >= $quiz->pass_mark)
                                <span class="badge bg-success fs-6">{{ get_phrase('Passed') }}</span>
                            @else
                                <span class="badge bg-danger fs-6">{{ get_phrase('Failed') }}</span>
                            @endif
                        </div>
                    </div>
                </div>


                        @foreach ($questions as $k => $question)
                            @php
                                $given_answer = $question->type == 'true_false'
                                    ? $question->answer
                                    : implode(', ', json_decode($question->answer, true) ?? []);
                                $user_answers = array_key_exists($question->id, $submits) ? $submits[$question->id] : [];

                                $question_class = '';
                                if (in_array($question->id, $correct_answers)) {
                                    $question_class = 'correct';
                                } elseif(in_array($question->id, $wrong_answers)) {
                                    $question_class = 'wrong';
                                }
                            @endphp

                            <div class="result-question {{ $question_class }}">
                                <div class="mb-1 d-flex align-items-center gap-3">
                                    <span class="serial">{{ ++$k }}</span>
                                    <div>{!! $question->title !!}</div>
                                </div>

                                <div class="row {{ $question->type == 'fill_blanks' ? 'px-2' : '' }}">
                                    @if ($question->type == 'mcq')
                                        @php $options = json_decode($question->options, true) ?? []; @endphp
                                        @foreach ($options as $index => $option)
                                            @php
                                                $val = $user_answers ? array_search($option, $user_answers) : '';
                                                $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $option);
                                            @endphp
                                            <div class="col-sm-6">
                                                <div class="answer-container">
                                                    <input class="form-check-input" type="checkbox" value="{{ $option }}" @if (is_numeric($val)) checked @endif disabled>
                                                    <label class="form-check-label text-capitalize">
                                                        @if($isImage)
                                                            <img src="{{ asset($option) }}" alt="Option Image" style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            {{ $option }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif($question->type == 'fill_blanks')
                                        <input type="text" class="form-control tagify" data-role="tagsinput"
                                            value="{{ json_encode($user_answers) }}" disabled>
                                    @elseif($question->type == 'true_false')
                                        <div class="col-sm-2">
                                            <div class="answer-container">
                                                <input class="form-check-input" type="radio" disabled
                                                    @if ($user_answers == 'true') checked @endif>
                                                <label class="form-check-label">{{ get_phrase('True') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="answer-container">
                                                <input class="form-check-input" type="radio" disabled
                                                    @if ($user_answers == 'false') checked @endif>
                                                <label class="form-check-label">{{ get_phrase('False') }}</label>
                                            </div>
                                        </div>
                                    @endif
                                    <p class="text-capitalize text-success fw-600">
                                        {{ get_phrase('Answer : ') }}
                                        @if(preg_match('/\.(jpg|jpeg|png|gif)$/i', $given_answer))
                                            <img src="{{ asset($given_answer) }}" alt="Answer Image" style="max-width: 100px; max-height: 100px; margin-right: 5px;">
                                        @else
                                            {{ $given_answer }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
$('.result .tagify:not(.inited)').each(function(index, element) {
    var tagify = new Tagify(element, {
        placeholder: '{{ get_phrase('Enter your keywords') }}'
    });
    $(element).addClass('inited');
});
</script>
