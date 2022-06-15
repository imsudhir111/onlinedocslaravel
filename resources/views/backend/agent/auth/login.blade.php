@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="#"><b>ONLINE</b>DOCS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Agent {{ __('Login') }}</p>

        <form method="POST" action="{{ route('agent.auth') }}">
            @csrf
          <div class="input-group">
            <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}"  placeholder="Email"   autocomplete="email" autofocus>
       
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
            <input id="password" type="password" class="form-control " name="password"  placeholder="Password"   autocomplete="current-password">
           
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          @error('password')
          <span  class="text-danger" role="alert">
               {{ $message }} 
          </span>
       @enderror
       @if('message')
        <span  class="text-danger" role="alert">
          {{session('message')}}
        </span>
        @endif
          <div class="row pt-3">
        
            <div class="col-12 mb-2">
              <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
           
            </div>
            
          </div>
        </form>
 

       
      </div>
      <!-- /.login-card-body -->
    </div>
</div>
@endsection
