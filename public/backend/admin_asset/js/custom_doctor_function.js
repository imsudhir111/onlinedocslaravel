 
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