const { data } = require("jquery");

 
      function city_filter_handler(stateid){ 
        var satate_id = $("#state").val();
  
         $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/doctor/getcity',
          type :'post',
          delay : 200,
          data:'state_id='+satate_id,
            success:function(result){
              console.log(result);
              $('#city_list').html(result);
            }
            
         })
        }

        function all_appointments_ajax(doctor_id){ 
           $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/doctor/all-appointments',
            type :'get',
            delay : 200,
              success:function(result){
                console.log("result.data");
              }
           })
          }







        function getage() {
          console.log($("#dob").val());
          var ageInMilliseconds = new Date() - new Date($("#dob").val()).getTime();
          var agevalue = Math.floor(ageInMilliseconds / 1000 / 60 / 60 / 24 / 365);
          $("#age").val(agevalue);
        }



         function day_to_time_validation(from, to, error_id){                                                               
            var time_start = new Date();
            var time_end = new Date();
            console.log('from',from);
            var value_start = $('#'+from).val().split(':');
            console.log(value_start);
            var value_end = $("#"+to).val().split(':');
            time_start.setHours(value_start[0], value_start[1], 0)
            time_end.setHours(value_end[0], value_end[1], 0)
            var time_difference_inminute=(time_end - time_start)/60000;
            if(time_difference_inminute < 60){
            $("#"+error_id).html('Invalid time, must have 1hr difference');
            }else{
              $("#"+error_id).html('');

            }
        }
        function doctor_save_remark(id){ 
          console.log('id',id);
          var remark=$('#doctor_save_remark_form').serialize();
           $.ajax({
             headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           url: '/doctor/doctor-save-remark',
           data:$('#doctor_save_remark_form').serialize()+'|'+id,
           type :'post',
           delay : 200,
             success:function(result){
               if(result.status=="success"){
                toastr.success(result.data);
                window.location.href='';
              }else{
              toastr.warning(result.data);
              }
              }
          })
         }
         function make_counsellor_oncheck($this) {
          if($this.checked) {
            console.log($this.id);
            make_counsellor_active_deactive($this);
          } else {
            make_counsellor_active_deactive($this);
          }
          } 
        
        
         
        function make_counsellor_active_deactive($this){
        $.ajax({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: '/admin/counsellor-active-deactive',
         type :'post',
         delay : 200,
         data:'id='+$this.id,
           success:function(result){ 
            if(result.status=="success"){
        
                toastr.success(result.data.message);
              } else{  
                toastr.error('Something went wrong.');
              }
            }
          })
        }
      //   $(function() {
      //   $('#doctor_save_remark_form').submit(function(e){
      //     e.preventDefault();
      //     alert("test");
      //     doctor_save_remark();
      //   })
      // });

        
