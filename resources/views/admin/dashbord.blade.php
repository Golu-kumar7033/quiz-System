@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Inter, Arial, sans-serif;
        }

        body {
            background: #080b12;
            color: #f8fafc;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 35px;
        }

        /* HEADER */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 30px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #8b95a7;
            margin-top: 7px;
            font-size: 14px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .admin-profile small {
            color: #8b95a7;
        }

        /* STATS */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #111620;
            border: 1px solid #1d2532;
            border-radius: 14px;
            padding: 22px;
            transition: .25s;
        }

        .stat-card:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-title {
            color: #8b95a7;
            font-size: 13px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .blue {
            background: #172554;
            color: #60a5fa;
        }

        .purple {
            background: #2e1065;
            color: #c084fc;
        }

        .green {
            background: #052e1a;
            color: #4ade80;
        }

        .orange {
            background: #431407;
            color: #fb923c;
        }

        .stat-card h2 {
            font-size: 28px;
            margin-top: 18px;
        }

        .growth {
            color: #4ade80;
            font-size: 12px;
            margin-top: 7px;
        }

        /* MAIN GRID */

        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .card {
            background: #111620;
            border: 1px solid #1d2532;
            border-radius: 14px;
            padding: 22px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h3 {
            font-size: 17px;
        }

        .view-all {
            color: #60a5fa;
            text-decoration: none;
            font-size: 13px;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            color: #737f92;
            font-size: 12px;
            font-weight: normal;
            text-align: left;
            padding: 12px 10px;
            border-bottom: 1px solid #202938;
        }

        td {
            padding: 16px 10px;
            border-bottom: 1px solid #1b2330;
            color: #cbd5e1;
            font-size: 13px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .quiz-name {
            color: white;
            font-weight: 600;
        }

        .category {
            color: #8b95a7;
        }

        .status {
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
        }

        .published {
            background: #052e1a;
            color: #4ade80;
        }

        .draft {
            background: #3f2a08;
            color: #fbbf24;
        }

        .edit {
            color: #60a5fa;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete {
            color: #f87171;
            text-decoration: none;
        }

        /* ACTIVITY */

        .activity {
            display: flex;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid #1d2532;
        }

        .activity:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #172033;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .activity strong {
            display: block;
            font-size: 13px;
            color: #e2e8f0;
        }

        .activity p {
            color: #7f8a9d;
            font-size: 12px;
            margin-top: 5px;
        }

        .time {
            color: #586477;
            font-size: 11px;
            margin-top: 5px;
            display: block;
        }

        /* QUICK ACTIONS */

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 20px;
        }

        .quick-card {
            background: #111620;
            border: 1px solid #1d2532;
            border-radius: 14px;
            padding: 20px;
            cursor: pointer;
            transition: .25s;
        }

        .quick-card:hover {
            border-color: #6366f1;
            background: #131925;
        }

        .quick-icon {
            width: 42px;
            height: 42px;
            background: #172033;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .quick-card h4 {
            margin-bottom: 6px;
            font-size: 14px;
        }

        .quick-card p {
            color: #7f8a9d;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .container {
                padding: 20px;
            }

            .header {
                align-items: flex-start;
            }

            .header h1 {
                font-size: 24px;
            }

            .admin-profile > div:first-child {
                display: none;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>

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
                <span class="stat-title">TOTAL QUIZZES</span>

                <div class="stat-icon blue">
                    📝
                </div>
            </div>

            <h2>128</h2>

            <p class="growth">↑ 12% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">QUESTIONS</span>

                <div class="stat-icon purple">
                    ❓
                </div>
            </div>

            <h2>1,540</h2>

            <p class="growth">↑ 8% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">STUDENTS</span>

                <div class="stat-icon green">
                    👥
                </div>
            </div>

            <h2>2,845</h2>

            <p class="growth">↑ 18% this month</p>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span class="stat-title">ATTEMPTS</span>

                <div class="stat-icon orange">
                    📊
                </div>
            </div>

            <h2>8,920</h2>

            <p class="growth">↑ 23% this month</p>

        </div>

    </section>


    <!-- MAIN CONTENT -->

    <section class="main-grid">

        <!-- QUIZ TABLE -->

        <div class="card">

            <div class="card-header">

                <h3>Quiz Management</h3>

                <a href="#" class="view-all">
                    View All →
                </a>

            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>QUIZ</th>
                            <th>CATEGORY</th>
                            <th>QUESTIONS</th>
                            <th>ATTEMPTS</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td class="quiz-name">HTML Fundamentals</td>
                            <td class="category">Web Development</td>
                            <td>25</td>
                            <td>540</td>
                            <td>
                                <span class="status published">
                                    Published
                                </span>
                            </td>
                            <td>
                                <a href="#" class="edit">Edit</a>
                                <a href="#" class="delete">Delete</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="quiz-name">JavaScript Basics</td>
                            <td class="category">Programming</td>
                            <td>30</td>
                            <td>420</td>
                            <td>
                                <span class="status published">
                                    Published
                                </span>
                            </td>
                            <td>
                                <a href="#" class="edit">Edit</a>
                                <a href="#" class="delete">Delete</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="quiz-name">Python Programming</td>
                            <td class="category">Programming</td>
                            <td>40</td>
                            <td>315</td>
                            <td>
                                <span class="status draft">
                                    Draft
                                </span>
                            </td>
                            <td>
                                <a href="#" class="edit">Edit</a>
                                <a href="#" class="delete">Delete</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="quiz-name">Database Systems</td>
                            <td class="category">Database</td>
                            <td>20</td>
                            <td>280</td>
                            <td>
                                <span class="status published">
                                    Published
                                </span>
                            </td>
                            <td>
                                <a href="#" class="edit">Edit</a>
                                <a href="#" class="delete">Delete</a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- ACTIVITY -->

        <div class="card">

            <div class="card-header">

                <h3>Recent Activity</h3>

                <a href="#" class="view-all">
                    View All
                </a>

            </div>


            <div class="activity">

                <div class="activity-icon">
                    👤
                </div>

                <div>
                    <strong>Rahul Sharma</strong>
                    <p>Completed HTML Fundamentals</p>
                    <span class="time">5 minutes ago</span>
                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">
                    📝
                </div>

                <div>
                    <strong>Admin</strong>
                    <p>Created JavaScript Quiz</p>
                    <span class="time">25 minutes ago</span>
                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">
                    ❓
                </div>

                <div>
                    <strong>Admin</strong>
                    <p>Added 15 questions</p>
                    <span class="time">1 hour ago</span>
                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">
                    👥
                </div>

                <div>
                    <strong>Priya Kumar</strong>
                    <p>Registered as a student</p>
                    <span class="time">2 hours ago</span>
                </div>

            </div>

        </div>

    </section>


    <!-- QUICK ACTIONS -->

    <section class="quick-actions">

        <div class="quick-card">

            <div class="quick-icon">
                ➕
            </div>

            <h4>Create New Quiz</h4>

            <p>
                Create and publish a new quiz.
            </p>

        </div>


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

</div>

@endsection