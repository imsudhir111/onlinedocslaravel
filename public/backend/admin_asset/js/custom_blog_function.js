function active_deactive_oncheck($this) {
  if($this.checked) {
    console.log($this.id);
  active_deactive($this);
  } else {
  active_deactive($this);
  }
  } 


 
function active_deactive($this){
  //  console.log($this);
$.ajax({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 },
 url: '/admin/post-active-deactive',
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