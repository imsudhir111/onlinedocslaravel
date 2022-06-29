@extends('frontend.layouts.app')

@section('content')
<div class="container-fluid bg-golden">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="bg-white thanks">
                    <div class="row ">
                        <div class="col-md-4 d-none d-lg-block">
                            <div class="backShadowleft"></div>
                            <div class="girl"></div>                               
                        </div>
                        <div class="col-lg-8 col-md-12 col-12">
                        <div class="backShadowright"></div>
                            <div class="thanksTest" >
                            <h2 style="font-size:3rem; line-height:100px">Sorry!</h2>
                            <p style="font-size:25px; " class="text-justify"><b>"Your payment is unsuccessfull"</b><br>
                            <p style="font-size:25px;">Kindly stay on call with our support team,<br>
                            We are assisting you.</p>
                            </div>
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
