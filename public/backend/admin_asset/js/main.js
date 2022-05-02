// option_count=1;
function add_more(){
  var box_count=jQuery("#box_count").val();
  box_count++;
  jQuery("#box_count").val(box_count);

  var option_count=jQuery("#option_count").val();
  option_count++;
  jQuery("#option_count").val(option_count);
  jQuery("#wrap").append('<div id="box_loop_'+box_count+'" class="col-lg-6 form-group"><label for="option4" >option '+option_count+'</label><input type="text" class="form-control" required name="option[]" placeholder="Option"> <a href="#" onclick=remove_more("'+box_count+'") class=""><i class="fas text-danger fa-trash" aria-hidden="true"></i></button></div>');
console.log("option_count",option_count);

}
function remove_more(box_count){
  jQuery("#box_loop_"+box_count).remove();
  var box_count=jQuery("#box_count").val();
  box_count--;
  jQuery("#box_count").val(box_count);
  var option_count=jQuery("#option_count").val();
  option_count--;
  jQuery("#option_count").val(option_count);

}





































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