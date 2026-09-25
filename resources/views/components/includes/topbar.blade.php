<nav class="navbar navbar-dark bg-dark  shadow-sm px-4">

    <span class="navbar-brand text-white">
       
        <img 
        src="https://ui-avatars.com/api/?name={{Auth::user()->name}}
"
        width="40"
        class="rounded-circle">

        <span class="me-3 text-white">
             {{Auth::user()->name}}
        </span>

    </span>

    <div class="link">
        <a class="nav-link text-danger " href="{{route('logout')}}">Logout   <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
 

</nav>