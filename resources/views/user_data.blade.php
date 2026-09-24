@extends('components.layout.user')
@section('contents')
<style>
.dropdown-menu {
    background-color: var(--bg-card);
    border: 1px solid var(--border-color); 
    border-radius: 8px;
    padding: 8px 0;
    min-width: 160px;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5); 
    list-style: none;
    position: absolute; 
    z-index: 1000;
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 10px 16px;
    color: var(--text-primary); 
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 500;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.dropdown-item:hover {
    background-color: var(--bg-item); 
    color: var(--accent-blue);
}

.dropdown-menu li:last-child .dropdown-item {
    border-top: 1px solid var(--border-color);
    margin-top: 4px;
    padding-top: 12px;
}

.dropdown-menu li:last-child .dropdown-item:hover {
    background-color: rgba(239, 68, 68, 0.1);
    color: #f87171; 
}

</style>
<div class="container-fluid">
    <div class="profile-container">
        <div class="profile-header">
            <div class="img">
                <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="user_img">
            </div>
            <div class="user-data">
                <h4>{{$user->name}}</h4>
            </div>
            <span role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></span>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#"> <i class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                <li><span class="dropdown-item"   data-bs-toggle="modal" data-bs-target="#changePassword"><i class="fa-solid fa-key"></i> Change Password</span></li>
                <li><a class="dropdown-item" href="{{route('logout')}}">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
            </ul>
        </div>
  

  
        <div class="box row g-1 gap-3">
            <div class="box-item col-md-6 col-lg-4">
                <p>Quiz Play</p>
                <span>{{session('ta')}}</span>
            </div>
            <div class="box-item col-md-6 col-lg-4">
               <p>Score</p>
                <span>{{$score}}</span>
            </div>
        </div>
    </div>
    
    <h3 class="text-center mb-3  mt-3">Attempted Quiz</h3>
    <pre>
    </pre>

    <div class="quiz-history">
        @foreach($attempts as $attempt)

        <div class="quiz-review mb-3">

            <div>
                <h6>{{ $attempt->topic->Topic }}</h6>
                {{Session::put('ta',$attempt->topic->count())}}
                <small>
                    {{ $attempt->created_at->format('d M Y, h:i A') }}
                </small>
            </div>

            <div class=" d-flex gap-3">
                <a href="{{ route('quiz.review', ['attempt' => $attempt->id, 'topic' => $attempt->topic->Topic]) }}">
                    Review <i class="fa-solid fa-binoculars"></i>
                </a>
            </div>

        </div>
        @endforeach

    </div>

<!--change password modal-->
<div class="modal fade"
        id="changePassword"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="passwordLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content password-modal">

                <!-- Header -->
                <div class="modal-header">
                    <div class="modal-heading">
                        <div class="modal-icon">
                            <i class="fa-solid fa-user-lock"></i> 
                       </div>

                        <div>
                            <h5 class="modal-title" id="passwordLabel">
                                Change Password
                            </h5>
                            <small>Use capital letters (A-Z), numbers (0-9), and special characters (@, #, $, %, etc.).</small>
                        </div>
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                    <form action="{{route('user.change-password')}}" method="POST">
                        @csrf
                        
                        <div class="password-input-group mb-2">
                            <label for="quizTitle">
                                New Password
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>

                                <input type="password"
                                    class="password-input {{($errors->first('password')?'is-invalid':'')}}"
                                    name="password"
                                    value="{{old('password')}}"
                                    id="passwordTitle"
                                    placeholder="e.g.1237@ED"
                                    >
                                <span class="text-danger" >@error('password'){{$message}} @enderror</span>

                            </div>
                        </div>

                        <div class="password-input-group mb-2">
                            <label for="passwordTitle">
                                Confirm Password
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>

                                <input type="password"
                                    class="password-input {{($errors->first('newpassword')?'is-invalid':'')}}"
                                    name="newpassword"
                                    value="{{old('newpassword')}}"
                                    id="passwordTitle"
                                    placeholder="e.g. Jon@42!5@#"
                                    >
                                <span class="text-danger" >@error('newpassword'){{$message}} @enderror</span>

                            </div>
                        </div>

                        <button type="submit" class="password-submit">
                            <i class="fa-solid fa-plus"></i>
                            Add password
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
     @if ($errors->has('password') ||$errors->has('newpassword') )
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <span>Validation Error</span>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ $errors->first('password') }}
                    <br>
                    {{ $errors->first('newpassword') }}

                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('liveToast');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>

    @endif
    <!--error-->
 

     @if (session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('liveToast');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>
    @endif
    <!--error-->
     @if (session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('liveToast');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>
    @endif
     

</div>
@endsection