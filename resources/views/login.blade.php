
@extends('components.layout.login')
@section('title','Login Sign Up')
@section('content')
  <div class="login_signIn">

    <div class="logo"><i class="fa-solid fa-user-shield"></i></div>

    <h1>Welcome Back</h1>
    <p class="subtitle">Sign in to continue to your account</p>

    <form action="{{route('sign-In')}}" method="post">
@csrf
      <div class="input-group">
        <label for="email">EMAIL ADDRESS</label>

        <input
          id="email"
          type="email"
          name="email"
          class=" {{($errors->first('email')?'is-invalid':'')}}"

          placeholder="Enter your email"
          required
        >
        <span class="text-danger" id="name">@error('email'){{$message}} @enderror</span>

      </div>

      <div class="input-group">
        <label for="password">PASSWORD</label>

        <div class="input-box">

          <input
            id="password"
            type="password"
            class=" {{($errors->first('password')?'is-invalid':'')}}"
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

        <a href="#">Forgot password?</a>

      </div>

      <button class="login-btn" type="submit">
        SIGN IN
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

  @if ($errors->has('email'))
    <div class="error" id="error" style="display:flex; justify-content:end;">
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
    @endif

          <script>
            setTimeout(() => {
                const toast = document.getElementById('error');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>

@endsection