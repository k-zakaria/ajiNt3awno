@extends('layouts.navbar')
@section('content')
<style>
    .form-control1 {
        width: 100%;
        display: block;
        border: none;
        border-bottom-width: medium;
        border-bottom-style: none;
        border-bottom-color: currentcolor;
        border-bottom: 1px solid #999;
        padding: 6px 15px;
        font-family: Poppins;
        box-sizing: border-box;
    }
</style>
<section class="vh-100 mt-5" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-start h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>
                                <form method="post" action="{{ route('user.login') }}" class="mx-1 mx-md-4" onsubmit="return validateFormLogin()">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center">
                                        <label for="your email">
                                            <i class="fas fa-envelope fa-lg  fa-fw mb-5"></i>
                                        </label>
                                        <div class="form-outline flex-fill mb-5">
                                            <input type="email" id="form3Example3c" class="form-control1" placeholder=" Your Email" name="email" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                            <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <label for="password">
                                            <i class="fas fa-lock fa-lg fa-fw "></i>
                                        </label>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4c" name="password" placeholder="Password" class="form-control1" />
                                            @if ($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <a href="{{ route('forget.password.get') }}">Reset Password</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-button">
                                        <input type="submit" name="signin" id="signin" class="btn btn-primary btn-lg" value="Log in">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://img.freepik.com/vecteurs-libre/fond-plat-pour-celebration-dia-del-periodista_23-2149525339.jpg?t=st=1713967241~exp=1713970841~hmac=ea56f75f9eac58385d1dc77524245c0a1f5b588ff4ae48361e9d058c2ad0a2bc&w=1380" class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function validateFormLogin() {

        var email = document.getElementById('form3Example3c').value;
        var password = document.getElementById('form3Example4c').value;


        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Invalid email format');
            return false;
        }

        if (password.trim() === '') {
            alert('Please enter a password');
            return false;
        }

        return true;
    }
</script>
@endsection