
@extends('components.layout.login')
@section('title','Login Sign Up')
@section('content')

  <div class="main">

    <div class="login_signIn">

      <h1 class="mb-5">Forget Password</h1>

      <form action="{{route('forget-password')}}" method="post">
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

        <button class="login-btn" type="submit">
        Forget
        </button>

      </form>
          

    </div>

</div>

@endsection