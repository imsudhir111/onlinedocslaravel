$(document).ready(function() {

    $.validator.addMethod(
      "regex",
      function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      },
      "Please check your input."
    );

    $("#serviceForm").validate({
        rules: {
            "service_name": {
                required: true,
                regex: "^[a-zA-Z]"
            },
            "caption": {
                required: true,
                regex: "^[a-zA-Z]"
            },
            "description": {
                required: true,
            },
            "service_icon": {
                required: true,
                extension: "jpg,jpeg,webp"
            },
        },
    });

    $("#serviceFormEdit").validate({
        rules: {
            "service_name": {
                required: true,
                regex: "^[a-zA-Z]"
            },
            "caption": {
                required: true,
                regex: "^[a-zA-Z]"
            },
            "description": {
                required: true,
            },
            "service_icon": {
                required: true,
                extension: "jpg,jpeg,webp"
            },
        },
    });

    $("#checkoutForm").validate({
        //debug: true,
        rules: {
            "billing_fullname": {
                required: true,
            },
            "billing_country": {
                required: true,
            },
            "billing_state": {
                required: true,
            },
            "billing_city": {
                required: true,
            },
            "billing_zip_code": {
                //required: true,
                minlength: 4,
                maxlength: 6,
                digits: true
            },
            "billing_addressline1": {
                required: true,
            },
            // "billing_addressline2": {
            //     required: true,
            // },
            "billing_email": {
                required: true,
                email: true,
            },
            // "billing_phone": {
            //     required: true,
            //     Number: true,
            //     minlength: 10,
            //     maxlength: 10,
            // },
            "payment_method": {
                required: true,
            },
            "termandcondition": {
                required: true,
            },
            "address": {
                required: $("#shipping").is(":checked"),
            },
            "shipping_fullname": {
                required: $("#shipping").is(":checked"),
            },
            "shipping_country": {
                required: $("#shipping").is(":checked"),
            },
            "shipping_state": {
                required: $("#shipping").is(":checked"),
            },
            "shipping_city": {
                required: $("#shipping").is(":checked"),
            },
            "shipping_zip_code": {
                //required: $("#shipping").is(":checked"),
                minlength: 4,
                maxlength: 6,
                digits: $("#shipping").is(":checked")
            },
            "shipping_addressline1": {
                required: $("#shipping").is(":checked"),
            },
            // "shipping_addressline2": {
            //     required: $("#shipping").is(":checked"),
            // },
            "shipping_email": {
                required: $("#shipping").is(":checked"),
                email: true
            },
            "shipping_phone": {
                required: $("#shipping").is(":checked"),
                minlength: 10,
                maxlength: 10,
                digits: true
            },
        },
    });
    $("#editProfileForm").validate({
        rules: {
            "name": {
                required: true,
            },
            "address_country": {
                required: true,
            },
            "address_state": {
                required: true,
            },
            "address_city": {
                required: true,
            },
            "address_pincode": {
                required: true,
                minlength: 4,
                maxlength: 6,
                digits: true
            },
            "address_line1": {
                required: true,
            },
            // "address_line2": {
            //     required: true,
            // },
            // "email": {
            //     required: true,
            //     email: true
            // },
            // "phone": {
            //     required: true,
            //     minlength: 10,
            //     maxlength: 10,
            //     digits: true
            // },
            "image_path": {
                extension: "jpg,jpeg,webp"
            }
        },
    });
    $("#trackOrderForm").validate({
        rules: {
            "order_number": {
                required: true
            }
        }
    });
    $("#changePasswordForm").validate({
        rules: {
            "oldpassword": {
                required: true,
                minlength: 6
            },
            "password": {
                required: true,
                minlength: 8
            },
            "password_confirmation": {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        }
    });
    $("#contactForm").validate({
        rules: {
            "name": {
                required: true,
            },
            "email": {
                required: true,
                email: true
            },
            "subject": {
                required: true,
            },
            "phone_number":{
                minlength: 10,
                maxlength: 10,
                digits: true
            }
        }
    });
    $("#createTicket").validate({
        rules: {
            "title": {
                required: true,
            },
            "message": {
                required: true,
            },
            "image_path": {
                extension: "jpg,jpeg,webp"
            }
        }
    });
    $("#ticketMessage").validate({
        rules: {
            "client_message": {
                required: true,
            },
            "image_path": {
                extension: "jpg,jpeg,webp"
            }
        }
    });

    // $("#checkoutForm").validate({
    //     rules: {
    //         "country_id": {
    //             required: true,
    //         },
    //         "state_id": {
    //             required: true,
    //         },
    //         "city_id": {
    //             required: true,
    //         },
    //         "billing_state": {
    //             required: true,
    //         },
    //         "billing_city": {
    //             required: true,
    //         },
    //         "billing_zip_code": {
    //             //required: true,
    //             minlength: 4,
    //             maxlength: 6,
    //             digits: true
    //         },
    //         "billing_addressline1": {
    //             required: true,
    //         },
    //         // "billing_addressline2": {
    //         //     required: true,
    //         // },
    //         "billing_email": {
    //             required: true,
    //             email: true,
    //         },
    //         // "billing_phone": {
    //         //     required: true,
    //         //     Number: true,
    //         //     minlength: 10,
    //         //     maxlength: 10,
    //         // },
    //         "payment_method": {
    //             required: true,
    //         },
    //         "termandcondition": {
    //             required: true,
    //         },
    //         "shipping_fullname": {
    //             required: $("#shipping").is(":checked"),
    //         },
    //         "shipping_country": {
    //             required: $("#shipping").is(":checked"),
    //         },
    //         "shipping_state": {
    //             required: $("#shipping").is(":checked"),
    //         },
    //         "shipping_city": {
    //             required: $("#shipping").is(":checked"),
    //         },
    //         "shipping_zip_code": {
    //             //required: $("#shipping").is(":checked"),
    //             minlength: 4,
    //             maxlength: 6,
    //             digits: $("#shipping").is(":checked")
    //         },
    //         "shipping_addressline1": {
    //             required: $("#shipping").is(":checked"),
    //         },
    //         // "shipping_addressline2": {
    //         //     required: $("#shipping").is(":checked"),
    //         // },
    //         "shipping_email": {
    //             required: $("#shipping").is(":checked"),
    //             email: true
    //         },
    //         "shipping_phone": {
    //             required: $("#shipping").is(":checked"),
    //             minlength: 10,
    //             maxlength: 10,
    //             digits: true
    //         },
    //         "address": {
    //             required: $("#shipping").is(":checked"),
    //         },
    //     },
    // });


    $("#createAddress").validate({
        rules: {
            "country_id": {
                required: true,
            },
            "state_id": {
                required: true,
            },
            "city_id": {
                required: true,
            },
            "addressline1": {
                required: true,
            },
            "addressline2": {
                required: true,
            },
            "zipcode": {
                required: true,
                minlength: 4,
                maxlength: 6,
                digits: true
            },
        },
    });

    $("#updateAddress").validate({
        rules: {
            "country_id": {
                required: true,
            },
            "state_id": {
                required: true,
            },
            "city_id": {
                required: true,
            },
            "addressline1": {
                required: true,
            },
            "addressline2": {
                required: true,
            },
            "zipcode": {
                required: true,
                minlength: 4,
                maxlength: 6,
                digits: true
            },
        },
    });

});
