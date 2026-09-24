@extends('components.layout.user')
@section('contents')


<style>
    
    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        font-size: 28px;
        color: #f9fafb;
    }

    .page-header p {
        margin-top: 6px;
        color: #8b95a7;
        font-size: 14px;
    }

    .attempt-badge {
        background: #1e1b4b;
        color: #a78bfa;
        border: 1px solid #4338ca;
        padding: 9px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    /* Summary */
    .summary {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 25px;
    }

    .summary-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .summary h2 {
        color: #f9fafb;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .summary-top p {
        color: #7f8a9d;
        font-size: 13px;
    }

    .score {
        font-size: 32px;
        font-weight: 700;
        color: #22c55e;
    }

    .summary-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .info-box {
        background: #0b1220;
        border: 1px solid #1f2937;
        padding: 16px;
        border-radius: 10px;
    }

    .info-box span {
        display: block;
        color: #788398;
        font-size: 12px;
        margin-bottom: 7px;
    }

    .info-box strong {
        font-size: 17px;
        color: #f3f4f6;
    }

    /* Question Card */
    .question-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-left: 4px solid #22c55e;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 18px;
        transition: 0.2s ease;
    }

    .question-card:hover {
        border-color: #374151;
        transform: translateY(-2px);
    }

    .question-card.wrong {
        border-left-color: #ef4444;
    }

    .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .question-number {
        color: #a78bfa;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .status {
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status.correct {
        background: rgba(34, 197, 94, .12);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, .25);
    }

    .status.incorrect {
        background: rgba(239, 68, 68, .12);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, .25);
    }

    /* Question */
    .question {
        color: #f3f4f6;
        font-size: 17px;
        font-weight: 600;
        line-height: 1.6;
        margin-bottom: 18px;
    }

    .option {
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 48px;
        padding: 10px 13px;
        background: #0d1422;
        border: 1px solid #263142;
        border-radius: 8px;
        color: #b9c1cf;
        font-size: 14px;
    }

    .option-label {
        width: 28px;
        height: 28px;
        min-width: 28px;
        border-radius: 7px;
        background: #1f2937;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 12px;
        font-weight: 700;
    }

    /* Correct option */
    .option.answer {
        background: rgba(34, 197, 94, .08);
        border-color: #15803d;
        color: #86efac;
    }

    .option.answer .option-label {
        background: #16a34a;
        color: white;
    }

    /* User selected wrong option */
    .option.selected {
        background: rgba(239, 68, 68, .08);
        border-color: #b91c1c;
        color: #fca5a5;
    }

    .option.selected .option-label {
        background: #dc2626;
        color: white;
    }

    /* Answer Details */
    .answer-info {
        margin-top: 16px;
        padding: 13px 15px;
        background: #0b1220;
        border: 1px solid #1f2937;
        border-radius: 8px;
        color: #8f9bad;
        font-size: 13px;
        line-height: 1.8;
    }

    .answer-info strong {
        color: #d1d5db;
    }

    .answer-info .correct-text {
        color: #4ade80;
    }

    .answer-info .wrong-text {
        color: #f87171;
    }

    /* Legend */
    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        margin: 25px 0;
        color: #8b95a7;
        font-size: 12px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
    }

    .dot.green {
        background: #22c55e;
    }

    .dot.red {
        background: #ef4444;
    }

    /* Footer */
    .page-footer {
        text-align: center;
        color: #566174;
        font-size: 12px;
        padding: 15px;
    }
    

    /* Mobile */
    @media (max-width: 650px) {

        .container {
            margin: 15px auto;
            padding: 12px;
        }

        .page-header {
            align-items: flex-start;
            gap: 12px;
        }

        .page-header h1 {
            font-size: 22px;
        }

        .attempt-badge {
            white-space: nowrap;
        }

        .summary {
            padding: 18px;
        }

        .summary-top {
            align-items: flex-start;
        }

        .score {
            font-size: 25px;
        }

        .summary-info {
            grid-template-columns: 1fr;
        }

        .question-card {
            padding: 17px;
        }

        .question {
            font-size: 15px;
        }
    }
</style>


<div class="container">

    <!-- Header -->
    <div class="page-header">
        <div>
            <h2>Attempt History</h2>
            <p>Review your quiz answers and performance.</p>
        </div>

        <div class="attempt-badge">
            Attempt # {{$attempt}}
        </div>
    </div>


    <!-- Summary -->
    <div class="summary">

        <div class="summary-top">

            <div>
                <h2>{{$quizAtquestion->Topic}}</h2>
                <p>{{ $quizAtquestion->created_at->format('d M Y, h:i A') }}</p>
            </div>

            <div class="score">
                {{ round(($userAns->where('score', 1)->count() /$quizAtquestion->questions->count())* 100) }}%
            </div>

        </div>

        <div class="summary-info">

            <div class="info-box">
                <span>Total Questions</span>
                <strong>{{$quizAtquestion->questions->count()}}</strong>
            </div>

            <div class="info-box">
                <span>Correct</span>
                <strong style="color:#4ade80;">
                    {{ $userAns->where('score', 1)->count() }}
                </strong>

            </div>

            <div class="info-box">
                <span>Incorrect</span>
                <strong style="color:#f87171;">
                    {{ $userAns->where('score', 0)->count() }}
                </strong>

           </div>

        </div>

    </div>


    <!-- Legend -->
    <div class="legend">

        <div class="legend-item">
            <span class="dot green"></span>
            Correct Answer
        </div>

        <div class="legend-item">
            <span class="dot red"></span>
            Your Wrong Answer
        </div>

    </div>


    <!-- Question 1 -->
 @foreach($quizAtquestion->questions as $key => $question)

    @php
        // Current question ka user answer
        $ans = $userAns->firstWhere('question_id', $question->id);

        // User ne jo option select kiya
        $selectedOption = $question->options->firstWhere('id', $ans?->select_ans);

        // Correct option
        $correctOption = $question->options->firstWhere('is_correct', 1);
    @endphp

    <div class="question-card">

        <div class="question-header">
            <span class="question-number">
                Question {{ $key + 1 }}
            </span>

            <span class="status {{ $ans?->score == 1 ? 'correct' : 'incorrect' }}">
                <b>{{ $ans?->score == 1 ? ' ✓ correct' : ' ✗ wrong' }}</b>
            </span>
        </div>

        <div class="question">
            {{ $question->question }}
        </div>

        <div class="row gap-3">

            @foreach($question->options as $option)

                @php
                    $isSelected = $option->id == $ans?->select_ans;
                    $isCorrect = $option->is_correct == 1;
                @endphp

                <div class="col-lg-5 col-md-5 col-sm-8 option
                    {{ $isSelected ? ($isCorrect ? 'answer' : 'selected') : '' }}">

                    <span class="option-label">
                        {{ chr(64 + $loop->iteration) }}
                    </span>

                    <span>{{ $option->options }}</span>

                    @if($isSelected)
                        <strong>
                            {{ $isCorrect ? '✓ correct' : '✗ wrong' }}
                        </strong>
                    @endif

                    </div>


            @endforeach

        </div>

        <div class="answer-info">

            <strong>Your Answer:</strong>

            <span class="{{ $selectedOption?->is_correct == 1 ? 'correct-text' : 'wrong-text' }}">
                {{ $selectedOption?->options ?? 'Not answered' }}
            </span>

            <br>

            <strong>Correct Answer:</strong>

            <span class="correct-text">
                {{ $correctOption?->options }}
            </span>

            @if($correctOption)
                <p>
                    {{ $correctOption->why_is_correct }}
                </p>
            @endif

        </div>

    </div>

@endforeach



    <div class="page-footer">
        End of attempt history
    </div>

</div>

@endsection