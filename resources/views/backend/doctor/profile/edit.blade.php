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
                                <h3 class="card-title">Update Profile</h3>
                            </div>
                            <!-- /.card-header  -->
                            <!-- form start -->

                            <form role="form" id="serviceForm" action="{{ route('profile.update',$profile_info->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="col-lg-12 form-group">
                                                <label for="full name">Name</label>
                                                <input type="text" name="full_name" value="{{$profile_info->name}}" class="form-control" id="full_name"
                                                    placeholder="Full Name">
                                                @error('full_name')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label for="full name">Photo</label>
                                                <input type="file" name="profile_image" class="form-control p-1" id="profile_image"
                                                onchange="document.getElementById('preview_profile_image').src = window.URL.createObjectURL(this.files[0])"
                                                placeholder="Profile Image">
                                                @error('full_name')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" id="gender" placeholder="Gender" required
                                                    name="gender">
                                                    <option {{$profile_info->gender == 'male' ? 'selected':''}} value="male">Male</option>                                                        
                                                    <option  {{$profile_info->gender == 'female' ? 'selected':''}} value="female">Female</option>
                                                    <option  {{$profile_info->gender == 'transgender' ? 'selected':''}} value="transgender">Transgender</option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="col-lg-6 pt-3">
                                            <div class="row">
                                                    <img id="preview_profile_image" class="img-circle" style="margin:0 auto;" height="200" width="200" 
                                                    src="{{ !empty($profile_info->photo) ? url('upload/profile_image/' . $profile_info->photo) : url('upload/service_icon/no_image.png') }}">
                                            </div>
                                        </div> 
                                    </div>
 <hr>
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <label for="Age">Age</label>
                                            <input type="text" class="form-control" id="age" value="{{$profile_info->age}}" name="age" placeholder="Age"
                                                value="{{ old('age') }}">
                                            @error('age')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-4 form-group">
                                            <label for="Phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" value="{{$profile_info->mobile}}" name="phone"
                                                placeholder="Phone"></textarea>
                                            @error('phone')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label for="Address">Address</label>
                                            <input type="text" class="form-control" id="address" value="{{$profile_info->address}}" name="address"
                                                placeholder="Addresss"></textarea>
                                            @error('address')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="row">
                                             
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                <label for="p_address">State*</label>
                                                <select class="form-control" name="state" id="state" onchange="city_filter_handler()">
                                                  <option value="">select state</option>
                          
                                                  @foreach ($states as $list)
                                                  <option {{$profile_info->state_id == $list->id ? 'selected':''}} value="{{$list->id}}">{{$list->state}}</option>
                                                  @endforeach 
                                                </select>
                                                {{-- <input type="text" name="city" class="form-control" id="city" placeholder="City"> --}}
                                                @error('city')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                                </div>
                                              
                                          </div>
                                          <div class="col-xl-6">
                                                  <div class="form-group">
                                                    <label for="p_address" >City*</label>
                                                    <select class="form-control" name="city" id="city_list">
                                                    @foreach ($city as $list)
                                                  <option  {{$profile_info->city_id ==$list->id ? 'selected':'no' }} value="{{$list->id}}">{{$list->name}}</option>
                                                  @endforeach 
                                                    </select>
                                                     @error('city')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                  @enderror
                                                  </div>
                                               </div>
                                              
                                         
                                      
                                        <div class="col-lg-6 form-group">
                                            <label for="Highest Education">Highest Education</label>
                                            <input type="text" class="form-control"
                                            value="{{$profile_info->highest_education}}" id="highest_education"
                                                name="highest_education" placeholder="Highest Education"></textarea>
                                            @error('highest_education')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-lg-6 form-group">
                                            <label for="Professional Experience">Professional Experience</label>
                                            <select class="form-control" id="professional_experience"
                                                placeholder="Professional Experience"
                                                required
                                                name="professional_experience">
                                                <option value="">Select</option>
                                                <?php  
                                            for ($i=1; $i <= 40; $i++) { 
                                            ?>
                                                <option  {{$profile_info->experience == $i ? 'selected':''}} value="<?php echo $i; ?>"><?php echo $i . ' year'; ?></option>
                                                <?php 
                                            }
                                            ?>
                                                <option value="40">40+ year</option>


                                            </select>
                                            @error('professional_experience')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label for="Working Days">Working Days</label><br>
                                            @foreach (json_decode($profile_info->working_days) as $key=>$working_day)
                                            <div class="form-group ss_form-group">
                                                <input type="checkbox" {{$working_day === '1' ? 'checked':'s'}} value="1" name="working_days[{{$key}}]" id="{{$key}}">
                                                <label for="{{$key}}">{{$key}}</label>
                                            </div>
                                            @endforeach
                                            {{-- {{json_decode($profile_info->working_days)->Monday}}
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Monday === '1' ? 'checked':'s'}} value="1" name="working_days['Monday']" id="monday">
                                            <label for="Monday">Monday</label>
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Tuesday === '1' ? 'checked':''}} value="1" name="working_days['Tuesday']" id="tuesday">
                                            <label for="tuesday">Tuesday</label>
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Wednesday === '1' ? 'checked':''}} value="1" name="working_days['Wednesday']"
                                                id="wednesday">
                                            <label for="wednesday">Wednesday</label>
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Thursday === '1' ? 'checked':''}} value="1" name="working_days['Thursday']" id="thursday">
                                            <label for="thursday">Thursday</label>
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Friday === '1' ? 'checked':''}} value="1" name="working_days['Friday']" id="friday">
                                            <label for="friday">Friday</label>
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Saturday === '1' ? 'checked':''}} value="1" name="working_days['Saturday']" id="saturday">
                                            <label for="saturday">Saturday</label>
                                            <input type="checkbox" {{json_decode($profile_info->working_days)->Sunday === '1' ? 'checked':''}} value="1" name="working_days['Sunday']" id="sunday">
                                            <label for="sunday">Sunday</label> --}}
                                            @error('working_days')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label for="Working Hours">Working Hours</label><br><hr>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="From">From (Day Shift)</label>
                                                    <input type="time" class="form-control" id="working_hours"
                                                        name="day_from_time" value="{{$profile_info->day_from_time}}" placeholder="From"> </textarea>
                                                    @error('day_from_time')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="To">To (Day Shift)</label>
                                                    <input type="time" class="form-control" id="day_to_time" value="{{$profile_info->day_to_time}}" name="day_to_time"
                                                        placeholder="To"> </textarea>
                                                    @error('day_to_time')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-lg-6">
                                                    <label for="From">From (Night Shift)</label>
                                                    <input type="time" class="form-control" id="night_from_time"  value="{{$profile_info->night_from_time}}"
                                                        name="night_from_time" placeholder="From"> </textarea>
                                                    @error('night_from_time')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="To">To (Night Shift)</label>
                                                    <input type="time" class="form-control" id="night_to_time" 
                                                           name="night_to_time"  value="{{$profile_info->night_to_time}}"
                                                        placeholder="To"> </textarea>
                                                    @error('night_to_time')
                                                        <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
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
