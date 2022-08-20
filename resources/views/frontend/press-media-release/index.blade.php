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
        <div class="row pt-5 ">
            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                <h3 class="text-deepblue text-center">PRESS</h3>
            </div>
        </div>
    </div>
    <div class="container  counsellors mt-4">
        <div class="row g-0 mb-5 box-Shadow">
            <div class="col-md-9 blog-column">
                <div class="bg-lightgray p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="rounded bg-white border p-3">
                                <div class="row border-bottom "> 
                                    <div class="col-md-3 offset-1 mb-4"><img src="{{url('upload/press-media-release/image/'.$press_media_release[0]->image)}}" class="img-fluid border-lightgray"></div>
                                    <div class="col-md-8">
                                        <p class="text-lightgray">22 June, 2022</p>
                                        <p class="press-caption">{{isset($press_media_release[0]->caption) ? $press_media_release[0]->caption : ''}}</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="owl-carousel owl-theme">
                                    @if (isset($assigned_press_media[0]))
                                        @foreach ($assigned_press_media[0] as $key => $item)
                                       
                                        <div class="item"> 
                                            <a target="_blank" href="{{$item->url}}"> 
                                                 <div class="p-4 rounded border">
                                                     <img src="{{url('upload/press-media/small_icon/'.$item->media_press->small_icon)}}" class="img-fluid">
                                                 </div>
                                            </a>  
                                         </div>
                                        @endforeach
                                       @endif
                                      
                                     
                                        {{-- <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div> --}}
                                        {{-- <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div> --}}
                                        {{-- <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div> --}}

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-12">
                            <div class="rounded bg-white border p-3">
                                <div class="row border-bottom "> 
                    <div class="col-md-3 offset-1 mb-4"><img src="{{url('upload/press-media-release/image/'.(isset($press_media_release[1]->image) ? $press_media_release[1]->image : ''))}}" class="img-fluid border-lightgray"></div>
                                    <div class="col-md-8">
                                        <p class="text-lightgray">22 June, 2022</p>
                                        <p class="press-caption">{{isset($press_media_release[1]->caption) ? $press_media_release[1]->caption : ''}}</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="owl-carousel owl-theme">
                                        @if(isset($assigned_press_media[1]))
                                        @foreach ($assigned_press_media[1] as $key => $item)
                                         
                                        <div class="item">
                                            <a target="_blank" href="{{$item->url}}"> 
                                                 <div class="p-4 rounded border">
                                                     <img src="{{url('upload/press-media/small_icon/'.$item->media_press->small_icon)}}" class="img-fluid">
                                                 </div>
                                            </a>  
                                         </div>
                                        @endforeach
                                      @endif
                                        
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-white bg-deepblue blog-sidebar">
                <div class="bg-deepblue othernews">
                    <h4 class="text-center text-white p-4 text-uppercase">Other News</h4>
                    <div class="p-4">
                        @foreach ($blog_list as $list)
                        <a class="text-decoration-none text-light p-1"
                         target="_blank" href="{{url('/blogs/'.$list->slug.'/'.$list->id)}}">
                        <div class="row border-bottom">
                            <div class="col-md-4">
                                <img src="{{url('upload/blog/photo/'.$list->small_image)}}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <!-- <h4 class="text-uppercase press-month">May</h4> -->
                                <h6 class="press-date"> {{date("d M, Y", strtotime($list->created_at))}}</h6>
                                <p class="text-justify">{{$list->caption}}</p>
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
<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
@endsection
