@extends('backend.doctor.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Information</h3>
                                <a href="{{ route('profile.edit',$profile_info->id) }}" class="btn-sm btn btn-primary" 
                                style="position: absolute;
                                right: 14px;
                                margin: 0 auto;
                                top:8px;
                                ">  <i class="fas fa-edit"></i>&nbsp; </a>      
                                  </h3>
                            </div>
                            <!-- /.card-header  -->
                            <!-- form start -->
                            <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-12 form-group">
                                        <label for="full name">Name:</label>
                                        {{$profile_info->name}}
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="Email">Email:</label>
                                        {{$profile_info->email}}
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="Phone">Phone:</label>
                                        {{$profile_info->mobile}}
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="Age">Age:</label>
                                        {{$profile_info->age}}
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="gender">Gender:</label> 
                                        {{$profile_info->gender}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-6 form-group">
                                            <img class="img-circle" style="margin:0 auto;" height="200" width="200" src="{{ !empty($profile_info->photo) ? url('upload/profile_image/' . $profile_info->photo) : url('upload/profile_image/no_image.jpg') }}" alt="profile"> 
                                        </div>
                                    </div>
                                </div>
                        </div>
<hr>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="Address">Address:</label>
                                    {{$profile_info->address}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="State">State:</label>
                                    {{$profile_info['state'][0]->state}}
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="City">City:</label>
                                    {{$profile_info['city'][0]->name}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <hr><label for="Highest Education">Highest Education:</label>
                                    {{$profile_info->highest_education}}
                                </div>
                                <div class="col-12 form-group">
                                    <label for="Professional Experience">Professional Experience:</label> 
                                    {{$profile_info->experience.' Years'}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label for="Working Days">Workinga Days:</label> 
                                    {{-- {{print_r(json_decode($profile_info->working_days))}} --}}
                                    @foreach (json_decode($profile_info->working_days) as $key=>$working_day)
                                         {{$working_day ==='1' ? $key : '' }}
                                    @endforeach
                                </div>
                                <div class="col-lg-12 form-group">
                                    <hr><label for="Working Hours">Working Hours:</label> 
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="From">From (Day Shift):</label>
                                         {{$profile_info->day_from_time}}
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="To">To (Day Shift):</label>
                                        {{$profile_info->day_to_time}}
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="From">From (Night Shift):</label>
                                         {{$profile_info->night_from_time}}
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="To">To (Night Shift):</label>
                                        {{$profile_info->night_to_time}}
                                        </div>
                                    </div>
                                      
                                </div>
                            </div>
                        </div>
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
