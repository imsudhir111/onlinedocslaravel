function press_media_deactive_oncheck($this) {
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
 url: '/admin/press-media-active-deactive',
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



function press_media_release_deactive_oncheck($this) {
  if($this.checked) {
    console.log($this.id);
    release_active_deactive($this);
  } else {
    release_active_deactive($this);
  }
  } 


 
function release_active_deactive($this){
  //  console.log($this);
$.ajax({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 },
 url: '/admin/press-media-release-active-deactive',
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

function filter_media_press_by_media_press_release_id($this){
  $("#media_press_release_id").val($this.id);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: '/admin/press-media-list-filterd-by-release-id',
  type :'post',
  delay : 200,
  data:'id='+ $("#media_press_release_id").val(),
    success:function(result){ 
      console.log(result.press_media_dropdown);
      $("#assigned_media_press_list").html(result.data.assigned_media_press_list); 

       $("#media_press_list").html(result.data.press_media_dropdown);
      // $(".save_assigned_media_press").attr('id', $this.id);
     if(result.status=="success"){ 
       } else{   
       }
     }
   })
}

function filter_media_press_by_media_press_release_id_reload(){
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: '/admin/press-media-list-filterd-by-release-id',
  type :'post',
  delay : 200,
  data:'id='+ $("#media_press_release_id").val(),
    success:function(result){ 
      console.log(result);
   
     if(result.status=="success"){ 
      $("#assigned_media_press_list").html(result.data.assigned_media_press_list); 
      $("#media_press_list").html(result.data.press_media_dropdown); 
       } else{   
       }
     }
   })
}
$('#assign_media_release_form').submit(function(e){
  e.preventDefault();
  // const formData = new FormData();
  // formData.append('media_press_id',$('#media_press_list').val());
  // formData.append('id',$('#media_press_list').val());
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: '/admin/save-assigned-media-press',
  data:$('#assign_media_release_form').serialize(),
  type :'post',
  delay : 200,
    success:function(result){ 
      console.log('result',result);
       toastr.success(result.data.message);
      $("#assign_media_release_form")[0].reset()
      filter_media_press_by_media_press_release_id_reload();
    }
  })
})




function save_assigned_media_press12(e){
  e.preventdefault();
  alert('hj');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: '/admin/save-assigned-media-press',
  type :'post',
  delay : 200,
  data:'id='+$this.id,
    success:function(result){ 
      // filter_media_press_by_media_press_release_id();fdhf
     }
   })
}
function remove_assigned_media_press(id){
   $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: '/admin/remove-assigned-media-press-byid',
  type :'post',
  delay : 200,
  data:'id='+id,
    success:function(result){ 
      console.log(result);
     if(result.status=="success"){ 
      toastr.success(result.data.message);
      filter_media_press_by_media_press_release_id_reload();
     }else{
      toastr.error(result.msg);
     }
      }
   })
}
// $(window).on('shown.bs.modal', function() { 
//   // $('#code').modal('show');
//   // alert('shown');
//   filter_media_press_by_media_press_release_id();
// });