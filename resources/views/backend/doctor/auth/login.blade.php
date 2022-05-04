@extends('layouts.doctor-app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>ONLINE</b>DOCS</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Doctor {{ __('Login') }}</p>

                <form method="POST" action="{{ route('doctor.auth') }}">
                    @csrf
                    <div class="input-group">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="Email"   autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <div class="input-group pt-3">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    @if ('message')
                    <span class="text-danger" role="alert">
                    {{ session('message') }}
                    </span>
                   @endif
                    <div class="row pt-3">
                       
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>

                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> --}}
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <a href="{{ url('doctor/signup') }}">
                        Sign Up
                    </a>
                </p>
                {{-- <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> --}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
