<style>
.option-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}
.option-image:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.answer-container {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: #fafafa;
    transition: 0.3s;
    cursor: pointer;
    height: 100%;
}
.answer-container:hover {
    background: #f0f4ff;
}

</style>
<form action="{{ route('quiz.submit', $quiz->id) }}" method="post" class="quiz-submit-form">
    @csrf
    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

    @foreach ($questions as $key => $question)
        <div class="question mb-4 @if ($key > 0) d-none @endif">
            <div class="question-title">
                <span class="serial">{{ ++$key }} </span>
                <div>{!! $question->title !!}</div>
            </div>

            <div class="row gap-0">
                @if ($question->type == 'mcq')
                    @php 
                        $options = json_decode($question->options, true) ?? []; 
                    @endphp
                    @foreach ($options as $index => $option)
                        @php
                            $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $option);
                        @endphp

                        <div class="col-sm-6 my-2">
                            <div class="answer-container d-flex align-items-center gap-3" onclick="selectCheckbox(this)">
                                <div class="form-check" style="flex-grow:1;">
                                    <input class="form-check-input" type="checkbox" name="{{ $question->id }}[]" value="{{ $option }}" id="{{ $option }}-{{ $question->id }}">
                                    
                                    <label class="form-check-label text-capitalize @if($isImage) text-center shadow-none @endif" for="{{ $option }}-{{ $question->id }}">
                                        @if(!$isImage)
                                            {{ $option }}
                                        @else
                                            <div style="flex-shrink:0;">
                                                <img src="{{ asset($option) }}" 
                                                    alt="Option Image" 
                                                    class="option-image" 
                                                    onclick="event.stopPropagation(); openImageModal('{{ asset($option) }}')">
                                            </div>
                                        @endif
                                    </label>
                                </div>

                                @if($isImage)

                                @endif
                            </div>
                        </div>



                    @endforeach
                @elseif($question->type == 'fill_blanks')
                    <input type="text" class="form-control tagify" name="{{ $question->id }}" data-role="tagsinput">
                @elseif($question->type == 'true_false')
                    <div class="col-sm-6">
                        <div class="answer-container">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}" value="true" id="question-{{ $question->id }}-true">
                            <label class="form-check-label" for="question-{{ $question->id }}-true">{{ get_phrase('True') }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="answer-container">
                            <input class="form-check-input" type="radio" name="{{ $question->id }}" value="false" id="question-{{ $question->id }}-false">
                            <label class="form-check-label" for="question-{{ $question->id }}-false">{{ get_phrase('False') }}</label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</form>
<div id="imageModal" class="modal" tabindex="-1" style="display:none;">
    <div class="modal-content" style="max-width:600px; margin:50px auto; position:relative; background:#fff; padding:20px; border-radius:10px;">
        <span style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:20px;" onclick="closeImageModal()">&times;</span>
        <img id="modalImage" src="" style="width:100%; height:auto; border-radius:8px;">
    </div>
</div>

@if ($questions->count() > 0)
    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-center">
            <button type="button" class="eBtn gradient border-0" id="prevBtn" onclick="prevQuestion()">
                <i class="fi fi-rr-angle-small-right"></i>
                السابق
            </button>
            <button type="button" class="eBtn gradient border-0" id="nextBtn"
                onclick="nextQuestion()">
                التالى
                <i class="fi fi-rr-angle-small-left"></i>
            </button>
            @if ($submits->count() < $quiz->retake)
                <button type="button" class="eBtn gradient border-0 d-none" id="submitBtn"
                    onclick="submitQuiz()">تسليم<i class="fi fi-rr-badge-check me-2"></i></button>
            @endif
        </div>
    </div>
@endif

@include('course_player.init')
<script>
function openImageModal(src){
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').style.display = 'block';
}

function closeImageModal(){
    document.getElementById('imageModal').style.display = 'none';
}
document.getElementById('imageModal').addEventListener('click', function(e){
    if(e.target === this){
        this.style.display = 'none';
    }
});
function selectCheckbox(container){
    const checkbox = container.querySelector('input[type="checkbox"], input[type="radio"]');
    if(checkbox){
        checkbox.checked = !checkbox.checked;
    }
}

</script>
<script>
    let nextBtn = document.querySelector('#nextBtn');
    let prevBtn = document.querySelector('#prevBtn');
    let submitBtn = document.querySelector('#submitBtn');
    let submitForm = document.querySelector('.quiz-submit-form');
    // next question
    function nextQuestion() {
        let selectQuestion = document.querySelector('.question:not(.d-none)');
        let nextQuestion = selectQuestion.nextElementSibling;
        if (nextQuestion && nextQuestion.classList.contains('question')) {
            selectQuestion.classList.add('d-none');
            nextQuestion.classList.remove('d-none');
        }
        let nextNextQuestion = nextQuestion.nextElementSibling;
        if (!(nextNextQuestion && nextNextQuestion.classList.contains('question'))) {
            submitBtn.classList.remove('d-none');
            nextBtn.classList.add('d-none');
        }
    }

    // previous question
    function prevQuestion() {
        let selectQuestion = document.querySelector('.question:not(.d-none)');
        let prevQuestion = selectQuestion.previousElementSibling;
        if (prevQuestion && prevQuestion.classList.contains('question')) {
            selectQuestion.classList.add('d-none');
            prevQuestion.classList.remove('d-none');
        }
        if (nextBtn.classList.contains('d-none')) {
            nextBtn.classList.remove('d-none');
            submitBtn.classList.add('d-none');
        }
    }

    // submit quiz
    function submitQuiz() {
        submitForm.submit();
    }
</script>
