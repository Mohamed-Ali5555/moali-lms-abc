<style>
    .quiz-title {
        font-size: 18px;
        font-weight: 500;
        padding: 20px 0;
        font-weight: 600;
    }

    .quiz-starter .starter-label {
        display: inline-block;
        width: 110px;
    }

    .quiz-starter p {
        font-size: 15px;
        font-weight: 500;
        color: #6e798a;
    }

    .question {
        min-height: 155px;
    }

    input[type="text"] {
        padding: 12px 50px 12px 20px;
        border-radius: 10px;
        border: 1px solid #6b738530;
        box-shadow: none !important;
    }

    .gradient-border {
        background: #fff;
        border: 2px solid #2f57ef;
        color: #212529;
        transition: .3s;
    }

    .gradient-border:hover {
        color: #fff;
        background: #2f57ef;
    }

    .timer-container > div {
        width: fit-content;
        background: var(--theme-secondary-background);
        padding: 0.5rem;
        border-radius: 0.5rem;
    }

    #quizTimer {
        width: 80px;
        background: var(--theme-color);
        color: rgba(var(--c-bg-rgb));
        border-radius: 0.5rem;
        padding: 0 0.5rem;
    }
</style>
@php
    $now = now()->format('Y-m-d H:i');
    $quiz = App\Models\Lesson::where('status',1)->where('id', request()->route()->parameter('id'))->active()->firstOrNew();

    $questions = DB::table('questions')
        ->where('quiz_id', $quiz->id)
        ->get();

    $submits = DB::table('quiz_submissions')
        ->where('quiz_id', $quiz->id)
        ->where('user_id', auth()->user()->id)
        ->get();
@endphp

<div class="row px-4">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between border-bottom">
            <h4 class="quiz-title text-center flex-grow-1"><span>{{ $quiz->title }}</span></h4>

            <div class="timer-container d-none">
                <div class="d-flex align-content-center gap-1 justify-content-end">
                    <span>
                        <i class="fi fi-rr-clock-five"></i>
                    </span>
                    <span class="fw-600 fs-6">{{ get_phrase('Time left : ') }}</span>
                    <p class="text-center fw-600 fs-6" id="quizTimer"></p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between my-3">
            <div class="description  border-bottom pb-3 w-100">{!! $quiz->description !!}</div>
        </div>
    </div>
</div>


<div class="row px-4 quiz-starter">
    <div class="col-md-6">
        <p class="d-flex gap-1">
            @php $duration = explode(':', $quiz->duration); @endphp
            <span class="starter-label">المدة</span>
            <span>: {{ lesson_durations($quiz->id) }}</span>
        </p>
        <p>
            <span class="starter-label">الدرجة النهائية</span>
            <span>: {{ $quiz->total_mark < 10 ? '0' : '' }}{{ $quiz->total_mark }}</span>
        </p>
        <p>
            <span class="starter-label">درجة النجاح</span>
            <span>: {{ $quiz->pass_mark < 10 ? '0' : '' }}{{ $quiz->pass_mark }}</span>
        </p>
        <p>
            <span class="starter-label">إجمالى التسليمات</span>
            <span>: {{ $quiz->retake < 10 ? '0' : '' }}{{ $quiz->retake }}</span>
        </p>
    </div>
    <div class="col-md-6">
        <p>
            <span class="starter-label">نوع الأسئلة</span>
            <span class="text-capitalize">:
                {{ str_replace('_', ' ', implode(', ', $questions->pluck('type')->unique()->toArray())) }}</span>
        </p>
        <p>
            <span class="starter-label">تسليمات الطالب</span>
            <span>: {{ $submits->count() < 10 ? '0' : '' }}{{ $submits->count() }}</span>
        </p>
        <p>
            <span class="starter-label">عدد الأسئلة</span>
            <span>: {{ $questions->count() < 10 ? '0' : '' }}{{ $questions->count() }}</span>
        </p>
    </div>

    <div class="col-12 d-flex justify-content-center gap-3">
        @foreach ($submits as $key => $submit)
            <button type="button" class="result-btn form-control eBtn gradient text-white" onclick="getResult(this)"
                id="{{ $submit->id }}">{{ get_phrase('View Result') }} {{ ++$key }}</button>
        @endforeach

        @if ($submits->count() < $quiz->retake)
            <button type="button" class="form-control eBtn gradient text-white" id="starterBtn">
            @if($quiz->type == '1')
                @if($submits->count() == 0)
                    <span>إبدأ الإمتحان</span>
                @else
                    <span>إعادة الإمتحان</span>
                @endif
            @elseif($quiz->type == '2')
                @if($submits->count() == 0)
                    <span>إبدأ الواجب</span>
                @else
                    <span>إعادة الواجب</span>
                @endif
            @endif
            </button>
        @endif
    </div>
</div>

<div class="load-content px-4"></div>

<script src="{{ asset('assets/frontend/default/js/jquery-3.7.1.min.js') }}"></script>
<script>
    let starterContainer = document.querySelector('.quiz-starter');
    let starterBtn = document.querySelector('#starterBtn');
    let questionSection = document.querySelector('.question-section');
    let quizTimer = document.querySelector('#quizTimer');
    let description = document.querySelector('.description');
    let resultSection = document.querySelector('.result-section');
    let backBtn = document.querySelector('#backBtn');

    // start quiz
    starterBtn.addEventListener('click', function() {
        starterContainer.classList.add('d-none');
        description.classList.add('d-none');
        $.ajax({
            type: "get",
            url: "{{ route('load.quiz.questions') }}",
            data: {
                quiz_id: "{{ $quiz->id }}"
            },
            success: function(response) {
                console.log(response)
                $('.load-content').html(response);
                startTimer();
            }
        });
    });

    function startTimer() {
        let timerContainer = document.querySelector('.timer-container');
        let quizTitle = document.querySelector('.quiz-title');
        timerContainer.classList.remove('d-none');
        quizTitle.classList.remove('text-center');

        let duration = "{{ $quiz->duration }}";
        let durationArr = duration.split(":");

        let hour = parseInt(durationArr[0]);
        let minute = parseInt(durationArr[1]);
        let second = parseInt(durationArr[2]);

        // update the initial timer
        quizTimer.innerHTML = (hour < 10 ? '0' + hour : hour) + ':' +
            (minute < 10 ? '0' + minute : minute) + ':' +
            (second < 10 ? '0' + second : second)

        // decrease the timer every second
        let timerInterval = setInterval(() => {
            if (hour === 0 && minute === 0 && second === 0) {
                clearInterval(timerInterval);
                endQuiz();
                return;
            }

            if (second === 0) {
                if (minute === 0) {
                    hour--;
                    minute = 59;
                } else {
                    minute--;
                }
                second = 59;
            } else {
                second--;
            }

            // update the timer
            quizTimer.innerHTML = (hour < 10 ? '0' + hour : hour) + ':' +
                (minute < 10 ? '0' + minute : minute) + ':' +
                (second < 10 ? '0' + second : second);
        }, 1000);
    }

    // load results
    function getResult(elem) {
        let id = $(elem).attr('id');
        description.classList.add('d-none');
        starterContainer.classList.add('d-none');

        $.ajax({
            type: "get",
            url: "{{ route('load.quiz.result') }}",
            data: {
                submit_id: id,
                quiz_id: "{{ $quiz->id }}"
            },
            success: function(response) {
                $('.load-content').html(response);
            }
        });
    }

    // end quiz
    function endQuiz() {
        submitQuiz();
    }
</script>
