
@extends('components.layout.login')
@section('title','Login Sign Up')
@section('content')

  <div class="main">

    <div class="login_signIn">

      <div class="logo"><i class="fa-solid fa-user-shield"></i></div>

      <h1>Welcome Back</h1>
      <p class="subtitle">Sign in to continue to your account</p>

      <form action="{{route('sign-In')}}" method="post">
        @csrf
        <div class="group-input">
          <label for="email">EMAIL ADDRESS</label>

          <input
            id="email"
            type="email"
            name="email"
            class=" input {{($errors->first('email')?'is-invalid':'')}}"

            placeholder="Enter your email"
            required
          >
          <span class="text-danger" id="name">@error('email'){{$message}} @enderror</span>

        </div>

        <div class="group-input">
          <label for="password">PASSWORD</label>

          <div class="input-box">

            <input
              id="password"
              type="password"
              class=" input {{($errors->first('password')?'is-invalid':'')}}"
              name="password"
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

        <div class="options">

          <label class="remember">
            <input type="checkbox" class="form-checkbox" name="remember" id="remember">
            Remember me
          </label>

          <a href="{{route('forget')}}">Forgot password?</a>

        </div>

        <button class="login-btn" type="submit">
          SIGN IN
        </button>

      </form>
      <div class="divider">
        OR CONTINUE WITH
      </div>

      <div class="social-buttons">
        <!--Google login-->
        <a class="social text-center">
          <i class="fa-brands fa-google"></i>
          Google
        </a>
        <!--github login-->
        <a href="{{route('github.login')}}"class="social text-center">
          <i class="fa-brands fa-github"></i> 
          GitHub
        </a>
      </div>
      <p class="signup">
        Don't have an account?
        <a href="{{route('signUP')}}">Create Account</a>
      </p>

    </div>

    <script>
      function togglePassword() {
        const password = document.getElementById("password");
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

  </div>

@endsection