
  
  <div class="container-fluid footer">
      <div class="row">
          <div class="col-md-12">
              <div class="container">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 col-8 offset-3 offset-md-0">
                          <div class="footerLogo">
                              <img src="{{ asset('/frontend/images/white logo 1.png')}}" class="img-fluid">
                              <p>Second opinion matters</p>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-4  col-6">
                          <h5>QUICK LINKS</h5>
                          <ul class="footer-links">
                              <li><a href="">Book An Appointment</a></li>
                              <li><a href="">Second Medical Opinion</a></li>
                              <li><a href=""> Why Us</a></li>
                              <li><a href=""> Team</a></li>
                              <li><a href="">  Blog</a></li>
                              <li><a href=""> Login / Sign Up</a></li>
                          </ul>
                      </div>
                      <div class="col-md-4 col-sm-4  col-6">
                          <h5>CONTACT US </h5>
                          <ul class="footer-links">
                              <li>
                                  <a href="tel:+91080-6803-4357"><img src="{{ asset('/frontend/images/Icons/phone.png')}}" class="img-fluid"> 080-6803-4357</a>
                              </li>
                              <li>
                                  <a href="mailto:contact@onlinedocs.com"><img src="{{ asset('/frontend/images/Icons/email.png')}}" class="img-fluid emailIcon"> contact@onlinedocs.com</a>
                              </li>
                          </ul>
                          <div class="follow_us">
                              <fieldset class="border p-2">
                                  <legend class="float-none w-auto">Share</legend>
                                  <div class="row m-2">
                                      <div class="col-md-4  col-sm-4 col-4 text-center"><img src="{{ asset('/frontend/images/Icons/whatsapp.png')}}" class="img-fluid"> </div>
                                      <div class="col-md-8  col-sm-8  col-8">
                                          <div class="row g-sm-2 g-2 social-margin border-left">
                                              <div class="col-md-4  col-sm-4  col-4"><img src="{{ asset('/frontend/images/Icons/twitter.png')}}" class="img-fluid"></div>
                                              <div class="col-md-4  col-sm-4 col-4"><img src="{{ asset('/frontend/images/Icons/facebook.png')}}" class="img-fluid fbIcon"></div>
                                              <div class="col-md-4  col-sm-4 col-4"><img src="{{ asset('/frontend/images/Icons/pinterest.png')}}" class="img-fluid"></div>
                                          </div>
                                      </div>
                                  </div>
                              </fieldset>
                          </div>
                      </div>
                  </div>
                  <div class="row disclaimer">
                      <div class="col-md-12">
                          <div class="GoldenLine"></div>
                          <h5 class="text-center">DISCLAIMER</h5>
                          <p class="text-center">The content provided on our website is not intended for medical emergencies. The risk of any loss, physical or otherwise, is entirely the responsibility of the individual who followed such information, despite the disclaimer
                              on the site</p>
                      </div>
                  </div>
                  <div class="row disclaimerLinks">
                      <div class="col-md-6 col-sm-6 col-8">
                          <a href="">FAQ's</a>
                          <a href="">Terms and Conditions</a>
                          <a href="">Privacy Disclaimer</a>
                      </div>
                      <div class="col-md-6 col-sm-6  col-4 text-right">&copy; 2021 Online Docs</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="call_icon_sticky sticky_icon_" style="
    background: #333d51;">
   <a href="tel:+080-6803-4357" class="white" style="color: #fff !important;">
   <i class="fa fa-phone"></i>
   <span class="d-none d-sm-inline">+080-6803-4357</span>
   </a>
</div>
<script src="{{asset('frontend/js/myscript.js')}}"></script>

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
<script src="{{asset('frontend/js/script.js')}}"></script>
<script src={{ asset('/frontend/jquery-validation/jquery.validate.js') }}></script>
<script src={{ asset('/frontend/jquery-validation/additional-methods.js') }}></script>
<script src="{{ asset('/backend/admin_asset/js/backend_form_validation.js') }}"></script>
<script src="{{ asset('/backend/admin_asset/js/custom_newsletter_function.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
}
@endif 
        

</script>