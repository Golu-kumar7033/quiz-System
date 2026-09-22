<nav class="navbar  sticky-top navbar-dark bg-dark mt-1 mb-3">
  <div class="container-fluid">
    <a  href="{{route('home')}}"class="navbar-brand">Quiz System</a>

  @if(Auth::check())
    <div class="d-flex gap-3 me-2">
        <a href="#">
            <span>Welcome, {{ Auth::user()->name }}</span>
        </a>

        <a href="{{ route('logout') }}">
            <span class="text-danger">
                Logout <i class="fa-solid fa-right-from-bracket"></i>
            </span>
        </a>
    </div>
@else
    <div class="d-flex gap-3 me-2">
        <a href="{{ route('login') }}">
            <i class="fa-solid fa-user-lock"></i>
            <span>Sign In</span>
        </a>

        <a href="{{ route('signUP') }}">
            <i class="fa-regular fa-user"></i>
            <span>Sign Up</span>
        </a>
    </div>
@endif

    
  </div>
</nav>
 

