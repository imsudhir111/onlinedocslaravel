@extends('frontend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
</div>
<div class="container servicesSection">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8 mt-3">
            <h3 class="heading text-deepblue">COUNSELORS</h3>
        </div>
    </div>
</div>
<div class="container-fluid bg-golden">
    <div class="container counsellors">
        <div class="row mt-5 pt-5 pb-5">
            <div class="col-md-12">
                <div class="bg-white p-5">
                    <div class="row g-0">
                        <div class="col-md-3"> 
                            {{-- {{die()}} --}}
                            <img src="{{url('/upload/profile_image/'.$doctor_info[0]->photo)}}" class="img-fluid img-thumbnail rounded">
                        </div>
                        <div class="col-md-9">
                            <div class="ps-5 counselorDetail">
                                <h1 class="text-deepblue">Dr {{$doctor_info[0]->name}}</h1>
                                <h3 class="qual"><span class="qual">{{$doctor_info[0]->highest_education}}  </span></h3>
                                <p class="font-12">Lucknow, UP</p>
                                <p class="font-12">{{$doctor_info[0]->experience}} Years of Experience</p>
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </p>

                                <h3 class="cDetailHeading">About</h3>
                                <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </p>
                                <h3 class="cDetailHeading">Working Hours</h3>
                                <table class="table">
                                    {{-- @foreach ($doctor_working_hours as $time)
                                    <tr>
                                        <th>{{$time->day}}</th>
                                        <td>10:00 AM - 12:00 PM</td>
                                        <td>03:00 PM - 05:00 PM</td>
                                    </tr>
                                    @endforeach
                                     --}}

                                    @foreach (json_decode($doctor_info[0]->working_days) as $key => $doctor_availabity) 
                                    <tr>
                                        <th>{{$key}} 
                                        </th>
                                        {{-- <td>{{$doctor_availabity ==1 ? '10:00 AM - 12:00 PM' :'--' }} </td> --}}
                                        @if ($doctor_availabity==1)
                                        @foreach ($doctor_working_hours as $time)
                                        {{$time}}

                                        <td>{{$time->fromTime}} AM - {{$time->toTime}} AM</td>
                                        {{-- <td>03:00 PM - 05:00 PM</td> --}}
                                        @endforeach
                                        @endif
                                        @if ($doctor_availabity==0)
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        {{-- <td>03:00 PM - 05:00 PM</td> --}}
                                        @endif
                                    </tr>
                                         
                                    @endforeach

 
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
