@extends('frontend.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>

<div class="container-fluid pb-5 bg-golden">
    <div class="container ">
        <div class="row pt-5 mt-5">
            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                <h3 class="text-deepblue text-center">BLOGS</h3>
            </div>
        </div>
    </div>
    <div class="container  counsellors">
        <div class="row g-0 mb-5 box-Shadow blog-section">
            <div class="col-md-8">
                <div class="bg-lightgray p-5">
                    <div class="row  mb-4">
                        <div class="col-md-12 text-deepblue">
                            <h3>{{$blog_detail->caption}}</h3>
                            <span class="blog-tagline">{{$blog_detail->tagline}}</span>
                            <p class="blog-date">22 June, 2022</p>
                            <img src="{{url('upload/blog/photo/'.$blog_detail->photo)}}" class="img-fluid">
                            <p class="blog-content mt-3">
                                @php
                                $desc=strip_tags($blog_detail->description);
                                $string = htmlentities($desc, null, 'utf-8');
                                $content = str_replace("&amp", "", $string);
                                $content = str_replace("&amp", "", $string);
                                @endphp
                                {!! str_replace("<pre>", "", $blog_detail->description) !!}
                                
                                 
                            </p>
                            <div class="row">
                                <div class="col-md-6 offset-6 text-right">
                                    <a href="" target="_blank"><i class="fab fa-instagram p-1 text-white bg-deepblue rounded-circle p-2"></i></a>
                                    <a href="" target="_blank"><i class="fab fa-facebook-f p-1 text-white bg-deepblue rounded-circle p-2"></i></a>
                                    <a href="" target="_blank"><i class="fab fa-pinterest p-1 text-white bg-deepblue rounded-circle p-2"></i></a>
                                    <a href="" target="_blank"><i class="fab fa-twitter p-1 text-white bg-deepblue rounded-circle p-2"></i></a>
                                    <a href="" target="_blank"><i class="fab fa-linkedin-in p-1 text-white bg-deepblue rounded-circle p-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-white bg-deepblue">
                <div class="bg-deepblue">

                    <div class="p-4">
                        <div class="row border-bottom blog-archives">
                            <div class="col-md-12">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="row archive-data">
                                    <div class="col-md-6"><span>Online Docs Team</span></div>
                                    <div class="col-md-6 text-right"><span>22 June 2022</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom blog-archives mt-4">
                            <div class="col-md-12">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="row archive-data">
                                    <div class="col-md-6"><span>Online Docs Team</span></div>
                                    <div class="col-md-6 text-right"><span>22 June 2022</span></div>
                                </div>
                            </div>
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
