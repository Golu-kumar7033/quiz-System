<nav class="navbar  sticky-top navbar-dark bg-dark mt-1 mb-3">
  <div class="container-fluid">
    <a  href="{{route('home')}}"class="navbar-brand">Quiz System</a>

    @if(Session('user'))
    <div class="d-flex gap-3 me-2">
      <a href="">        
        <span>Wellcom , {{Session('user')->name}}</span>
      </a>
      <a href="{{route('signUP')}}"> <span class="text-danger">Logout <i class="fa-solid fa-right-from-bracket"></i> </span></a>
    </div>
   @else
     <div class="d-flex gap-3 me-2">
      <a href="{{route('login')}}"><i class="fa-solid fa-user-lock"></i> <span>Singn In</span></a>
      <a href="{{route('signUP')}}"><i class="fa-regular fa-user"></i> <span>Singn Up</span></a>
    </div>
    @endif
    
  </div>
</nav>
 

