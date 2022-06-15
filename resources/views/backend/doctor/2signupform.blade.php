@extends('layouts.doctor-app')

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
          <hr>
      </div>
  </div>
</div>
<form method="POST" action="{{ route('doctor.signup_process') }}">
  @csrf
<div class="input-group mb-3">
  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="Email" autocomplete="email" autofocus>
  @error('email')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-envelope"></span>
    </div>
  </div>
</div>
<div class="input-group mb-3">
  <input id="password" type="password" class="form-control " name="password"  placeholder="Password" autocomplete="current-password">
  @error('password')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-lock"></span>
    </div>
  </div>
</div>
<div class="input-group mb-3">
  <input id="confirm_password" type="password" class="form-control " name="password_confirmation"  placeholder="confirm password" autocomplete="current-password">
  @error('password')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-lock"></span>
    </div>
  </div>
  @error('password')
  <span class="text-danger" role="alert">
      {{ $message }}
  </span>
@enderror
</div>

<div class="row">
  <div class="col-12 mb-2">
    <button type="submit" class="btn btn-primary btn-block">SIGNUP</button>
  </div>
</div>
</form>

@endsection
