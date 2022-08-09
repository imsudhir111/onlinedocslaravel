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
                   

                            <div class="row border-bottom"> 
                                <div class="col-md-3 offset-1 mb-4"><img src="{{url('upload/press-media-release/image/'.$press_media_release[0]->image)}}" class="img-fluid border-lightgray"></div>
                                <div class="col-md-8">
                                    <p class="text-lightgray">22 June, 2022</p>
                                    <p class="press-caption">{{$press_media_release[0]->caption}}</p>
                                </div>
                            </div>
                       

                            <div class="row mt-4">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($assigned_press_media as $key => $item)
                                    {{-- {{gettype($item)}} --}}
                                    {{-- {{$item}} --}}
                                    {{-- {{$item[0]->id}} --}}
                                    {{-- {{$item[$key]->media_press_id}} --}}
                                    {{-- {{$item[$key]->media_press->small_icon}} --}}
                                    <div class="item">
                                       <a href="{{$item[$key]->url}}"> 
                                            <div class="p-4 rounded border">
                                                <img src="{{url('upload/press-media/small_icon/'.$item[$key]->media_press->small_icon)}}" class="img-fluid">
                                            </div>
                                       </a>  
                                    </div>
                                    @endforeach
                                   
                                    {{-- <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div> 
                                    <div class="item">
                                        <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                    </div>--}}

                                </div>

                            </div>
                        </div>
                    </div>
                        
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-12">
                            <div class="rounded bg-white border p-3">
                                <div class="row border-bottom "> 
                                    <div class="col-md-3 offset-1 mb-4"><img src="images/press1.png" class="img-fluid border-lightgray"></div>
                                    <div class="col-md-8">
                                        <p class="text-lightgray">22 June, 2022</p>
                                        <p class="press-caption">Online Docs, a new venture by
                                            Dr Yashwant Chaudhari providing
                                            Mental Health assistance to India
                                            from June 2022. </p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="owl-carousel owl-theme">
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>
                                        <div class="item">
                                            <div class="p-4 rounded border"><img src="images/Times_Now_2010.png" class="img-fluid"></div>
                                        </div>

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
                        <div class="row border-bottom">
                            <div class="col-md-4">
                                <img src="images/chaudri.png" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <!-- <h4 class="text-uppercase press-month">May</h4> -->
                                <h6 class="press-date">28th May, 2022</h6>
                                <p class="text-justify">Lorem Ipsum is simply dummy text of the  printing and typesetting industry.</p>
                            </div>
                        </div>
                        <div class="row border-bottom mt-4">
                            <div class="col-md-4">
                                <img src="images/chaudri.png" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <!-- <h4 class="text-uppercase press-month">May</h4> -->
                                <h6 class="press-date">28th May, 2022</h6>
                                <p class="text-justify">Lorem Ipsum is simply dummy text of the  printing and typesetting industry.</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <img src="images/chaudri.png" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <!-- <h4 class="text-uppercase press-month">May</h4> -->
                                <h6 class="press-date">28th May, 2022</h6>
                                <p class="text-justify">Lorem Ipsum is simply dummy text of the  printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
