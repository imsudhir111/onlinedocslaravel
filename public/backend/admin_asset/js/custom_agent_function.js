  

function check_available_slot(patient_id){ 
  var datetime_value = $("#datetimepicker3").val();

  $.ajax({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   type :'post',
   delay : 200,
   dataType: 'json',
   data: {"datetime_value":datetime_value,"patient_id":patient_id},
   url: '/agent/check-available-slot',
      success:function(result){
        $("#doctor_id").val(result.data.doctor_id);
        console.log("stataytsduyasd",result.request_status);
        $("#show_available_slots").hide(); 
        if(result.status=="success"){
          $("#show_available_slots").hide(); 
           
         
        }
        if (result.status=="notfound") {
          var todays_slot =  '';
          $.each(result.data.todays, function(slot, doctor_id) {
          console.log("slot:",slot,"doctor_id:",doctor_id);
          var complete_slot1 = slot.split(':')[0];
          complete_slot1++;
          if(doctor_id>0){
          todays_slot +=  `<label class="tab"><input type="radio" name="tab-input" value= `+doctor_id+` class="tab-input"><div class="tab-box">`+slot+'-'+complete_slot1+`:00:00</div></label>`;
          }
          });
          var tomorrows_slot =  '';
          $.each(result.data.tomorrow, function(slot, doctor_id) {
          console.log("slot:",slot,"doctor_id:",doctor_id);
          var complete_slot2 = slot.split(':')[0];
          complete_slot2++;
          if(doctor_id>0){
          tomorrows_slot +=  `<label class="tab"><input type="radio" name="tab-input" value= `+doctor_id+` class="tab-input"><div class="tab-box">`+slot+'-'+complete_slot2+`:00:00</div></label>`;
          }
          });
          var next_to_tomorrow_slot =  '';
          $.each(result.data.next_to_tomorrow, function(slot, doctor_id) {
          console.log("slot:",slot,"doctor_id:",doctor_id);
          var complete_slot3 = slot.split(':')[0];
          complete_slot3++;
          if(doctor_id>0){
          next_to_tomorrow_slot +=  `<label class="tab"><input type="radio" name="tab-input" value= `+doctor_id+` class="tab-input"><div class="tab-box">`+slot+'-'+complete_slot3+`:00:00</div></label>`;
          }
          });
          $("#tabs-1-data").html(todays_slot);
          $("#tabs-2-data").html(tomorrows_slot);
          $("#tabs-3-data").html(next_to_tomorrow_slot);

          $("#show_available_slots").show(); 
          
        }
        
     }
  })
 }
function confirm_appointment_booking(patient_id){
  var datetime_value = $("#datetimepicker3").val();
  var doctor_id=null;
  var doctor_id =  $("#doctor_id").val();
  var if_exact_date_time_not_match_doctorid =  $("[name='tab-input']:checked").val();

  // if($("#doctor_id").val()!==null){
  //    doctor_id =  $("#doctor_id").val();
  // }else{
  //    doctor_id =  $("[name='tab-input']:checked").val();
  // }

  console.log($("[name='tab-input']:checked").val());
  $.ajax({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   type :'post',
   delay : 200,
   dataType: 'json',
   data: {"datetime_value":datetime_value,"patient_id":patient_id,"doctor_id":doctor_id,"if_exact_date_time_not_match_doctorid":if_exact_date_time_not_match_doctorid},
   url: '/agent/confirm-appointment-booking',
      success:function(result){
        if(result.status=="success"){
          $("#schedule_appointment_form")[0].reset();
        }else{ 
          console.log('failed');
        }
     }
  })
}
// function aa_bb_aaa(){
//   var datetime_value = $("#datetimepicker3").val();
//   $("#datetimepicker_hidden").val(datetime_value);
//   $(".appointment_msg").hide();
//   $.ajax({
//       type: "POST",
//       dataType: 'json',
//       data: {_token:"{{ csrf_token() }}",datetime_value:datetime_value},
//       url: "{{ route('get.appointment.ajax') }}",
//       success:function(data){
//           console.log(data);

//           if(data.doctor_ids != 0 && data.slot_timing != ""){
//               $("#doctor_id").val(data.randomDoctorId);
//               $('#slots_div').hide();
//           }
//           else if(data.doctor_ids == 0 && data.slot_timing == ""){
//               $('#slots_div').show();
//               $("#doctor_id").val('');
//               var i = 0;

//               for(i=0;i<=2;i++){
//                   $('#date-'+i).text(data.result[i].formated_date);
//                   $('#date-'+i).attr('date',data.result[i].formated_date);
//                   var count = data.result[i].slots.length;
//                   var rows = "";
//                   rows += `<div class="row">`;
//                   var j = 0;
//                   for(j=0;j<count;j++){
//                       var values_count = data.result[i].docid[j].length;
//                       var firstDoctor = '';
//                       if(values_count>1){
//                           firstDoctor = data.result[i].docid[j].split(',', 1);
//                       }else{
//                           firstDoctor = data.result[i].docid[j];
//                       }
//                       rows += `<div class="col-md-4 mt-2">
//                                   <div class="singleSlot" id="slot_${i}${j}" onclick="getDateTime(this.id)" data-date="${data.result[i].date}" data-doctorid="${firstDoctor}" data-doctoridss="${data.result[i].docid[j]}">${data.result[i].slots[j]}</div>
//                               </div>`
//                   }
//                   rows += `</div>`;
//                   $('#tabs-'+i).html(rows);
//               }
//           }

//       }
// }


 