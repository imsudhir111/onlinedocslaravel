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
            <div class="col-md-7  doc-background">
                <div class="doc-content">
                    <p class="text-right"> {{date("l")}}, {{date("d")}} {{date("M")}} {{date("Y")}}</p>
                    <img src="{{ asset('/frontend/images/Stethoscope.png')}}" class="img-fluid stethoscope">
                    <div class="bg-white p-3 rounded-2 border mb-5">
                        <div class="row">
                            <div class="col-md-10 offset-2"><h3>WELCOME Dr. {{Auth::guard('doctor')->user()->name}}</h3>
                        <p>Have a nice day!</p></div>
                        </div>
                    </div>
                    <div class="table-responsive bg-white p-3 mt-5 rounded-2 border">
                        <h4>Appointments</h4>
                        <table class="table table-hover">
                          
                            <tr class="bg-gray">
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Service</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($latest_four_appointment as $appointment)
                            <tr>
                              <td>{{$appointment->patient->name ? $appointment->patient->name : 'n/a'}}</td>
                              <td>{{$appointment->appointment_date ? $appointment->appointment_date : 'n/a'}}</td>
                              <td>{{$appointment->appointment_time ? $appointment->appointment_time : 'n/a'}}</td>
                              <td>{{$appointment->service_name ? $appointment->service_name : 'n/a'}}</td>
                              <td><a href="{{url('doctor/appointments/'.$appointment->patient_id.'/'.$appointment->appointment_date.'/patient-detail')}}" title="Details"><i class="fa fa-eye"></i></a></td>
                      
                          </tr>
                            @endforeach
                        </table>
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