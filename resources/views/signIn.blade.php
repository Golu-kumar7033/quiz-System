
@extends('components.layout.login')
@section('title','Login Sign Up')
@section('content')

  <div class="login_signIn">

    <div class="logo">
        <i class="fa-regular fa-circle-user"></i>
    </div>

    <h1>Create Account</h1>
    <p class="subtitle">Sign Up </p>

    <form action="{{route('user-signUp')}}" method="post">

@csrf
        
        
        <div class="input-group">
            <label for="text">FULL NAME</label>
                <input
                id="name"
                type="text"
                class="{{($errors->first('name')?'is-invalid':'')}}"
                name="name"
                value="{{old('name')}}"
                placeholder="Enter your fullname"
                required
                >
                <span class="text-danger" id="name">@error('name'){{$message}} @enderror</span>

        </div>

        <div class="input-group">
            <label for="email">EMAIL ADDRESS</label>
            <input
            id="email"
            class="{{($errors->first('email')?'is-invalid':'')}}"
            type="email"
            name="email"
            value="{{old('email')}}"
            placeholder="Enter your email"
            required
            >
            <span class="text-danger" id="name">@error('email'){{$message}} @enderror</span>

        </div>

        <div class="input-group">
            <label for="password">PASSWORD</label>

            <div class="input-box">

            <input
                class="password"
                type="password"
                class="{{($errors->first('password')?'is-invalid':'')}}"
                name="password"
                value="{{old('password')}}"
                placeholder="Enter your password"
                required
            >
            <span class="text-danger" id="name">@error('password'){{$message}} @enderror</span>


            <button
                type="button"
                class="toggle"
                onclick="togglePassword()"
            >
                SHOW
            </button>

            </div>
        </div>

        <div class="input-group">
            <label for="password">PASSWORD</label>

            <div class="input-box">

            <input
                class="password"
                type="password"
                class="{{($errors->first('Confirm_password')?'is-invalid':'')}}"
                name="Confirm_password"
                placeholder="Confirm password"
                value="{{old('Confirm_password')}}"
                required
            >
            <span class="text-danger" id="name">@error('Confirm_password'){{$message}} @enderror</span>
            <button
                type="button"
                class="toggle"
                onclick="togglePassword()"
            >
                SHOW
            </button>

            </div>
        </div>

        <button class="login-btn" type="submit">
            Create Account
        </button>

    </form>
<!--
    <div class="divider">
      OR CONTINUE WITH
    </div>

    <div class="social-buttons">
      <button class="social">Google</button>
      <button class="social">GitHub</button>
    </div>
-->
    <p class="signup">
     Allready have an account?
      <a href="{{route('login')}}">Sign in</a>
    </p>

  </div>

  <script>
    function togglePassword() {
      const password = document.getElementByclass("password");
      const button = document.querySelector(".toggle");

      if (password.type === "password") {
        password.type = "text";
        button.textContent = "HIDE";
      } else {
        password.type = "password";
        button.textContent = "SHOW";
      }
    }

  
  </script>

  @endsection

