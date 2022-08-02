@extends('frontend.layouts.app')

@section('content')
    <div class="container-fluid no-pl no-pr">
        <div class="row">
            <div class="appointment">
                <h3>REVOLUTIONIZING THE HEALTHCARE INDUSTRY</h3>
                <p>Sample dummy text will be placed here</p>
                <button class="btn btn-deepBlue" type="button">Book your Appointment</button>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('/frontend/images/1 (1).png')}}" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('/frontend/images/1 (2).png')}}" class="d-block w-100" alt="..." />
                    </div>
                </div>
            </div>
            <div class="hipaIcons">
                <img src="{{ asset('/frontend/images/Icons/hipa-icons.svg')}}">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bannerBottom">
                    <div class="triangle"></div>
                    <div class="row">
                        <div class="col-md-9 col-12">
                            <h3>Revolutionizing The <span>Healthcare Industry</span></h3>
                            <div class="pe-md-5">
                                <p>Welcome to the world of virtual care, where you are facilitated with quality care, fool-proof privacy, instant appointments, hassle-free follow-ups, followed by top-notch doctors and practitioners from India.
                                </p>
                                <p>
                                    We offer virtual care, and we aim to provide a professional, affordable, and approachable platform for all.</p>
                                <button type="button" class="btn btn-deepBlue">Best Online Therapy</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="yellowDoctor"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container servicesSection">
        <div class="row">
            <div class="col-md-12">
                <h3 class="heading">Our Services Fit Every Need </h3>
                <div>
                    We are the best telehealth services that deal in a wide range of mental healthcare. It is the best option for someone looking for a second opinion from the most trusted doctors in the USA.</div>
                <p><a href=""><button type="button" class="btn btn-deepBlue">We are just a call away!</button></a></p>
            </div>
        </div>
    </div>
    <div class="container servicesBottom">
        <div class="row">
            @php 
            $random_four_service = \App\Models\Service::All()->random(4);
            $random_four_service;
            @endphp
            @foreach ($random_four_service as $service)
             <div class="col-md-6 col-6 ">
                <div class="row mb-4 g-0">
                    <div class="col-md-5 col-5">
                        <div class="servicesPhoto">
                            <img src="{{ url('/upload/service_icon/'.$service->service_icon)}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-7 col-7">
                        <div class="servicesText">
                            <h4>{{$service->service_name}}</h4>
                            <p>{{substr(urldecode($service->caption), 0, 40)}}...</p>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
            {{-- <div class="col-md-6 col-6 ">
                <div class="row g-0">
                    <div class="col-md-5 col-5">
                        <div class="servicesPhoto">
                            <img src="{{ asset('/frontend/images/anxiety.png')}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-7 col-7">
                        <div class="servicesText">
                            <h4>ANXIETY</h4>
                            <p>Having a severe worry or fear of potential danger</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="row g-0">
                    <div class="col-md-5  col-5">
                        <div class="servicesPhoto">
                            <img src="{{ asset('/frontend/images/anxiety.png')}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-7  col-7">
                        <div class="servicesText">
                            <h4>ANXIETY</h4>
                            <p>Having a severe worry or fear of potential danger</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6  col-6">
                <div class="row g-0">
                    <div class="col-md-5  col-5">
                        <div class="servicesPhoto">
                            <img src="{{ asset('/frontend/images/anxiety.png')}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-7  col-7">
                        <div class="servicesText">
                            <h4>ANXIETY</h4>
                            <p>Having a severe worry or fear of potential danger</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6  col-6">
                <div class="row g-0">
                    <div class="col-md-5  col-5">
                        <div class="servicesPhoto">
                            <img src="{{ asset('/frontend/images/anxiety.png')}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-7  col-7">
                        <div class="servicesText">
                            <h4>ANXIETY</h4>
                            <p>Having a severe worry or fear of potential danger</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row mt-3">
            <div class="col-md-12"><button type="button" class="btn btn-deepBlue w-100">See All Therapy Services</button></div>
        </div>
    </div>
    <div class="container-fluid trialReport">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="reportText">
                                <h4>Take a Free Mental Health Test Today! Know How You Feel.</h4>
                                <p>Scientifically validated standard assessments - quickest way to determine if you are suffering from symptoms of any mental health disorder.</p>
                                <button type="button" class="btn btn-deepBlue">Get a Free Trial Report</button>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="trialReportPhotoSection"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-12 GoldenLine">
            </div>
        </div>
    </div>
    <div class="container howItWorks">
        <div class="row">
            <div class="col-md-12">
                <h3 class="heading">How It Works </h3>
                <div> Your road to Happiness
                </div>
                <div class="row mt-4">
                    <div class="col-md-2 col-sm-2 col-2">
                        <img src="{{ asset('/frontend/images/Icons/signup.png')}}" class="img-fluid">
                        <p>Sign/Login</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2">
                        <img src="{{ asset('/frontend/images/Icons/credentials.png')}}" class="img-fluid">
                        <p>Credentials</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2">
                        <img src="{{ asset('/frontend/images/Icons/raise.png')}}" class="img-fluid">
                        <p>Raise Concern</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2">
                        <img src="{{ asset('/frontend/images/Icons/councellor.png')}}" class="img-fluid">
                        <p>Your Counsellor</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2">
                        <img src="{{ asset('/frontend/images/Icons/appointment.png')}}" class="img-fluid">
                        <p>Appointment</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2">
                        <img src="{{ asset('/frontend/images/Icons/councelling.png')}}" class="img-fluid">
                        <p>Counselling</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container phychaitristsHead">
        <div class="row">
            <div class="col-md-12">
                <h3 class="heading">World-class Psychiatrists At your Fingertips
                </h3>
                <div>From the comfort of your couch, you'll be able to share issues with America's top practitioners without being judged.
                </div>
            </div>
        </div>
    </div>
    <div class="container phychaitrists">
        <div class="row ">
            <div class="col-md-6 d-md-block d-none">
                <div class="blueHorizontal"></div>
                <div class="happy-women">

                </div>
                <div class="women-overlap">SWITCH TO A HEALTHIER YOU</div>
            </div>
            <div class="col-md-6 offset-md-0 col-sm-11 offset-sm-1 offset-1">
                <div class="row mt-5">
                    <div class="col-md-12 col-11">
                        <h4 class="top-margin">World-class Psychiatrists</h4>
                        <p>From the comfort of your couch, you'll be able to share your problems with America's top practitioners without being judged.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-11">
                        <h4>Preserving your privacy</h4>
                        <p>Yes! No one knows your journey; it's just you and your chosen doctor. We guarantee confidentiality.

                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-11">
                        <h4>Just A Click Away
                        </h4>
                        <p>In these unprecedented times, it's better to keep away from all the hustle & bustle of the crowd. So, download our app, and you are good to go.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-11">
                        <h4>24*7 Availability </h4>
                        <p>We serve on a global level, and hence we are available 24X7. Follow simple steps to book an appointment, and we will take care of the rest.
                        </p>
                    </div>
                </div>
                <div class="row mt-3 mb-4">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-deepBlue">See The Psychiatrists</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container habits">
        <div class="btn btn-deepBlue floatViewBtn">View All</div>
        <div class="row g-0">
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-text">
                    <p>10 Atomic Habits that can change your Life</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-photo"><img src="{{ asset('/frontend/images/yoga 1.png')}}" class="img-fluid"></div>
            </div>
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-text">
                    <p>5 Levels of Human needs and motivation</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-photo"><img src="{{ asset('/frontend/images/indian man 1.png')}}" class="img-fluid"></div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-photo"><img src="{{ asset('/frontend/images/low res doc 1.png')}}" class="img-fluid"></div>
            </div>
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-text">
                    <p>Practices more Powerful than New Year Resolution</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-photo"><img src="{{ asset('/frontend/images/yes-lucky-me-happy-triumphing-young-joyful-armenian-woman-curly-haired-clench-fists-celebrating-successful-win-lottery-smiling-say-yeah-excited-good-positive-result-standing-white-background 2.png')}}" class="img-fluid"></div>
            </div>
            <div class="col-md-3 col-sm-3 col-3">
                <div class="habbit-text">
                    <p>10 Atomic Habits that can change your Life</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="GoldenLine"></div>
            </div>
        </div>
    </div>
    <div class="container pressCoverage">
        <div class="row">
            <div class="col-md-12">
                <h3 class="heading">Press Coverage
                </h3>
                <div>Actively working to bring positive change in the healthcare industry.
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="items">
                    <div class="slick-item"><img src="{{ asset('/frontend/images/toi.png')}}"></div>
                    <div class="slick-item"><img src="{{ asset('/frontend/images/forbes.png')}}"></div>
                    <div class="slick-item"><img src="{{ asset('/frontend/images/Aaj_tak_logo.png')}}"></div>
                    <div class="slick-item"><img src="{{ asset('/frontend/images/EH-Logo.png')}}"></div>
                    <div class="slick-item"><img src="{{ asset('/frontend/images/Times_Now_2010.png')}}"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container newsletterSection">
        <div class="row g-0">
            <div class="col-md-9 col-sm-12">
                <div class="newsSectionLeft newsletter">The latest mental health news and tips, delivered to your inbox weekly.</div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="newsSectionRight newsletter">
                    <form  id="join_our_news_letter_form" method="post">
                        <input type="text" class="form-control" id="join_news_letter" name="email" placeholder="Email">
                        <button type="submit" class="btn btn-deepBlue"><i class="fa-solid fa-newspaper"></i> Join Our Newsletter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container pressCoverage">
        <div class="row">
            <div class="col-md-12">
                <h3 class="heading">Testimonials
                </h3>
                <div>It fills our heart to see happy faces around
                </div>
            </div>
        </div>
    </div>
    <div class="container testimonials">
        <div class="row">
            <div class="col-md-4">
                <div class="testimonialDiv">
                    <div class="ribbon">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="ribbon5">NEED OF THE HOUR</span>
                        <p class="leftQuote"><i class="fa-solid fa-quote-left"></i></p>
                        <p class="text-center">I am a Totally different person now</p>
                        <p class="text-center"><b>Anncy Twinkle</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonialDiv">
                    <div class="ribbon">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="ribbon5">NEED OF THE HOUR</span>
                        <p class="leftQuote"><i class="fa-solid fa-quote-left"></i></p>
                        <p class="text-center">I am a Totally different person now</p>
                        <p class="text-center"><b>Anncy Twinkle</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonialDiv">
                    <div class="ribbon">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="ribbon5">NEED OF THE HOUR</span>
                        <p class="leftQuote"><i class="fa-solid fa-quote-left"></i></p>
                        <p class="text-center">I am a Totally different person now</p>
                        <p class="text-center"><b>Anncy Twinkle</b></p>
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
