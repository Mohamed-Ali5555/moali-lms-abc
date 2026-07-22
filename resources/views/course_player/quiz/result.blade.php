<style>
/* confetti لطيف وأكبر */
@keyframes confettiFall {
    0% { transform: translateY(0) rotate(0deg); opacity: 1; }
    100% { transform: translateY(200px) rotate(360deg); opacity: 0; }
}

.confetti-piece {
    position: absolute;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    opacity: 0.9;
    top: 0;
    pointer-events: none;
    animation-name: confettiFall;
    animation-timing-function: ease-out;
    animation-fill-mode: forwards;
}

/* رسالة تشجيعية */
#encouragement.show {
    display: inline-block;
    animation: fadeUp 1.5s ease forwards;
}

@keyframes fadeUp {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(-10px); }
}


/* Container */
.result {
    background: #f9f9f9;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Info Cards */
.result-info {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}
.result-info .info-card {
    flex: 1 1 45%;
    background: linear-gradient(135deg, #f6f8ff, #ffffff);
    border-radius: 15px;
    padding: 20px 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s, opacity 0.6s;
    display: flex;
    align-items: center;
    gap: 15px;
    opacity: 0;
}
.result-info .info-card i {
    font-size: 28px;
    color: rgb(var(--c-accent-rgb));
}
.result-info .info-card h6 {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 5px;
    color: #333;
}
.result-info .info-card p {
    font-size: 20px;
    font-weight: 600;
    margin: 0;
    color: #555;
}

/* Question Section */
.result-question {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: background 0.3s, transform 0.2s, opacity 0.5s;
    cursor: pointer;
    opacity: 0;
}

/* حالة الإجابة */
.result-question.correct {
    background: #d4edda; /* أخضر فاتح */
}
.result-question.wrong {
    background: #f8d7da; /* أحمر فاتح */
}

/* hover effect */
.result-question:hover {
    transform: translateY(-5px);
}

/* Serial Number */
.result-question .serial {
    font-weight: 700;
    background:  rgb(var(--c-accent-rgb));
    color: #fff;
    padding: 8px 14px;
    border-radius: 50%;
    margin-right: 15px;
    display: inline-block;
    display: flex;
    align-items: center;
    justify-content: center;

}

/* Question title */
.result-question .mb-1 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
}

/* Answer Options */
.answer-container {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    transition: 0.3s;
    background: #fafafa;
}
.answer-container img {
    border-radius: 8px;
}
.answer-container input:disabled {
    cursor: not-allowed;
}

/* Answer Status Colors */
.answer-wrong {
    background-color: #ffebee !important;
    border-color: #f44336 !important;
    color: #d32f2f;
}

.answer-correct {
    background-color: #e8f5e8 !important;
    border-color: #4caf50 !important;
    color: #2e7d32;
}

.answer-missed {
    background-color: #e8f5e8 !important;
    border-color: #4caf50 !important;
    color: #4caf50;
    opacity: 0.9;
}

/* MCQ Grid */
.row.gap-0 .col-sm-6 {
    padding-right: 10px;
    padding-left: 10px;
    margin-bottom: 10px;
}

/* Back Button */
#backBtn {
    background: var(--main-gradient);
    color: #fff;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 10px;
    transition: 0.3s;
}
#backBtn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(var(--c-accent-rgb),0.3);
}

/* Answer Images */
p.text-success img {
    border: 2px solid #00b894;
    border-radius: 8px;
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

<div class="result">

    @php
        $submits = $result->submits ? json_decode($result->submits, true) : [];
        $correct_answers = $result->correct_answer ? json_decode($result->correct_answer, true) : [];
        $wrong_answers = $result->wrong_answer ? json_decode($result->wrong_answer, true) : [];
        $mark_per_question = $quiz->total_mark / $questions->count();
        $duration = explode(':', $quiz->duration);
    @endphp

    {{-- Info Cards --}}
    <div class="result-info">
        <div class="info-card">
            <i class="fi fi-rr-trophy"></i>
            <div>
                <h6>اجمالي الدرجات</h6>
                <p>{{ $quiz->total_mark }}</p>
            </div>
        </div>
        <div class="info-card">
            <i class="fi fi-rr-check"></i>
            <div>
                <h6>الاسئلة الصحيحة</h6>
                <p>{{ count($correct_answers) }}</p>
            </div>
        </div>
        <div class="info-card">
            <i class="fi fi-rr-cross-small"></i>
            <div>
                <h6>الاسئلة الخاطئة</h6>
                <p>{{ count($wrong_answers) }}</p>
            </div>
        </div>
        <div class="info-card">
            <i class="fi fi-rr-star"></i>
            <div>
                <h6>الدرجة</h6>
                @php
                    $result = number_format(count($correct_answers) * $mark_per_question,1);
                @endphp
                <p>{{ $result }}</p>
            </div>
        </div>
        <div class="info-card text-center" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                <i class="fi fi-rr-shield-check" style="font-size:30px;"></i>
                <h6 class="mb-0">النتيجة</h6>
            </div>

            <div class="result-status text-center position-relative my-3">
                <p id="statusText" class="{{ (count($correct_answers)*$mark_per_question >= $quiz->pass_mark) ? 'text-success' : 'text-danger' }} mb-0" style="font-weight:600; font-size:16px;">
                    {{ (count($correct_answers)*$mark_per_question >= $quiz->pass_mark) ? get_phrase('Passed') : get_phrase('Failed') }}
                </p>

                <!-- رسالة تشجيعية -->
                @if(count($correct_answers)*$mark_per_question < $quiz->pass_mark)
                    <span id="encouragement" class="text-warning" style="display:none; font-size:14px; font-weight:500; position:absolute; top:30px; left:50%; transform:translateX(-50%);">
                        حاول مرة اخرى وستتحسن بالتأكيد! 💪
                    </span>
                @endif
            </div>

        </div>



    </div>

    {{-- Questions --}}
    @foreach ($questions as $key => $question)
        @php
            if ($question->type == 'true_false') {
                $given_answer = $question->answer;
            } else {
                $decoded = json_decode($question->answer, true);
                $answers = is_array($decoded) ? $decoded : [$question->answer];
                $given_answer = implode(', ', $answers);
            }
            $user_answers = array_key_exists($question->id, $submits) ? $submits[$question->id] : [];
            $question_class = in_array($question->id, $correct_answers) ? 'correct' : (in_array($question->id, $wrong_answers) ? 'wrong' : '');
        @endphp

        <div class="result-question {{ $question_class }}">
            <div class="mb-1 d-flex align-items-center gap-3">
                <span class="serial">{{ ++$key }}</span>
                <div>{!! $question->title !!}</div>
            </div>

            <div class="row gap-0">
                @if ($question->type == 'mcq')
                    @php $options = json_decode($question->options, true) ?? []; @endphp
                    @foreach ($options as $index => $option)
                        @php
                            $isSelected = $user_answers && in_array($option, $user_answers);
                            $isCorrect = in_array($option, json_decode($question->answer, true) ?? []);
                            $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $option);
                        @endphp
                        <div class="col-sm-6 my-2">
                            <div class="answer-container @if(in_array($question->id, $wrong_answers) && $isSelected) answer-wrong @elseif(in_array($question->id, $correct_answers) && $isSelected) answer-correct @elseif($isCorrect && !$isSelected) answer-missed @endif ">
                                <input class="form-check-input" type="checkbox" value="{{ $option }}" @if ($isSelected) checked @endif disabled>
                                {{-- @if($isImage)
                                    <img src="{{ asset($option) }}" alt="Option Image" style="max-width:100px; max-height:100px;">
                                @else
                                    {{ $option }}
                                @endif --}}
                                @if($isImage)
                                    <img src="{{ asset($option) }}" alt="Option Image" style="max-width:100px; max-height:100px; cursor:pointer;"
                                        class="preview-img">
                                @else
                                    {{ $option }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                @elseif($question->type == 'fill_blanks')
                    <input type="text" class="form-control tagify" data-role="tagsinput" value="{{ json_encode($user_answers) }}" disabled>
                @elseif($question->type == 'true_false')
                    <div class="col-sm-6">
                        <div class="answer-container @if($given_answer == 'false' && $user_answers == 'true') answer-wrong @endif">
                            <input class="form-check-input" type="radio" disabled @if($user_answers == 'true') checked @endif>
                            <label class="form-check-label">{{ get_phrase('True') }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="answer-container @if($given_answer == 'true' && $user_answers == 'false') answer-wrong @endif">
                            <input class="form-check-input" type="radio" disabled @if($user_answers == 'false') checked @endif>
                            <label class="form-check-label">{{ get_phrase('False') }}</label>
                        </div>
                    </div>
                @endif

                <p class="text-capitalize text-success fw-600">
                    {{ get_phrase('Answer : ') }}
                    {{-- @if(preg_match('/\.(jpg|jpeg|png|gif)$/i', $given_answer))
                        <img src="{{ asset($given_answer) }}" alt="Answer Image" style="max-width:100px; max-height:100px; margin-right:5px;">
                    @else
                        {{ $given_answer }}
                    @endif --}}
                    @if(preg_match('/\.(jpg|jpeg|png|gif)$/i', $given_answer))
                        <img src="{{ asset($given_answer) }}" alt="Answer Image" style="max-width:100px; max-height:100px; margin-right:5px; cursor:pointer;"
                            class="preview-img">
                    @else
                        {{ $given_answer }}
                    @endif
                </p>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex gap-3 justify-content-center">
            <button type="button" class="eBtn gradient border-0 mb-4 d-flex align-items-center gap-2" id="backBtn" onclick="back()">
                <i class="fi fi-rr-angle-small-left fs-5"></i>{{ get_phrase('Back') }}
            </button>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0">
                <img src="" id="modalImage" class="img-fluid rounded" alt="Preview">
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
            </div>
        </div>
    </div>

</div>

<script>
const passed = {{ (count($correct_answers)*$mark_per_question >= $quiz->pass_mark) ? 'true' : 'false' }};
const container = document.querySelector('.result-status');

if(passed){
    function createConfetti(){
        const confetti = document.createElement('span');
        confetti.classList.add('confetti-piece');
        confetti.style.background = `hsl(${Math.random()*360}, 70%, 65%)`;
        confetti.style.left = `${Math.random()*100}%`;
        confetti.style.width = `${8 + Math.random()*5}px`;
        confetti.style.height = confetti.style.width;
        confetti.style.animationDuration = `${1 + Math.random()*1.5}s`;
        container.appendChild(confetti);

        confetti.addEventListener('animationend', ()=> confetti.remove());
    }

    // إنشاء confetti كل نصف ثانية
    const confettiInterval = setInterval(createConfetti, 500);

    // إذا خرج المستخدم من الصفحة أو ضغط مكان آخر نوقفه
    window.addEventListener('beforeunload', ()=> clearInterval(confettiInterval));

}else{
    const msg = document.getElementById('encouragement');
    msg.classList.add('show');
}

// Bootstrap Modal
var imageModal = new bootstrap.Modal(document.getElementById('imageModal'), {
  keyboard: true
});

// افتح الصورة عند الضغط
document.querySelectorAll('.preview-img').forEach(img => {
    img.addEventListener('click', function(){
        document.getElementById('modalImage').src = this.src;
        imageModal.show();
    });
});

function back() {
    description.classList.remove('d-none');
    starterContainer.classList.remove('d-none');
    document.querySelector('.result').remove();
}

// Tagify
$('.result .tagify:not(.inited)').each(function(index, element) {
    var tagify = new Tagify(element, {
        placeholder: '{{ get_phrase('Enter your keywords') }}'
    });
    $(element).addClass('inited');
});

// Simple fade-in animation
document.querySelectorAll('.info-card, .result-question').forEach((el, i)=>{
    setTimeout(()=>{ el.style.opacity = 1; el.style.transform = 'translateY(0)'; }, i*150);
});
</script>
