@extends('components.layout.user')
@section('contents')



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
                    {{ $isSelected ? ($isCorrect ? 'answer' : 'bg-danger') : '' }}">

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