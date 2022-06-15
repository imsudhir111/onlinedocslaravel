@extends('backend.doctor.layouts.app')

@section('content')
<div class="container-fluid bg-golden pb-5">
    <div class="row p-4 ">
        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
            <h3 class="heading text-black text-uppercase"> Doctor Dashboard</h3>
        </div>
    </div>

    <div class="container box-Shadow g-0">
        <div class="row mb-5 g-0">
            <div class="col-md">
                <div class="bg-deepblue doctor-menu">
                     @include('backend.doctor.layouts.sub_layouts.sidebar')
                </div>
            </div>
            <div class="col-md-7 doc-background">
                    <div class="doc-content ">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Change Password</h4>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right">{{date("l")}}, {{date("d")}} {{date("M")}} {{date("Y")}}</p>
                            </div>
                        </div>


                        <div class=" bg-white p-3 rounded-2 border">
                            <form role="form" id="doctor_change_password_validation"  action="{{ route('doctor.change_doctor_password_update') }}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                    <div class="col-md-12">
                                            <div>
                                                <div class="form-group mb-3">
                                                    <label for="">New Password</label>
                                                    <input id="" class="form-control" type="password"  name="password" placeholder="Password">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Confirm Password</label>
                                                    <input id="" class="form-control" type="password"  name="password_confirmation" placeholder="Confirm Password">
                                                </div>
                                                @error('password')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                                <div class="form-group mb-3">
                                                    <div class="col-md-2 text-right"><button type="submit" class="btn btn-deepBlue">Update</button></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="row mt-5 mb-5 g-0">
                                        <div class="col-md-4 offset-3 text-right mt-2"></div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-md">
                @include('backend.doctor.pages.profile')
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection