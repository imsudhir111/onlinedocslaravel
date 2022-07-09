
$('#join_our_news_letter_form').submit(function(e){
        e.preventDefault();
var email = $("#join_news_letter").val();
  
$.ajax({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 },
 url: '/join-us-news-letter',
 type :'post',
 delay : 200,
 data:'email='+email,
   success:function(result){ 
    if(result.status=="success"){
        toastr.success(result.data.message);
        $("#join_our_news_letter_form")[0].reset();
        // window.location.href=''; 
      } else{  
        toastr.warning(result.data.message);
        // window.location.href='';  
      }
   }
   
})
})