@extends('backend.doctor.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
</div>
<form  role="form" id="create_doctor_profile_form" action="{{ route('profile.store') }}" method="POST"
enctype="multipart/form-data">
@csrf
    <div class="container-fluid bg-golden doctorEdit">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row mt-3 ">
                        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                            <h3 class="heading text-black text-uppercase">Edit Doctor Profile </h3>
                        </div>
                    </div>
                    <div class="row g-0 ">
                        <div class="col-md-1 offset-1">
                            <div class="bg-deepblue appointment-columns">
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-envelope-open"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-mobile-alt"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-calendar-alt"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div class="appointment-labels">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="bg-gray appointment-columns">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="Email">Email</label>
                                            <input id="email" class="form-control" type="text" readonly name="email" value="{{Auth::guard('doctor')->user()->email}}" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="full name">Name</label>
                                            <input id="full_name" class="form-control" type="text" 
                                            value="{{ old('full_name') }}"
                                            name="full_name" placeholder="Name">
                                            @error('full_name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone">Phone</label>
                                            <input id="phone" class="form-control" type="text"
                                            value="{{ old('phone') }}"
                                            name="phone" placeholder="Phone">
                                            @error('phone')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img class="img-fluid user-photo" id="preview_profile_image" 
                                        src="{{asset('/frontend/images/user.png')}}">
                                        <input type="file" name="profile_image" class="form-control" id="profile_image"
                                        onchange="document.getElementById('preview_profile_image').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="Profile Image">
                                        @error('profile_image')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="">Gender</label>
                                            <select class="form-control" id="gender" placeholder="Gender" required
                                            name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="transgender">Other</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">DOB</label>
                                            <input id="dob" class="form-control" onChange="getage()" type="date" name="dob" placeholder="DOB" 
                                            value="{{ old('dob') }}">
                                            @error('dob')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">Age</label>
                                            <input type="text" class="form-control" id="age" readonly
                                            value="{{ old('age') }}"
                                            name="age" placeholder="Age">
                                        @error('age')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Address</label>
                                <textarea id="" class="form-control" type="text" name="address" value="{{ old('address') }}" id="address" placeholder="Address"></textarea>
                                            @error('address')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">State</label>
                                            <select class="form-control" name="state" id="state" onchange="city_filter_handler()">
                                                <option value="">--Choose--</option>
                                                @foreach ($states as $list)
                                                <option value="{{ $list->id }}">{{$list->state}}</option>
                                                @endforeach 
                                            </select>
                                            @error('state')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">City</label>
                                            <select class="form-control" name="city" id="city_list">
                                                <option value="">--Choose--</option>

                                            </select>
                                            @error('city')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">Highest Education</label>
                                            <select class="form-control" name="highest_education" id="highest_education">
                                                <option value="">--Choose--</option>
                                                <option value="Post Graduate Diploma in Community Based Rehabilitation">Post Graduate Diploma in Community Based Rehabilitation</option>
                                                <option value="Master of Science in Psychiatry">Master of Science in Psychiatry</option>

                                            </select>
                                        @error('highest_education')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">Professional Experience</label>
                                            <select class="form-control" id="professional_experience"
                                                    placeholder="Professional Experience" required
                                                    name="professional_experience">
                                                    <option value="">Select</option>
                                                    <?php  
                                                for ($i=1; $i <= 40; $i++) { 
                                                ?>
                                                    <option selected value="<?php echo $i; ?>"><?php echo $i . ' year (s)'; ?></option>
                                                    <?php 
                                                }
                                                ?>
                                                    <option value="40">40+ year (s)</option>
    
    
                                                </select>
                                                @error('professional_experience')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Working Days</label>
                                    <input type="checkbox" value="1" name="working_days['Monday']" id="monday">
                                    <label for="Monday">Monday</label>
                                    <input type="checkbox" value="1" name="working_days['Tuesday']" id="tuesday">
                                    <label for="tuesday">Tuesday</label>
                                    <input type="checkbox" value="1" name="working_days['Wednesday']"
                                        id="wednesday">
                                    <label for="wednesday">Wednesday</label>
                                    <input type="checkbox" value="1" name="working_days['Thursday']" id="thursday">
                                    <label for="thursday">Thursday</label>
                                    <input type="checkbox" value="1" name="working_days['Friday']" id="friday">
                                    <label for="friday">Friday</label>
                                    <input type="checkbox" value="1" name="working_days['Saturday']" id="saturday">
                                    <label for="saturday">Saturday</label>
                                    <input type="checkbox" value="1" name="working_days['Sunday']" id="sunday">
                                    <label for="sunday">Sunday</label>
                                    @error('working_days')
                                    <br> <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                 </div>
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Working Hours (Morning)</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">From</label>
                                                <input type="time" class="form-control" id="day_from_time"
                                                name="day_from_time" placeholder="From"> </textarea>
                                            @error('day_from_time')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">To</label>
                                                <input type="time" class="form-control" id="day_to_time" name="day_to_time" onchange="day_to_time_validation('day_from_time','day_to_time','day_to_time_validation')"
                                                        placeholder="To"> </textarea>
                                                    @error('day_to_time')
                                                        <span  class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                    <span id="day_to_time_validation" class="text-danger" role="alert">
                                                      
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Working Hours (Evening)</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">From</label>
                                                <input type="time" class="form-control" id="night_from_time"
                                                        name="night_from_time" placeholder="From"> </textarea>
                                                    @error('night_from_time')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">To</label>
                                                <input type="time" class="form-control" id="night_to_time" name="night_to_time" onchange="day_to_time_validation('night_from_time','night_to_time','evening_to_time_validation')"
                                                        placeholder="To"> </textarea>
                                                    @error('night_to_time')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                    <span id="evening_to_time_validation" 
                                                    class="text-danger" role="alert">
                                                      
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5 g-0">
                        <div class="col-md-9 text-right mt-2"></div>
                        <div class="col-md-2 text-right"><button type="submit" class="btn btn-deepBlue">Submit</button></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</form>
 
@endsection
@section('script')
@endsection
