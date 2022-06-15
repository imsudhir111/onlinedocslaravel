@extends('layouts.doctor-app')

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
          <hr>
      </div>
  </div>
</div>
<form method="POST" id="doctor_signup_form_validation" action="{{ route('doctor.signup_process') }}">
  @csrf
  <div class="container-fluid bg-golden">
      <div class="row">
          <div class="col-md-12">
              <div class="container">
                  <div class="row mt-3 ">
                      <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                          <h3 class="heading text-black text-uppercase">Doctor Sign up</h3>
                      </div>
                  </div>
                  <div class="row g-0 symptoms">
                      <div class="col-md-1 offset-3">
                          <div class="bg-deepblue appointment-columns">
                              <div class="appointment-labels">
                                  <i class="fa-solid fa-envelope-open"></i>
                              </div>
                              <div class="appointment-labels">
                                  <i class="fa-solid fa-lock"></i>
                              </div>
                              <div class="appointment-labels">
                                  <i class="fa-solid fa-lock"></i>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-5">
                          <div class="bg-gray appointment-columns">

                              
                              <div class="form-group mb-3">
                                  <label for="">Email</label>
                                  <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                  value="{{old('email')}}"
                                  placeholder="Email">
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              </div>
                              <div class="form-group mb-3">
                                  <label for="">Password</label>
                                  <input id="" class="form-control @error('password') is-invalid @enderror" type="password" name="password" 
                                  value="{{old('password')}}"
                                  placeholder="Password">
                                  @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              </div>
                              <div class="form-group mb-3">
                                  <label for="">Confirm Password</label>
                                  <input id="" name="password_confirmation" class="form-control @error('password') is-invalid @enderror"
                                  type="password" 
                                  name="password_confirmation"
                                  value="{{old('password_confirmation')}}"
                                  placeholder="Confirm Password">
                                  @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              </div>
                          </div>
                      </div>

                  </div>
                  <div class="row mt-5 mb-5 g-0">
                      <div class="col-md-4 offset-3 text-right mt-2">
                        <input type="checkbox" class="@error('password') is-invalid @enderror" name="tnc" value="1"> I Agree to the Terms and Conditions
                        @error('tnc')
                        <span class="invalid-feedback" role="alert">
                            <strong>This field is required.
                            </strong>
                        </span>
                    @enderror
                      </div>
                      <div class="col-md-2 text-right"><button type="submit" class="btn btn-deepBlue">Register</button></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">

      </div>
  </div>
</form>
@endsection
