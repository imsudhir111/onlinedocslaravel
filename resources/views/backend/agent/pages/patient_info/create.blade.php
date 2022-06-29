@extends('backend.agent.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary" >
                        <div class="card-header">
                            <h3 class="card-title">Add Patient</h3>
                            <a href="{{route('patient.index')}}" class="btn-sm btn-primary" style="float: right; position: absolute;right: 14px;margin: 0 auto;top: 8px;">
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form role="form" id="serviceForm" action="{{ route('patient.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                            <div class="card-body pb-0" id="wrapx">
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label for="question"  >Full Nmae </label>
                                             <input type="text"  class="form-control" id="question"
                                                name="full_name" placeholder="Full Name"
                                                value="{{old('full_name')}}">
                                            @error('full_name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                     </div>
                                     <div class="col-lg-6 form-group">
                                        <label for="question"  >Email </label>
                                             <input type="text"  class="form-control" id="question"
                                                name="email" placeholder="Email"
                                                value="{{old('email')}}">
                                                @error('email')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                     </div>
                                </div>
                                <div class="row">
                                        
                                    <div class="col-lg-6 form-group">
                                        <label for="Phone">Phone </label>
                                             <input type="text"  class="form-control" id="phone"
                                                name="phone" placeholder="Phone"
                                                value="{{old('phone')}}">
                                                @error('phone')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                     </div>
                                     <div class="col-lg-6 form-group">
                                        <label for="Phone">Billing Address </label>
                                             <input type="text"  class="form-control" id="address"
                                                name="address" placeholder="Billing Address"
                                                value="{{old('address')}}">
                                                @error('address')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                     </div>
                                </div>
                                <div class="row" >
                                    <div class="col-lg-4 form-group">
                                        <label for="State">State </label>
                                             <input type="text"  class="form-control" id="address"
                                                name="state" placeholder="State"
                                                value="{{old('state')}}">
                                                @error('state')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                     </div>  <div class="col-lg-4 form-group">
                                        <label for="city">City </label>
                                             <input type="text"  class="form-control" id="address"
                                                name="city" placeholder="City"
                                                value="{{old('city')}}">
                                                @error('city')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                     </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="Pincode">Pincode </label>
                                             <input type="text"  class="form-control" id="pincode"
                                                name="pincode" placeholder="pincode"
                                                value="{{old('pincode')}}">
                                                @error('pincode')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                     </div>
                                    </div>
                                    <div class="card-footer" style="padding: 0.75rem 0rem;">
                                        <button type="submit" id="add_question_option" class="btn btn-primary">Save & send pay ment link to patient</button>
                                    </div>
                            </div>
                            <!-- /.card-body -->
                            
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
@endsection
