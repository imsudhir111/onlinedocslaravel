@extends('frontend.layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>
    <div class="container servicesSection">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                <h3 class="heading">COUNSELLORS</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-golden">
        <div class="container counsellors">
            <div class="row mt-5 pt-5 pb-5">
                @foreach ($counsellers as $list)
                <div class="col-md-4 mb-4">
                    <div class="bg-white">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{url('/upload/profile_image/'.$list->photo)}}" class="img-fluid img-thumbnail">
                            </div>
                            <div class="col-md-8">
                                <div class="single-counsellor">
                                    <h3>Psychiatrists</h3>
                                    <p>{{$list->experience}} Years of Experience</p>
                                    <p>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row single-counsellor-bottom">
                            <div class="col-md-12">
                                <div class="p-4">
                                    <h5 class="text-deepblue">Dr {{$list->name}}</h5>
                                    <p class="qual">{{$list->highest_education}} </p>
                                    <p class="text-justify"> orem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. Lorem ipsum. </p>

                                    <a href="" class="btn btn-deepBlue float-end mb-4">View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               
                
            </div>
            
        </div>
    </div>
@endsection
