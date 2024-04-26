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
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <form method="post" action="{{ route('user.register') }}" class="mx-1 mx-md-4">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-5">
                                        <label for="You name">
                                            <i class="fas fa-user fa-lg fa-fw"></i>
                                        </label>
                                        <div class="form-outline flex-fill ">
                                            <input type="text" id="form3Example1c" class="form-control1" name="name" placeholder="Your name" value="{{ old('name') }}" />
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-5">
                                        <label for="your email">
                                            <i class="fas fa-envelope fa-lg  fa-fw "></i>
                                        </label>
                                        <div class="form-outline flex-fill ">
                                            <input type="email" id="form3Example3c" class="form-control1" placeholder=" Your Email" name="email" value="{{ old('email') }}" />
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-5">
                                        <label for="password">
                                            <i class="fas fa-lock fa-lg fa-fw "></i>
                                        </label>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4c" name="password" placeholder="Password" class="form-control1" />
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term">
                                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                                    </div>

                                    <div class="form-group form-button">
                                        <input type="submit" name="signup" id="signup" class="btn btn-primary btn-lg" value="Register">
                                    </div>
                                </form>
                            </div>
                            <div class="w-8/12 lg:w-1/2 col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img alt="Image d'un événement Meetup en personne" width="600" height="300" decoding="async" data-nimg="1" style="color: transparent;" srcset="https://img.freepik.com/vecteurs-libre/main-tenant-smartphones-journal-ligne-newsletter-blog_74855-20591.jpg?t=st=1714024951~exp=1714028551~hmac=550fa43be68e4a2937eaace4b02b3268d928e1f51b1e7a68dbcc28c2f390f146&w=1380" src="https://img.freepik.com/vecteurs-libre/main-tenant-smartphones-journal-ligne-newsletter-blog_74855-20591.jpg?t=st=1714024951~exp=1714028551~hmac=550fa43be68e4a2937eaace4b02b3268d928e1f51b1e7a68dbcc28c2f390f146&w=1380">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection