@extends('frontend.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>

<div class="container-fluid pb-5 bg-golden ">
    <div class="container ">
        <div class="row pt-5 ">
            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                <h3 class="text-deepblue text-center">FREQUENTLY ASKED QUESTIONS</h3>
            </div>
        </div>
    </div>
    <div class="container  counsellors mt-4">
        <div class="row g-0 mb-5 box-Shadow blog-section ">
            <div class="col-md-9 blog-column bg-lightgray">
                <div class="bg-lightgray p-4">
                    <div id="accordion">
                        @foreach ($faq_list as $list)
                        <h3>{{$list->question}} </h3>
                        <div>
                            <p> {{$list->answer}} </p>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12 text-white bg-deepblue FAQ blog-sidebar">
                <div class="bg-deepblue ">
                    <div class="p-4 ">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="blog-heading-sidebar"><span>Treatments</span></div>
                            </div>
                        </div>
                        @foreach ($treatment as $treatment_list)
                        <div class="row  blog-archives mt-3 border-bottom-darkGrey">
                            <div class="col-md-12">
                                <a href="">
                                    <p><a href="{{url('service-detail/'.$treatment_list->id)}}"> {{$treatment_list->service_name}} </a></p>
                                </a>
                            </div>
                        </div>  
                        @endforeach
                     

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.items').slick({
                //     slidesToShow: 3,
                //   slidesToScroll: 1,
                //   autoplay: true,
                //   autoplaySpeed: 2000,
                autoplay: true,
                arrows: false,
                variableWidth: true,
                centerMode: true,
                infinite: true,
                dots: false,
                autoplaySpeed: 0,
                speed: 8000,
                cssEase: 'linear',
                accessibility: false,
                draggable: false,
                pauseOnFocus: true,
                pauseOnHover: true,
                useTransform: false,
                slidesToShow: 2,
                slidesToScroll: 0.1,
                responsive: [{
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        speed: 1000,
                        autoplaySpeed: 1000,
                        cssEase: 'ease-in-out',
                        draggable: false,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                        useTransform: true,
                    }
                }, ]
            });
        });
    </script>
    <script>
        var Height = window.innerHeight;
        $("#menu").css('height', Height + "px");
    </script>
</div>
@endsection
