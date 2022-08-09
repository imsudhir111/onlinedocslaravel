<div class="bg-deepblue topHeader p-2">
    <div class="container">
        <div class="row ">
            <div class="col-md-7 col-1"></div>
            <div class="col-md-5 col-11 text-right">
            <div class="row float-end headerSocialIcons">
                    <div class="col-md-2 col-2 ">
                        <a href="https://www.instagram.com/online_docs/" target="_blank" >
                            <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-instagram p-1 "></i></div>
                        </a>
                    </div>
                    <div class="col-md-2 col-2">
                        <a href="https://www.facebook.com/OnlineDocsUs" target="_blank">
                            <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-facebook-f p-1 "></i></div>
                        </a>
                    </div>
                    <div class="col-md-2 col-2">
                        <a href="https://www.pinterest.com/online_docs/" target="_blank">
                            <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-pinterest p-1 "></i></div>
                        </a>
                    </div>
                    <div class="col-md-2 col-2">
                        <a href="https://twitter.com/online_docs_us" target="_blank">
                            <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-twitter p-1 "></i></div>
                        </a>
                    </div>
                    <div class="col-md-2 col-2">
                        <a href="https://www.linkedin.com/showcase/82574113/admin/" target="_blank" >
                            <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-linkedin-in p-1 "></i></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-light navbar-expand-md bg-white bg-faded fixed-top justify-content-center border-bottom">
    <div class="container">
        <a href="{{url('/')}}" class="navbar-brand d-flex w-50 me-auto"><img src="{{ asset('/frontend/images/logo.png')}}" class="img-fluid" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">

            <ul class="nav navbar-nav ms-md-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Treatments </a>
                    {{-- <ul class="dropdown-menu dropdown-menu-right" id="treatmentDropdown" aria-labelledby="navbarScrollingDropdown">
                        @foreach($all_services as $service)
                    <li><a class="dropdown-item"  href="{{route('service.detail',$service->id)}}">{{$service->service_name}}</a></li>
                    @endforeach
                    </ul> --}}
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">ANXIETY</a></li>
                        <li><a class="dropdown-item" href="#">ALCOHOL USE DISORDER</a></li>
                        <li><a class="dropdown-item" href="#">BEHAVIORAL AND EMOTIONAL DISORDERS IN CHILDREN/TEENAGERS</a></li>
                        <li><a class="dropdown-item" href="#">BIPOLAR DISORDER</a></li>
                        <li><a class="dropdown-item" href="#">DEPRESSION</a></li>
                        <li><a class="dropdown-item" href="#">DISSOCIATION</a></li>
                        <li><a class="dropdown-item" href="#">EATING DISORDERS</a></li>
                        <li><a class="dropdown-item" href="#">OBSESSIVE COMPULSIVE DISORDER</a></li>
                        <li><a class="dropdown-item" href="#">PARANOIA</a></li>
                        <li><a class="dropdown-item" href="#">POST-TRAUMATIC STRESS DISORDER</a></li>
                        <li><a class="dropdown-item" href="#">PSYCHOSIS</a></li>
                        <li><a class="dropdown-item" href="#">SCHIZOPHRENIA</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">Counselors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('blogs')}}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Press</a>
                </li>
                <li class="nav-item dropdown bg-deepblue  rounded-1">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Signup / Login </a>
                    <ul class="dropdown-menu dropdown-menu-right" id="treatmentDropdown" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="{{url('doctor/signup')}}">Doctor</a></li>
                        <li><a class="dropdown-item" href="{{url('patient/login')}}">Customer</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="mb-5">
    &nbsp;
</div>
