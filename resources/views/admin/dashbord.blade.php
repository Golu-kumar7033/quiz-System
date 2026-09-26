@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')

<div class="container">

    <!-- HEADER -->

    <header class="header">

        <div>
            <h1>Quiz Dashboard</h1>
            <p>Welcome back, Admin. Here's what's happening today.</p>
        </div>
  </header>


    <!-- STATISTICS -->

    <section class="stats">

        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">TOTAL QUIZ CATEGORIES</span>

                <div class="stat-icon blue">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>

            <h2>{{$categories}}</h2>

            <p class="growth">↑ 12% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">TOTAL QUIZZES</span>

                <div class="stat-icon blue">
                <i class="fa-brands fa-quinscape"></i>
                </div>
            </div>

            <h2>{{$quiz}}</h2>

            <p class="growth">↑ 12% this month</p>

        </div>

          <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">TOTAL QUIZ TOPICS</span>

                <div class="stat-icon blue">
                    <i class="fa-solid fa-hashtag"></i>
                </div>
            </div>

            <h2>{{$topic}}</h2>

            <p class="growth">↑ 12% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">QUESTIONS</span>

                <div class="stat-icon purple">
                    <i class="fa-solid fa-question"></i>
                </div>
            </div>

            <h2>{{$ques}}</h2>

            <p class="growth">↑ 8% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">USER</span>

                <div class="stat-icon green">
                    <i class="fa-solid fa-users-line"></i>
                </div>
            </div>

            <h2>{{$user}}</h2>

            <p class="growth">↑ 18% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">ATTEMPTS</span>

                <div class="stat-icon orange">
                    <i class="fa-solid fa-chart-column"></i>
                    
                </div>
            </div>

            <h2>{{$attempt}}</h2>

            <p class="growth">↑ 23% this month</p>

        </div>

    </section>


    <!-- MAIN CONTENT -->

    <section class="main-grid">

        <!-- QUIZ TABLE -->

        <div class="card">

            <div class="card-header">

                <h3>Quiz Management</h3>

                <a href="{{route('admin.category')}}" class="view-all">
                    View All →
                </a>

            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>QUIZ</th>
                            <th>Quiz Topic</th>
                            <th>CATEGORY</th>
                            <th>QUESTIONS</th>
                            <th>ATTEMPTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($table as $data)
                        <tr>
                            <td>{{$data->quiz_title}}</td>
                            <td>{{$data->topic_title}}</td>
                            <td>{{$data->category}}</td>
                            <td>{{$data->questions_count}}</td>
                            <td>{{$data->attempts_count}}</td>
                        </tr>
                        @empty
                        <td colspan="4">No Data</td>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>


        <!-- ACTIVITY -->

        <div class="card">

            <div class="card-header">

                <h3>Recent Activity</h3>

                <a href="{{Route('admin.user-activity')}}" class="view-all">
                    View All
                </a>

            </div>

            @foreach($activities as $recent)
            <div class="activity">

                <div class="activity-icon">
                    @if($recent->user->role=='admin')
                    <i class="fa-solid fa-user-secret"></i>
                    <span class="position-absolute top-5 start-50 text-primary translate-middle badge rounded-pill bg-warning">
                        {{$recent->user->role}}
                    </span>
                    @else
                    <i class="fa-solid fa-user"></i>
                    @endif
                </div>

                <div>
                    <strong>{{$recent->user->name}}</strong>
                    <p>{{$recent->activity_type}}</p>
                    <span class="time">
                        {{ $recent->created_at->format('d M Y, h:i A') }}
                    </span>
                </div>

            </div>
            @endforeach
        </div>

    </section>


    <!-- QUICK ACTIONS --

    <section class="quick-actions">


        <a href="{{route('admin.category')}}">

        <div class="quick-card">
            <div class="quick-icon">
                ➕
            </div>

            <h4>Create New Quiz</h4>

            <p>
                Create and publish a new quiz.
            </p>

        </div>
        </a>

        <div class="quick-card">

            <div class="quick-icon">
                ❓
            </div>

            <h4>Question Bank</h4>

            <p>
                Add or manage quiz questions.
            </p>

        </div>


        <div class="quick-card">

            <div class="quick-icon">
                📈
            </div>

            <h4>View Analytics</h4>

            <p>
                Analyze student performance.
            </p>

        </div>

    </section>
-->
</div>

@endsection