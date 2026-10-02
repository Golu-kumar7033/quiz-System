
@extends('components.layout.login')
@section('title','Login Sign Up')
@section('content')

<div class="main">

    <div class="login_signIn">

        <div class="logo">
          <i class="fa-solid fa-user-lock"></i> 
        </div>

        <h1 class="mb-3">Set New Password</h1>

        <form action="{{route('Set-newpassword')}}" method="post">

            @csrf
               


                <div class="input-box">

                <input
                    type="hidden"
                    class=" password input"
                    name="email"
                    value="{{$email}}"
                    required
                >
                </div>

            <div class="group-input">
                <label for="password">PASSWORD</label>

                <div class="input-box">

                <input
                    type="password"
                    class=" password input {{($errors->first('password')?'is-invalid':'')}}"
                    name="password"
                    placeholder="New password"
                    value="{{old('password')}}"
                    required
                >
                <span class="text-danger" id="name">@error('password'){{$message}} @enderror</span>
              
                </div>
            </div>

           <div class="group-input">
                <label for="password">COMFIRM PASSWORD</label>

                <div class="input-box">

                <input
                    type="password"
                    class=" password input {{($errors->first('Confirm_password')?'is-invalid':'')}}"
                    name="Confirm_password"
                    placeholder="Confirm password"
                    value="{{old('Confirm_password')}}"
                    required
                >
                <span class="text-danger" id="name">@error('Confirm_password'){{$message}} @enderror</span>
              
                </div>
            </div>

        <button class="login-btn" type="submit">
        Update Password
        </button>
         
        </form>

    </div>


</div>

@endsection