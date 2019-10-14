@extends('master')
@section('title','Movie-La - เข้าสู่ระบบ')
@section('header')
<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
<style>
    html,body{
        font-family: 'Kanit', sans-serif !important;
        background: #8e2de2 !important; 
        background: -webkit-linear-gradient(to right, #8e2de2, #4a00e0) !important;
        background: linear-gradient(to right, #8e2de2, #4a00e0) !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background:#ff3636 !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick-th.css') }}">

<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Fully-Responsive-Flexible-jQuery-Carousel-Plugin-slick/css/slick.css">
<link rel="stylesheet" href="https://www.jqueryscript.net/css/jquerysctipttop.css">
@endsection
@section('navbar')

@endsection
@section('body')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="box" style="background:rgba(255,255,255);padding:10%;border-radius:5px;">
                <center><h2>Login Panel</h2></center>
                <br><br>
                    <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
    
                                        <a class="btn btn-link" href="{{ url('') }}">
                                            Back To Home Page
                                        </a>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
        
    </div>
</div>
@endsection
