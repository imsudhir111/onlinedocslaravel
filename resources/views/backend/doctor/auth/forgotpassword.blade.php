@extends('layouts.doctor-app')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>
    <form action="changePassword.php" method="post">
        <div class="container-fluid bg-golden forgotPassword ">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row mt-3 ">
                            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                                <h3 class="heading text-black text-uppercase">Forgot Password</h3>
                            </div>
                        </div>
                        <div class="row g-0 shadowRow">
                            <div class="col-md-1 offset-3">
                                <div class="bg-deepblue appointment-columns">
                                    <div class="appointment-labels">
                                        <i class="fa-solid fa-envelope-open"></i>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="bg-gray appointment-columns">                                    
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input id="" class="form-control" type="text" name="" placeholder="Email">
                                    </div>
                                                                   
                                                                      
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mt-5 mb-5 g-0">
                            <div class="col-md-4 offset-3 text-right mt-2"></div>
                            <div class="col-md-2 text-right"><button type="submit" class="btn btn-deepBlue">Login</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </form>
@endsection
