$('#add_new_service').submit(function(e){
    e.preventDefault();
    alert("kkk");
    console.log("add service");
    let formData = new FormData(this);
        var input = document.querySelector('input[type=file]');
        var file = input.files[0];
        formData.append("service_icon", file);
        add_new_service(formData);

        if($("#name").val().length>0 && $("#s_email").val().length>2 && $("#s_mobile").val().length==10 && $("#state").val().length>0 && $("#city_list").val().length>0  && document.getElementById("s_photo").files.length != 0){
        //   add_new_service(formData);
        }
  })


  function add_new_service(formData){
    $("#contact_save").html('Saving..');
  
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000
    });
    $.ajax({
      type:'post',
      url: 'service',
      data:formData,
      contentType: false,
      processData: false,
      success:function(result){
        console.log(result);
        if(result.status=="success"){
         Toast.fire({
           icon: 'success',
           title:'&nbsp;&nbsp;'+result.msg
         })
         $('#add_new_contact')['0'].reset();
         $("#contact_save").html('Save');
        }else{
         Toast.fire({
           icon: 'error',
           title:'&nbsp;&nbsp;'+result.msg
         })
       }
      }
   })
  }