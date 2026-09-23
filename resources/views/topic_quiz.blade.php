@extends('components.layout.user')
@section('contents')


<div class="quiz-container">
    <div class="quiz-card">
        
        <div class="quiz-header">
            <span class="topic-badge">{{ $quizMcq->Topic }}</span>
            <h2 class="question-counter">
                Question <span id="currentQuestion">1 </span> out of {{ $quizMcq->questions->count() }}</span> 
            </h2>
        </div>

        <form id="quizForm">
            @csrf
            @foreach($quizMcq->questions as $key => $question)
                <div class="question-block" 
                     id="question{{ $key }}" 
                     style="{{ $key == 0 ? '' : 'display:none;' }}">
                    
                    <h4 class="question-text">
                        {{ $key + 1 }}. {{ $question->question }}
                    </h4>

                    <div class="options-grid">
                        @foreach($question->options as $option)
                            <div class="option-item">
                                <label class="option-card" for="option_{{ $option->id }}">
                                    <div class="option-content">
                                        <span class="option-prefix">
                                            {{ chr(64 + $loop->iteration) }}
                                        </span>
                                        <span class="option-text">
                                            {{ $option->options }}
                                        </span>
                                    </div>

                                    <input class="custom-radio-input" 
                                           type="radio" 
                                           name="question_{{ $question->id }}" 
                                           value="{{ $option->id }}" 
                                           id="option_{{ $option->id }}">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="quiz-footer">
                <button type="button" id="nextBtn" class="action-btn" onclick="nextQuestion()">
                    <span>Save & Next</span>
                    <svg xmlns="http://w3.org" width="16" height="16" fill="currentColor" class="icon-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let current = 0;
const total = {{ $quizMcq->questions->count() }};

function showQuestion(index) {
    document.querySelectorAll('.question-block').forEach((question, i) => {
        question.style.display = i === index ? 'block' : 'none';
    });

    document.getElementById('currentQuestion').innerText = index + 1;
    const nextBtn = document.getElementById('nextBtn');

    if (index === total - 1) {
        nextBtn.innerHTML = `
            <span>Submit Quiz</span>
            <svg xmlns="http://w3.org" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
            </svg>
        `;
    } else {
        nextBtn.innerHTML = `
            <span>Save & Next</span>
            <svg xmlns="http://w3.org" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
            </svg>
        `;
    }
}

function nextQuestion() {
    const currentQuestionBlock = document.getElementById(`question${current}`);
    const selected = currentQuestionBlock.querySelector('input[type="radio"]:checked');

    if (!selected) {
        alert('Please select an answer before moving forward.');
        return;
    }

    if (current < total - 1) {
        current++;
        showQuestion(current);
    } else {
        submitQuiz();
    }
}

function submitQuiz() {
    // Escaped jQuery selectors for Blade compliance
    let formData = $('#quizForm').serialize();
    
    $('#nextBtn').prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span>Submitting...</span>
    `);

    // ajax (Post Request)
    
    $.ajax({
        url: "{{ route('quiz.quiz-submit') }}",
        type: "POST",
        //processData: false, 
       // contentType: false, 
        data: formData,
        dataType: "json",
        success: function(response) {
            if(response.success) {
                $('.result-card').html(`
                    <div class="alert alert-success text-center">Quiz Submitted Successfully!</div>
                `);
                  $('.quiz-card').html(`

                <div class="row text-center">
                    <div class=" topic-badge">Quiz {{$quizMcq->Topic}} Complited</div>

                    <div class=" d-flex justify-content-between mb mt-3 gap-3">
        
                        <h6 class="score-label">
                        Total Question : <span class="fs-5 ">{{ $quizMcq->questions->count() }}</span> 
                        </h6>
                        <h6 class="score-label">
                        Correct Question : <span class="fs-5 ">${response.score}</span> 
                        </h6>                        
                    </div>

                   <div class="score-container">
                        <div class="score-badge">
                            <span class="score-label">Score:</span>
                            <span id="finalScore" class="score-value">${response.score}</span>
                        </div>
                    </div>


                    <div d-flex justify-content-center gap-4>
                        <a href="" class="action-btn mb-3"><i class="fa-solid fa-arrow-rotate-left"></i> Try Agian</a>

                        <a href="{{route('user.profile')}}" class="action-btn">Resuilt <i class="fa-solid fa-share"></i></a>
                    </div>
                    
                </div>              
             `);
            } else {
                alert('Something went wrong. Please try again.');  
                $('#nextBtn').prop('disabled', false).html('<span>Save & Next</span>');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            let errorMessage = 'Failed to submit quiz. Please check your connection.';
            if(xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            alert(errorMessage);
            $('#nextBtn').prop('disabled', false).html('<span>Save & Next</span>');

       }
    });
}


showQuestion(current);
</script>

@endsection

<a href=""></a>