@extends('components.layout.user')
@section('contents')

<!--hero section-->
<section class="hero-section">
    <div class="hero-container">
        <span class="hero-badge">Play , learn and win </span>
        <h1 class="hero-title">Test your Knowlege</h1>
        <p class="hero-slogan">"Make learning fun, new every day whit Quizzes"- Find topic of choice and start playing<p>
        
        <!-- Search Bar Form -->
        <form action="{{route('search')}}" method="GET" class="search-container">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="search" name="query" class="search-input"  value="{{ request('query') }}" placeholder="Search any topic......." required>
            <button type="submit" class="search-btn">Search</button>
        </form>

        <!-- Popular Quick Tags -->
        <div class="popular-tags">
            Popular Subject: 
            <a href="#">Computer</a>, 
            <a href="#">GK</a>, 
            <a href="#">Coding</a>
        </div>
    </div>
</section>
<style>
.glow-badge {
  animation: glow 1.5s ease-in-out infinite alternate;
}

@keyframes glow {
  from {
    box-shadow: 0 0 5px #00ffff;
  }
  to {
    box-shadow: 0 0 10px #0e5252,
                0 0 20px #2e0631,
                0 0 30px #00ffff;
  }
}
.glow-badge {
  animation: fadeInOut 0.5s ease-in-out infinite;
}

@keyframes fadeInOut {
  0%, 100% {
    opacity: 1;
  }

  50% {
    opacity: 0.3;
  }
}



</style>
<!-quizess->
<div class="container">
    <div class="text-center mb-5">
        <h2> Choose a topic to begin your quiz and start learning right now.</h2>
    </div>

<div class="modern-wrapper">
@forelse($categories as $category)
    <div class="modern-card">
        <div class="card-header">
            <div>
                <h2>{{ $category->Title }}</h2>
                <small>{{ $category->slug }}</small>
            </div>
            <div class="badge">{{ $category->quizzes->count() }} Quizzes</div>
        </div>
        <div class="card-body">
            @if($category->quizzes->count() > 0)
                <div class="quiz-grid">
                    @foreach($category->quizzes as $quiz)
                        <div class="quiz-box">
                            <h4>{{ $quiz->title ?? 'Quiz #'.$quiz->id }} <span>{{ $quiz->topics->count() }} Topics</span></h4>
                            @if( $quiz->topics->count()> 0)

                                <div class="topic-list">
                                    @foreach($quiz->topics as $topic)
                                        <a href="{{ route('quiz.topic_quiz',['type'=>$topic->slug])}}" class="topic-item">
                                            <span>{{ $topic->Topic }}</span>
                                            <h6 class="badge bg-info glow-badge text-danger">Attempt</h6>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                            <p style="text-align:center;color:#94a3b8;padding:20px;">No Quizzes Topics</p>
                            @endif

                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align:center;color:#94a3b8;padding:20px;">No Quizzes</p>
            @endif
        </div>
    </div>
    @empty
    <div class="no-data">
        <h5>Search Data Not Fount !</h5>
    </div>
@endforelse
</div>

</div>


@endsection
 