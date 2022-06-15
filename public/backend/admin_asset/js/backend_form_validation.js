$(document).ready(function() {

    $.validator.addMethod(
      "regex_name",
      function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      },
      "Please enter correct name."
    );
    $.validator.addMethod(
        "regex_pwd",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Please enter at least 6 charecter password."
      );
  
    $.validator.addMethod(
        "regex_phone",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Please enter valid phone"
    );

    $.validator.addMethod(
        "regex_address",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Please enter correct address."
    );

    $.validator.addMethod(
        "regex_pincode",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );

    $("#check_symptoms_form").validate({
        rules: {
            "fullname": {
                required: true,
                regex_name: "^[a-zA-Z ]{2,30}$"
            },
            "email": {
                required: true,
                email: true
            },
            "age": {
                required: true,
                digits: true,
                range: [18, 70]
            },
        },
    });

    $("#appointment_booking_form").validate({
        rules: {
            "fullname": {
                required: true,
                regex_name: "^[a-zA-Z ]{2,30}$"
            },
            "email": {
                required: true,
                email: true
            },
            "phone": {
                required: true,
                regex_phone: "^[0-9]{10,10}$",
            },
            "datetime": {
                required: true
            },
            "billing_address": {
                required: true,
            },
            "pin_code": {
                required: true,
                regex_pincode: "^[0-9]{6,6}$",
            },
        }
    });
    $("#create_doctor_profile_form").validate({
        rules: {
            "full_name": {
                required: true,
                regex_name: "^[a-zA-Z ]{2,30}$"
            },
            "email": {
                required: true,
                email: true
            }, 
            "dob": {
                required: true,
                date: true
            },
            "phone": {
                required: true,
                regex_phone: "^[0-9]{10,10}$",
            },
            "address": {
                required: true,
                regex_address: "^[#.0-9a-zA-Z\s,-, ,/]+$",
            },
            "datetime": {
                required: true
            },
            "state": {
                required: true,
            },
            "city": {
                required: true,
            },
            "highest_education": {
                required: true,
            },
            "professional_experience": {
                required: true,
            },
            "day_from_time": {
                required: true,
            },
            "day_to_time": {
                required: true,
            },
            "night_from_time": {
                required: true,
            },
            "night_to_time": {
                required: true,
            },
            "profile_image": {
                required: false,
            }
        }
    });
    $("#doctor_login_form").validate({
        rules: {
            "email": {
                required: true,
                email: true
            },
            "password": {
                required: true,
            }  
        }
    });
    $("#doctor_change_password_validation").validate({
        rules: {
            "password": {
                required: true,
            },
            "password_confirmation": {
                required: true,
            }  
        }
    });
    $("#doctor_signup_form_validation").validate({
        rules: {
            "email": {
                required: true,
                email: true
            },
            "password": {
                required: true,
                regex_pwd:"^[ A-Za-z0-9_@.\/#&+-]{6,12}$"
            },
            "password_confirmation": {
                required: true,
            }    
        }
    });
    // $("#doctor_save_remark_form").validate({
    //     rules: {
    //         "doctor_remark": {
    //             required: true,
    //         },
             
    //     }
    // });
});
