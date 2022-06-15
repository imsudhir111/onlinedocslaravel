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
                        <div class="col-md-6"><h4>My Appointments</h4></div>
                        <div class="col-md-6"><p class="text-right">{{date("l")}}, {{date("d")}} {{date("M")}} {{date("Y")}}</p></div>
                    </div>
                    <div class="table-responsive bg-white p-3 mt-5 rounded-2 border">
                        <h4>Appointments <small>as on {{date("d-m-Y", strtotime(request()->route()->parameters['id']))}}</small></h4>
                        <table class="table table-hover">
                            @if (!count($datewise_appointment)==0)

                            <tr class="bg-gray">
                                <th>Name</th>                                  
                                <th>Time</th>
                                <th>Service</th>
                                <th>Details</th>
                            </tr>
                            @else
                            <hr>
                            <p>No appointment available</p>
                            @endif
                            
                            @if (!count($datewise_appointment)==0)
                                @foreach ($datewise_appointment as $appointment_details)
                                <tr>
                                <td>{{$appointment_details->patient->name}}</td>                                  
                                <td>{{$appointment_details->appointment_date}}</td>    
                                <td>{{$appointment_details->service_name}}</td>    
                                                            
                                <td><a href="{{url('doctor/appointments/'.$appointment_details->patient_id.'/'.$appointment_details->appointment_date.'/patient-detail')}}" title="Details"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                @endforeach
                            
                            @endif
    
                          
                             
                            {{-- <tr>
                                <td>Ramesh</td>                                  
                                <td>10:00 AM</td>
                                <td><span class="badge bg-success rounded-circle"><i class="fa fa-check" aria-hidden="true"></i></span></td>
                                <td><a href="#" title="Details"><i class="fa fa-eye"></i></a></td>
                            </tr> --}}

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