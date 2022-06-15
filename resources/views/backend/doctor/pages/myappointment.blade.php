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
                    <div class=" bg-white p-3 rounded-2 border">
                        <div id="tabs">
                            <h4 class="text-center">Upcoming Appointment</h4>
                            <ul>
                                <li><a href="#tabs-1">{{date('j F, Y', strtotime(date("Y-m-d")))}}</a></li>
                                <li><a href="#tabs-2">{{date('j F, Y', strtotime(date("Y-m-d", strtotime("+1 day"))))}}</a></li>
                                <li><a href="#tabs-3">{{date('j F, Y', strtotime(date("Y-m-d", strtotime("+2 day"))))}}</a></li>
                                
                            </ul>
                            <div id="tabs-1">

                                <div class="row">
                                    @foreach ($myappointment['current_date'] as $appointment)
                                    <div class="col-md-4">
                                        <div class="singleSlot">{{($appointment->appointment_time) .'-'.(date('H:i:s',strtotime('+1 hour',strtotime($appointment->appointment_time))))}}</div>
                                    </div> 
                                    @endforeach
                                     {{count($myappointment['current_date']) >0 ? '' : 'No Appointment Yet'}}
                                </div>
                                {{-- <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="singleSlot">10:00:00-11:00:00</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="singleSlot">10:00:00-11:00:00</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="singleSlot">10:00:00-11:00:00</div>
                                    </div>
                                </div> --}}
                            </div>
                            <div id="tabs-2">
                                @foreach ($myappointment['current_date_plus1'] as $appointment)
                                <div class="col-md-4">
                                    <div class="singleSlot">{{($appointment->appointment_time) .'-'.(date('H:i:s',strtotime('+1 hour',strtotime($appointment->appointment_time))))}}</div>
                                </div> 
                                @endforeach
                                {{count($myappointment['current_date_plus1']) >0 ? '' : 'No Appointment Yet'}}
                            </div>
                            <div id="tabs-3">
                                @foreach ($myappointment['current_date_plus2'] as $appointment)
                                <div class="col-md-4">
                                    <div class="singleSlot">{{($appointment->appointment_time) .'-'.(date('H:i:s',strtotime('+1 hour',strtotime($appointment->appointment_time))))}}</div>
                                </div> 
                                @endforeach
                                {{count($myappointment['current_date_plus2']) >0 ? '' : 'No Appointment Yet'}}
                                
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
@endsection
@section('script')
@endsection