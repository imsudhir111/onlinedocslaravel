@extends('backend.doctor.layouts.app')
@section('content')
<div class="container-fluid bg-golden pb-5">
    <div class="row p-4 ">
        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
            <h3 class="heading text-black text-uppercase"> PATIENT'S DETAILS </h3>
        </div>
    </div>

    <div class="container box-Shadow g-0">
        <div class="row mb-5 g-0">
            <div class="col-md">
                <div class="bg-deepblue doctor-menu">
                    @include('backend.doctor.layouts.sub_layouts.sidebar')

                </div>
            </div>
            <div class="col-md-7  doc-background">
                <div class="doc-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>PATIENT'S DETAILS</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">{{date("l")}}, {{date("d")}} {{date("M")}} {{date("Y")}}</p>

                        </div>
                    </div>

{{-- {{dd($patient_detail)}} --}}
                    <div class="bg-white p-2 rounded-2 border mb-5">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-1"><i class="fa fa-clock text-golden"></i></div>
                                <div class="col-md-6">
                                    <p class="text-2x"><b>Appointment Date: </b>{{date("d M, Y", strtotime(request()->route()->parameters['date']))}}<br>
                                        <b>Appointment Start Time: </b> 
                                        {{date('h:i A', strtotime($patient_detail[0]->appointment_time))}}
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <p class="text-2x"><b>Appointment Slot: </b>
                                        {{date('h:i A', strtotime($patient_detail[0]->appointment_time))}}-{{date('h:i A',strtotime('+1 hour',strtotime($patient_detail[0]->appointment_time)))}}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class=" bg-white p-3 mt-5 rounded-2 border">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3"> 
                                        {{-- @if (isset($patient_detail[0]->patient->photo))
                                            @if (explode(".",$patient_detail[0]->patient->photo)[1]=='pdf')
                                            @else
                                            <img class="img-fluid border rounded" src="{{ asset('/upload/profile_image/'.$patient_detail[0]->patient->photo)}}" >
                                            @endif
                                        @endif --}}
                                        
                                        @isset($patient_detail[0]->patient->photo)
                                            @if (explode(".",$patient_detail[0]->patient->photo)[1]=='pdf')
                                            @else
                                            <img class="img-fluid border rounded" src="{{ asset('/upload/profile_image/'.$patient_detail[0]->patient->photo)}}" >
                                            @endif
                                        @endisset
                                        
                                        @if (!isset($patient_detail[0]->patient->photo))
                                        <img class="img-fluid border rounded" src="{{ asset('/upload/profile_image/no_image.png')}}" >
                                        @endif
                                        
                                        </div>
                                    <div class="col-md-9">
                                        <div class="text-2x">
                                            <b>Patient’s Name :</b>{{$patient_detail[0]->patient->name}}
                                            <br>
                                            <b>Gender : </b> Male <b>Age :</b> {{$patient_detail[0]->patient->age}} Years <br>
                                            <b>Health Issue :</b> {{$patient_detail[0]->service_name}} <br>
                                            <b>Phone :</b> {{$patient_detail[0]->patient->mobile}} <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-2x ">
                                            <b>Email : </b>{{$patient_detail[0]->patient->email}} <br>
                                            <b>Address : </b> {{$patient_detail[0]->patient->address}} 
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="mt-3 mb-0">Doctor Remarks</p>
                                        <div class="border rounded p-2">
                                           <form id="doctor_save_remark_form" > 
                                            @csrf
                                                <textarea name="doctor_remark" class="form-control" placeholder="Enter your Remarks here"></textarea>
                                                @error('doctor_remark')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <button id="doctor_save_remark_btn" type="submit" class="mt-1 btn btn-sm btn-primary">Save</button>
                                           
                                            </form>
                                            <p class="text-2x">{{$patient_detail[0]->doctor_remark ? $patient_detail[0]->doctor_remark : 'No remark yet'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p>Patient’s Medical History Record</p>
                                @isset($patient_detail[0]->patient->photo)
                                @if (explode(".",$patient_detail[0]->patient->photo)[1]=='pdf')
                                <iframe src="{{ asset('/upload/patient_record/record1.pdf')}}" height="200" width="180"></iframe>
                                <div class="btn-group mt-2" style="display: flex" role="group">
                                    <a class="btn btn-sm btn-secondary" href="{{ asset('/upload/patient_record/record1.pdf')}}" download=""><i class="fa fa-download"></i></a>
                                    <a class="btn btn-sm btn-deepBlue active" target="_blank" href="{{ asset('/upload/patient_record/record1.pdf')}}"><i class="fa fa-eye"></i></a>
                                 </div>
                                @else
                                <hr> 
                                <p> No document available yet.</p>
                               
                                @endif
                                @endisset

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md">
                @include('backend.doctor.pages.profile')
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        all_appointments_ajax();
        $('#doctor_save_remark_form').submit(function(e){
        e.preventDefault();
        var id="{{$patient_detail[0]->appointment_id}}";
        console.log(id);
        doctor_save_remark(id);
        })
});
</script>
@endsection
@section('script')
@endsection