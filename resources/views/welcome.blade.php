@extends('components.layout.user')
@section('contents')

<!--hero section-->
<section class="hero-section">
    <div class="hero-container">
        <span class="hero-badge">Play , learn and win </span>
        <h1 class="hero-title">Test your Knowlege</h1>
        <p class="hero-slogan">"Make learning fun, new every day whit Quizzes"- Find topic of choice and start playing<p>
        
        <!-- Search Bar Form -->
        <form action="/search" method="GET" class="search-container">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" name="query" class="search-input" placeholder="Search any topic......." required>
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
@foreach($categories as $category)
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
@endforeach
</div>

</div>


@endsection
 <!-- <style>
        /* सामान्य बॉडी स्टाइलिंग */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* श्रेणी (Category) कंटेनर */
        .category {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        /* मुख्य आइटम कार्ड (Item Card) */
        .item-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            padding: 24px;
            width: 280px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #eef2f5;
            text-align: center;
        }

        /* कार्ड पर होवर (Hover) इफ़ेक्ट */
        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* आइटम का नाम (Strong टैग की स्टाइलिंग) */
        .item-card strong {
            display: block;
            font-size: 1.25rem;
            color: #2c3e50;
            margin-bottom: 8px;
            font-weight: 600;
        }

        /* अतिरिक्त विवरण (वैकल्पिक) */
        .item-card p {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin: 0 0 16px 0;
            line-height: 1.4;
        }

        /* बटन की स्टाइलिंग */
        .item-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .item-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="category">
    <div class="item-card">
        <strong></strong>
        <button class="item-btn">देखें</button>
    </div>
</div>-->