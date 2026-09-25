
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button id="toggle-btn"><i class="fa-solid fa-bars"></i></button>
            <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-graduation-cap"></i> Quiz System</a>
            </div>
        </div> 
        <ul class="sidebar-nav">
            <li class="sidebar-item">
               <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="fa-solid fa-house"></i>
                    <span>DashBoard</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a href="{{ route('admin.users') }}" class="sidebar-link">
                    <i class="fa-regular fa-user"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#quiz-mange" aria-expanded="false" aria-controls="auth">
                   <i class="fa-solid fa-gears"></i>
                    <span>Quiz Management</span>
                </a>

                <ul id="quiz-mange" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                    <li class="sidebar-item">
                        <a href="{{route('admin.category') }}" class="sidebar-link"><i class="fa-solid fa-layer-group"></i> Quiz Category</a>
                    </li>
                    <!--category Quizess-->
                    @foreach($navdata as $link)
                    <li class="sidebar-item">
                        
                        <a href="{{route('admin.category-quiz',['type'=>$link->slug])}}" class="sidebar-link  mx-3" ><i class="fa-solid fa-layer-group"></i> {{$link->Title}}</a>

                        <ul class=" list-unstyled mx-5">
                            @foreach($link->quizzes as $quiz)
                            <li class="sidebar-item">
                                <a href="{{route('admin.quiz-topics',['type'=>$quiz->slug]) }}" class="sidebar-link">                                <i class="fa-brands fa-quinscape"></i>
                                {{$quiz->title}} </a>
                            </li>
                            @endforeach
        

                        </ul>   


                    </li>
                    @endforeach

                </ul>         
            </li>
            
           
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="sidebar-link">
                <i class="fa-regular fa-bell"></i>                  
                <span>Notification</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">Profile </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">Change passwaod</a>
                    </li>

                </ul>         
            </li>
        </ul>


        <div class="sidebar-footer ">
            <a href="{{route('logout')}}" class="sidebar-link">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    
</div>