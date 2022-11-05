<div class="bg-white doc-profile">
    <div class="row">
        <div class="col-md-12"> 
            <img class="img-fluid" src="{{ asset('/upload/profile_image/'.Auth::guard('doctor')->user()->photo)}}">            
            <p>Dr. {{Auth::guard('doctor')->user()->name}}</p>
            <p class="qualification"><span>{{Auth::guard('doctor')->user()->highest_education}}
              </span></p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="border rounded p-2">
                <p>Total Appointments</p>
                <h5> 
                    @php
                    $id = Auth::guard('doctor')->user()->id;
                    $doctor_all_appointment = \App\Models\Appointment:: 
                     where('doctor_id',$id)
                    ->count();
                    @endphp
                    {{$doctor_all_appointment}}
                </h5>
            </div>
        </div>
    </div>
   
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="border rounded p-2">
                <p>Upcoming Appointments</p>
                <h5><h5> 
                    @php
                    $id = Auth::guard('doctor')->user()->id;
                    $doctor_all_upcoming_appointment = \App\Models\Appointment:: 
                     where('doctor_id',$id)
                     ->where('appointment_date','>=',date("Y-m-d"))
                     ->count();
                    @endphp
                    {{$doctor_all_upcoming_appointment}}
                </h5></h5>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
           <a href="{{route('doctor.update_profile',$id)}}"><button type="button" class="btn btn-deepBlue">Edit Profile</button></a>
           {{-- <a href="{{ route('profile.edit',Auth::guard('doctor')->user()->id) }}"><button type="button" class="btn btn-deepBlue">Edit Profile</button></a> --}}
        </div>
    </div>
</div>