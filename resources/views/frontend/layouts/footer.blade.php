<div class="container-fluid footer">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12 offset-sm-3 offset-md-0">
                        <div class="footerLogo">
                            <img src="{{ asset('/frontend/images/white logo 1.png')}}" class="img-fluid">

                            <p>Second opinion matters</p>
                        </div>
                        <ul class="footer-links">
                            <li>
                                <a href="tel:+91080-6803-4357"><img src="{{ asset('/frontend/images/Icons/phone.png')}}" class="img-fluid"> 080-6803-4357</a>
                            </li>
                            <li>
                                <a href="mailto:contact@onlinedocs.com"><img src="{{ asset('/frontend/images/Icons/email.png')}}" class="img-fluid emailIcon"> contact@onlinedocs.com</a>
                            </li>
                        </ul>
                        <div class="follow_us mb-4 mb-md-0">
                            <!-- <div class="row mb-4">
                                <div class="col-md-12"><span class="bg-golden  p-1">Share</span></div>
                            </div> -->
                            <div class="row pb-3  pb-md-0">
                                <div class="col-md-2 col-2">
                                    <a href="https://www.instagram.com/online_docs/" target="_blank">
                                        <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-instagram p-2"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-2">
                                    <a href="https://www.facebook.com/OnlineDocsUs" target="_blank">
                                        <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-facebook-f p-2"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-2">
                                    <a href="https://www.pinterest.com/online_docs/" target="_blank">
                                        <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-pinterest p-2"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-2">
                                    <a href="https://twitter.com/online_docs_us" target="_blank">
                                        <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-twitter p-2 "></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-2">
                                    <a href="https://www.linkedin.com/showcase/82574113/admin/" target="_blank">
                                        <div class="bg-golden rounded-circle text-deepblue social-icons text-center"><i class="fab fa-linkedin-in p-2"></i></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6  col-12 mt-sm-4 mt-4 mt-md-0">
                        <h5>QUICK LINKS</h5>
                        <ul class="footer-links">
                            <li><a href="about.php">About us</a></li>
                            <li><a href="counsellors.php">Our Counselors</a></li>
                            <li><a href="plans-pricing.php">Plan & Pricing</a></li>
                            <li><a href="FAQs.php"> FAQs</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6  col-12">
                        <h5>INFORMATION </h5>
                        <ul class="footer-links">
                            <li><a href="privacy-policy.php">Privacy Policy</a></li>
                            <li><a href="termsandconditions.php">Terms & Conditions</a></li>
                            <li><a href="">Disclaimer</a></li>
                            <li><a href="">Request Callback</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row disclaimer mt-3">
                    <div class="col-md-12">
                        <div class="GoldenLine"></div>
                        <h5 class="text-center">DISCLAIMER</h5>
                        <p class="text-center">The content provided on our website is not intended for medical emergencies. The risk of any loss, physical or otherwise, is entirely the responsibility of the individual who followed such information, despite the disclaimer
                            on the site</p>
                    </div>
                </div>
                <div class="row disclaimerLinks">
                    <div class="col-md-6 col-sm-6 col-8">
                        <a href="">FAQs |</a>
                        <a href="termsandconditions.php">Terms and Conditions |</a>
                        <!-- <a href="refund-policy.php">Refund Policy |</a> -->
                        <a href="privacy-policy.php">Privacy Policy |</a>
                        <a href="disclaimer.php">Disclaimer</a>
                    </div>
                    <div class="col-md-6 col-sm-6  col-4 text-right">&copy; 2021 Online Docs</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="call_icon_sticky sticky_icon_ tollfreeNo">
    <a href="tel:080-6803-4357"><b class="d-none d-sm-inline">Tollfree : </b>
        <i class="fa fa-phone"></i>
        <span class="d-none d-sm-inline"> 080-6803-4357 </span>
    </a>
</div>
<div class="call_icon_sticky sticky_icon_ scrollup">
    <span class=""><i class="fa fa-arrow-circle-up"></i></span>

</div>

<div class="modal" tabindex="-1" id="servicesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close float-end close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="bg-image">
                <div class="modal-body">
                    <div>
                        <h3>Depression</h3>
                        <p class="p1"></p>
                        <p class="p2"></p>
                        <ul></ul>
                        <p class="p3"></p>
                        <a href="questions.php?q="><button type="button" class="btn btn-deepBlue">Lets Answer</button></a>
                    </div>
                </div>
                <div class="modal-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/myscript.js" type="text/javascript"></script> 
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script src="{{asset('frontend/js/script.js')}}"></script>
<script src={{ asset('/frontend/jquery-validation/jquery.validate.js') }}></script>
<script src={{ asset('/frontend/jquery-validation/additional-methods.js') }}></script>
<script src="{{ asset('/backend/admin_asset/js/backend_form_validation.js') }}"></script>
<script src="{{ asset('/backend/admin_asset/js/custom_newsletter_function.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$( function() {
  var icons = {
    header: "ui-icon-caret-1-s",
    activeHeader: "ui-icon-minus"
  };
  $( "#accordion" ).accordion({
    icons: icons
  });
  $( "#toggle" ).button().on( "click", function() {
    if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
      $( "#accordion" ).accordion( "option", "icons", null );
    } else {
      $( "#accordion" ).accordion( "option", "icons", icons );
    }
  });
} );
</script>
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
            pauseOnFocus: false,
            pauseOnHover: false,
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
                    pauseOnHover: false,
                    useTransform: false,
                }
            }, ]
        });
    });
</script>
<script>
    var Height = window.innerHeight;
    var Width = window.innerWidth;
    $("#menu").css('height', Height + "px");
    $("#menu").css('width', Width + "px");

    function timeSlots() {
        $.get("data.json", function(data, status) {
            console.log(data);

        });
    }
</script> 


<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $(".scrollup").fadeIn();
            } else {
                $(".scrollup").fadeOut();
            }
        });

        $(".scrollup").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
</script>
<script>
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 1) {
            $('.fixed-top').css({
                'top': '0px',
                'border-bottom': '1px solid #333d51'
            });
        } else {
            $('.fixed-top').css({
                'top': '2.5rem',
                'border-bottom': 'none'
            });
        }
    });
</script>
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