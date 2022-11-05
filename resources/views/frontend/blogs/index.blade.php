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
            @foreach ($blog_lists as $blog_list)

                <div class="bg-lightgray p-3">
                    <div class="row border-bottom mb-4">
                        <div class="col-md-3">
                            <img src="{{url('upload/blog/photo/'.$blog_list->photo)}}" alt="{{$blog_list->slug}}" class="img-fluid">
                        </div>
                        <div class="col-md-9 text-deepblue">
                            <h3>{{$blog_list->caption}}</h3>
                            <span class="blog-tagline">{{$blog_list->tagline}}</span>
                            <p class="blog-date"> 
                                {{date("d M, Y", strtotime($blog_list->published_at))}}</p>
                            <p class="blog-content">
                                {{-- {!! $blog_list->description !!} --}}
                            @php
                                $desc=strip_tags($blog_list->description);
                                $short_desc=substr($desc,0,180);
                                $string = htmlentities($desc, null, 'utf-8');
                                $content = str_replace("&amp", "", $string);
                                $content = str_replace("&amp", "", $string);

                                // $content = html_entity_decode($content);
                            @endphp
                           {{$short_desc}}..
                             
                            </p>
                            <a href="{{url('blogs/'.$blog_list->slug)}}" class="blog-link"><p>Continue reading</p></a>
                        </div>
                    </div>
                  
                  
                </div>
            @endforeach

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
                            {{$blog_lists->links()}}
                    
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
