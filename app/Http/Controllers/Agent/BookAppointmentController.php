<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Patient_payment;
use App\Models\DoctorWorkingHour;
use DateTime;
use Carbon\Carbon;


class BookAppointmentController extends Controller
{
    //
    public function check_available_slot(Request $request){
    //    return $request;
       $date_time_value = explode(' ',$request->datetime_value);
       $patient_id = $request->patient_id;
    //    return $date_time_value[1];
        // $day_from_time='10:00:00';
        // $day_to_time='12:00:00';
        $appointment_date=$date_time_value[0];
        $booking_time=$date_time_value[1];
        $booking_day= date('l', strtotime($date_time_value[0]));
        $available_doctors_by_booking_times = Doctor::select('id','working_days')
        ->where('day_from_time','<=',$booking_time)
        ->where('day_to_time','>',$booking_time)
        ->where('status','=', 1)
        ->get();
        // dd(count($available_doctors_by_booking_times));
        // dd($available_doctors_by_booking_times);

        if(count($available_doctors_by_booking_times)==0){
            $available_doctors_by_booking_times = Doctor::select('id','working_days')
            ->where('night_from_time','<=',$booking_time)
            ->where('night_to_time','>',$booking_time)
            ->where('status','=', 1)
            ->get();
            
        }
        // dd(count($available_doctors_by_booking_times));

        // return $day_from_time;

        // return $available_doctors_by_booking_times;

    $available_doctor_by_day_ids=[]; // array of all available doctors id by day
    foreach ($available_doctors_by_booking_times as $available_doctors_by_booking_time) {
        foreach (json_decode($available_doctors_by_booking_time->working_days) as $key => $doctor_availabity) {
            if($key==$booking_day && $doctor_availabity == 1){
                // print_r($available_doctors_by_booking_time['id']);

                array_push($available_doctor_by_day_ids,$available_doctors_by_booking_time['id']);
            }
        }
    }

// print_r($available_doctor_by_day_ids);

$available_doctor_by_day_and_time=[]; // array of all available doctors id by day and time
    foreach ($available_doctor_by_day_ids as $available_doctor_by_day_id) {
        //  print_r($available_doctor_by_day_id);
        $doctor_working_time=Doctor::select('day_from_time','day_to_time','night_from_time','night_to_time')->where(['id'=>$available_doctor_by_day_id])->get();
        $day_from_time=$doctor_working_time[0]['day_from_time'];
        $day_to_time=$doctor_working_time[0]['day_to_time'];
        $night_from_time=$doctor_working_time[0]['night_from_time'];
        $night_to_time=$doctor_working_time[0]['night_to_time'];
        $time_slot_list= $this->getTimeSlot('60', $day_from_time, $day_to_time);
        //  return $time_slot_list;

        foreach ($time_slot_list as $key => $time_slot) {
                if($time_slot['slot_start_time'] == $booking_time){
                    array_push($available_doctor_by_day_and_time,$available_doctor_by_day_id);
                } 
            }
        if(count($available_doctor_by_day_and_time)==0){
            $time_slot_list= $this->getTimeSlot('60', $night_from_time, $night_to_time);
            // print_r($time_slot_list);
            foreach ($time_slot_list as $key => $time_slot) {
                if($time_slot['slot_start_time'] == $booking_time){
                    array_push($available_doctor_by_day_and_time,$available_doctor_by_day_id);
                } 
            }
        }
    }
// check if doctor have allready appointment at given time and date
    foreach ($available_doctor_by_day_and_time as $key=>$available_doctor_by_day_and_time_id) {
        // print_r($available_doctor_by_day_and_time_id);
    $check_appointment = Appointment::where(['doctor_id'=>$available_doctor_by_day_and_time_id,'appointment_date'=>$appointment_date,'appointment_time'=>$booking_time])->get();
    // print_r(count($check_appointment));
    if(count($check_appointment)>0){
    // print_r($check_appointment[0]->doctor_id);
        if($check_appointment[0]->doctor_id == $available_doctor_by_day_and_time[$key]){
            unset($available_doctor_by_day_and_time[$key]);
        }

    }
}
if(count($available_doctor_by_day_and_time)>0){
    // print_r($available_doctor_by_day_and_time);
    // $random_doctor_id1 = $available_doctor_by_day_and_time[mt_rand(0,count($available_doctor_by_day_and_time))];
    $random_doctor_id_index =  array_rand($available_doctor_by_day_and_time,1);
    $appointment_credentials=["doctor_id"=>$available_doctor_by_day_and_time[$random_doctor_id_index], "patient_id"=>$patient_id, "appointment_date"=>$appointment_date, "booking_time"=>$booking_time];
    return response()->json(["status"=>"success", "request_status"=>"matched", "data"=>$appointment_credentials]);
    }
    else
    {
    //if exact given booking time is not available then find three days available doctors and slots
 
    $all_doctors_lists = Doctor::select('id','working_days')
    ->where('status','=',1)
    ->get();
        //  print_r(date("Y-m-d", strtotime("+0 day")));
        //  print_r(date("Y-m-d", strtotime("+1 day")));
        //  print_r(date("Y-m-d", strtotime("+2 day")));

    $today_booking_day = date('l', strtotime('+0 day', strtotime(date("Y-m-d"))));
    $tomorrow_booking_day = date('l', strtotime('+1 day', strtotime(date("Y-m-d"))));
    $next_to_tomorrow_booking_day = date('l', strtotime('+2 day', strtotime(date("Y-m-d"))));

    $all_doctors_list_by_today_id = []; // array of all available doctors id by day
    $all_doctors_list_by_next_to_tomorrow_id = [];
    $all_doctors_list_by_tomorrow_id=[];
    $doctors_slot=[];
    foreach ($all_doctors_lists as $all_doctors_list) {
        foreach (json_decode($all_doctors_list->working_days) as $key => $doctor_availabity) {
            
            if($key==$today_booking_day && $doctor_availabity == 1){
                // print_r($available_doctors_by_booking_time['id']);
                array_push($all_doctors_list_by_today_id,$all_doctors_list['id']);
            }
            if($key==$tomorrow_booking_day && $doctor_availabity == 1){
                // print_r($available_doctors_by_booking_time['id']);
                array_push($all_doctors_list_by_tomorrow_id,$all_doctors_list['id']);
            }
            if($key==$next_to_tomorrow_booking_day && $doctor_availabity == 1){
                // print_r($available_doctors_by_booking_time['id']);
                array_push($all_doctors_list_by_next_to_tomorrow_id,$all_doctors_list['id']);
            }
        }
    }
    
    $all_doctors_by_three_days=[
        "today"=>$all_doctors_list_by_today_id,
        "tomorrow"=>$all_doctors_list_by_tomorrow_id,
        "next_to_tomorrow"=>$all_doctors_list_by_next_to_tomorrow_id,
    ];
    // print_r($all_doctors_by_three_days['today']);
    // foreach ($all_doctors_by_three_days['today'] as $key => $doctorid) {
        # code...
        // print_r($all_doctors_by_three_days['today'][$key]);
        // print_r($doctorid);
    //     $doctor_scheduled = Appointment::where(['doctor_id'=>$doctorid,'appointment_date'=>date("Y-m-d", strtotime("+2 day")),'appointment_time'=>$appointmenttime])->get();
    // if (count($doctor_scheduled)>0) {
    //     unset($all_doctors_by_three_days['today'][$key]);
    // }
    // }
    // print_r($all_doctors_by_three_days['today']);
    $today=[];
    $today["10:00:00"]=0;  
    $today["11:00:00"]=0;  
    $today["12:00:00"]=0;  
    $today["13:00:00"]=0;  
    $today["14:00:00"]=0;  
    $today["15:00:00"]=0;  
    $today["16:00:00"]=0;
    
    $tomorrow["10:00:00"]=0;  
    $tomorrow["11:00:00"]=0;  
    $tomorrow["12:00:00"]=0;  
    $tomorrow["13:00:00"]=0;  
    $tomorrow["14:00:00"]=0;  
    $tomorrow["15:00:00"]=0;  
    $tomorrow["16:00:00"]=0;
    
    $next_to_tomorrow["10:00:00"]=0;  
    $next_to_tomorrow["11:00:00"]=0;  
    $next_to_tomorrow["12:00:00"]=0;  
    $next_to_tomorrow["13:00:00"]=0;   
    $next_to_tomorrow["14:00:00"]=0;  
    $next_to_tomorrow["15:00:00"]=0;  
    $next_to_tomorrow["16:00:00"]=0;
        //  print_r($doctor_id);
         $todays = $this->get_three_days_slot($all_doctors_by_three_days["today"],$today);
         $tomorrow = $this->get_three_days_slot($all_doctors_by_three_days["tomorrow"],$today);
         $next_to_tomorrow = $this->get_three_days_slot($all_doctors_by_three_days["next_to_tomorrow"],$today);
    
    // print_r($todays);
    // print_r($tomorrow);
    // print_r($todays["10:00:00"]);
 
print_r($todays);
foreach ($todays as $appointmenttime => $doctorid) {
    # code... 
    $doctorid_array=explode('|',$doctorid);
    if(count($doctorid_array)>1){
        for ($i=0; $i < count($doctorid_array); $i++) { 
            # code...
             $doctor_scheduled = Appointment::where(['doctor_id'=>$doctorid_array[$i],'appointment_date'=>date("Y-m-d", strtotime("+0 day")),'appointment_time'=>$appointmenttime])->get();
            if (count($doctor_scheduled)>0) {
                 print_r($doctorid_array[$i]);
                //  print_r($appointmenttime);
                //  print_r($todays[$appointmenttime][$i]);
                 //  unset($todays['next_to_tomorrow'][$key]);

            }
        }
      
    }
   
    // print_r(count($doctor_scheduled));
}

foreach ($tomorrow as $appointmenttime => $doctorid) {
    # code... 
    $doctorid_array=explode('|',$doctorid);
    if(count($doctorid_array)>1){
        for ($i=0; $i < count($doctorid_array); $i++) { 
            # code...
             $doctor_scheduled = Appointment::where(['doctor_id'=>$doctorid_array[$i],'appointment_date'=>date("Y-m-d", strtotime("+2 day")),'appointment_time'=>$appointmenttime])->get();
            if (count($doctor_scheduled)>0) {
                 print_r($doctorid_array[$i]);
                //  print_r($appointmenttime);
                //  print_r($tomorrow[$appointmenttime][$i]);
                 //  unset($tomorrow['tomorrow'][$key]);

            }
        }
      
    }
   
    // print_r(count($doctor_scheduled));
}
foreach ($next_to_tomorrow as $appointmenttime => $doctorid) {
    # code... 
    $doctorid_array=explode('|',$doctorid);
    if(count($doctorid_array)>1){
        for ($i=0; $i < count($doctorid_array); $i++) { 
            # code...
             $doctor_scheduled = Appointment::where(['doctor_id'=>$doctorid_array[$i],'appointment_date'=>date("Y-m-d", strtotime("+2 day")),'appointment_time'=>$appointmenttime])->get();
            if (count($doctor_scheduled)>0) {
                 print_r($doctorid_array[$i]);
                //  print_r($appointmenttime);
                //  print_r($next_to_tomorrow[$appointmenttime][$i]);
                 //  unset($next_to_tomorrow['next_to_tomorrow'][$key]);

            }
        }
      
    }
   
    // print_r(count($doctor_scheduled));
}

    $today_ids_10=explode('|',$todays["10:00:00"]);
    $today_ids_11=explode('|',$todays["11:00:00"]);
    $today_ids_12=explode('|',$todays["12:00:00"]);
    $today_ids_13=explode('|',$todays["13:00:00"]);
    $today_ids_14=explode('|',$todays["14:00:00"]);
    $today_ids_15=explode('|',$todays["15:00:00"]);
    $today_ids_16=explode('|',$todays["16:00:00"]);
    $todays['10:00:00']=$today_ids_10[array_rand(explode('|',$todays["10:00:00"]),1)];
    $todays['11:00:00']=$today_ids_11[array_rand(explode('|',$todays["11:00:00"]),1)];
    $todays['12:00:00']=$today_ids_12[array_rand(explode('|',$todays["12:00:00"]),1)];
    $todays['13:00:00']=$today_ids_13[array_rand(explode('|',$todays["13:00:00"]),1)];
    $todays['14:00:00']=$today_ids_14[array_rand(explode('|',$todays["14:00:00"]),1)];
    $todays['15:00:00']=$today_ids_15[array_rand(explode('|',$todays["15:00:00"]),1)];
    $todays['16:00:00']=$today_ids_16[array_rand(explode('|',$todays["16:00:00"]),1)];
   
    $tomorrow_ids_10=explode('|',$tomorrow["10:00:00"]);
    $tomorrow_ids_11=explode('|',$tomorrow["11:00:00"]);
    $tomorrow_ids_12=explode('|',$tomorrow["12:00:00"]);
    $tomorrow_ids_13=explode('|',$tomorrow["13:00:00"]);
    $tomorrow_ids_14=explode('|',$tomorrow["14:00:00"]);
    $tomorrow_ids_15=explode('|',$tomorrow["15:00:00"]);
    $tomorrow_ids_16=explode('|',$tomorrow["16:00:00"]);
    $tomorrow['10:00:00']=$tomorrow_ids_10[array_rand(explode('|',$tomorrow["10:00:00"]),1)];
    $tomorrow['11:00:00']=$tomorrow_ids_11[array_rand(explode('|',$tomorrow["11:00:00"]),1)];
    $tomorrow['12:00:00']=$tomorrow_ids_12[array_rand(explode('|',$tomorrow["12:00:00"]),1)];
    $tomorrow['13:00:00']=$tomorrow_ids_13[array_rand(explode('|',$tomorrow["13:00:00"]),1)];
    $tomorrow['14:00:00']=$tomorrow_ids_14[array_rand(explode('|',$tomorrow["14:00:00"]),1)];
    $tomorrow['15:00:00']=$tomorrow_ids_15[array_rand(explode('|',$tomorrow["15:00:00"]),1)];
    $tomorrow['16:00:00']=$tomorrow_ids_16[array_rand(explode('|',$tomorrow["16:00:00"]),1)];
   
    $next_to_tomorrow_ids_10=explode('|',$next_to_tomorrow["10:00:00"]);
    $next_to_tomorrow_ids_11=explode('|',$next_to_tomorrow["11:00:00"]);
    $next_to_tomorrow_ids_12=explode('|',$next_to_tomorrow["12:00:00"]);
    $next_to_tomorrow_ids_13=explode('|',$next_to_tomorrow["13:00:00"]);
    $next_to_tomorrow_ids_14=explode('|',$next_to_tomorrow["14:00:00"]);
    $next_to_tomorrow_ids_15=explode('|',$next_to_tomorrow["15:00:00"]);
    $next_to_tomorrow_ids_16=explode('|',$next_to_tomorrow["16:00:00"]);
    $next_to_tomorrow['10:00:00']=$next_to_tomorrow_ids_10[array_rand(explode('|',$next_to_tomorrow["10:00:00"]),1)];
    $next_to_tomorrow['11:00:00']=$next_to_tomorrow_ids_11[array_rand(explode('|',$next_to_tomorrow["11:00:00"]),1)];
    $next_to_tomorrow['12:00:00']=$next_to_tomorrow_ids_12[array_rand(explode('|',$next_to_tomorrow["12:00:00"]),1)];
    $next_to_tomorrow['13:00:00']=$next_to_tomorrow_ids_13[array_rand(explode('|',$next_to_tomorrow["13:00:00"]),1)];
    $next_to_tomorrow['14:00:00']=$next_to_tomorrow_ids_14[array_rand(explode('|',$next_to_tomorrow["14:00:00"]),1)];
    $next_to_tomorrow['15:00:00']=$next_to_tomorrow_ids_15[array_rand(explode('|',$next_to_tomorrow["15:00:00"]),1)];
    $next_to_tomorrow['16:00:00']=$next_to_tomorrow_ids_16[array_rand(explode('|',$next_to_tomorrow["16:00:00"]),1)];


    // return $all_doctors_by_three_days["today"];
    // print_r($todays);
    // print_r($tomorrow);
    // print_r($next_to_tomorrow);
    foreach ($today as $appointmenttime => $doctorid) {
        # code...
        $today_doctor_scheduled = Appointment::where(['doctor_id'=>$doctorid,'appointment_date'=>date("Y-m-d", strtotime("+0 day")),'appointment_time'=>$appointmenttime])->get();
        if (count($today_doctor_scheduled)>0) {
            unset($today[$appointmenttime]);
        }
     }

  
//  print_r($next_to_tomorrow);

    return response()->json(["status"=>"notfound", "request_status"=>"not_matched", "data"=>["todays"=>$todays, "tomorrow"=>$tomorrow, "next_to_tomorrow"=>$next_to_tomorrow]]);
}

    // return $available_doctor_by_day_and_time;

// $available_doctor_by_day_and_time  array of all available doctors id by day and time

    //  return $available_doctor_by_day_and_time;

        // $doctor_list = json_decode($available_doctor[1]->working_days);
        // return $doctor_list;
        // return gettype($doctor_list);
        // return $available_doctor;
    }




 
public function get_three_days_slot($all_doctors_by_three_days, $today){
     foreach ($all_doctors_by_three_days as $key => $doctorid) {
 
    $doctor_working_time=Doctor::select('day_from_time','day_to_time','night_from_time','night_to_time')->where(['id'=>$doctorid])->get();
    $day_from_time=$doctor_working_time[0]['day_from_time'];
    $day_to_time=$doctor_working_time[0]['day_to_time'];
    $night_from_time=$doctor_working_time[0]['night_from_time'];
    $night_to_time=$doctor_working_time[0]['night_to_time'];
    $morning_time_slot_list[$doctorid]= $this->getTimeSlot('60', $day_from_time, $day_to_time);
    $evening_time_slot_list[$doctorid]= $this->getTimeSlot('60', $night_from_time, $night_to_time);
    $morning_time_slot_count = count($morning_time_slot_list[$doctorid]);
    for ($i=0; $i < $morning_time_slot_count; $i++) { 
       if(in_array("10:00:00",$morning_time_slot_list[$doctorid][$i],TRUE)){
            if($today["10:00:00"]==0){
                $today["10:00:00"]=$doctorid;
            }else{
                $today["10:00:00"]=$today["10:00:00"].'|'.$doctorid;
            }
         }elseif(in_array("11:00:00",$morning_time_slot_list[$doctorid][$i],TRUE)){
            if($today["11:00:00"]==0){
                $today["11:00:00"]=$doctorid;
            }else{
                $today["11:00:00"]=$today["11:00:00"].'|'.$doctorid;
            }
        }
        else{
        // {{echo "no time matched"; }}
        }
}  
 

$evening_time_slot_count = count($evening_time_slot_list[$doctorid]);
for ($i=0; $i < $evening_time_slot_count; $i++) { 

        if(in_array("12:00:00",$evening_time_slot_list[$doctorid][$i],TRUE)){
            if($today["12:00:00"]==0){
                $today["12:00:00"]=$doctorid;
            }else{
                $today["12:00:00"]=$today["12:00:00"].'|'.$doctorid;
            }
        }elseif(in_array("13:00:00",$evening_time_slot_list[$doctorid][$i],TRUE)){
            if($today["13:00:00"]==0){
                $today["13:00:00"]=$doctorid;
            }else{
                $today["13:00:00"]=$today["13:00:00"].'|'.$doctorid;
            }
        }elseif(in_array("14:00:00",$evening_time_slot_list[$doctorid][$i],TRUE)){
            if($today["14:00:00"]==0){
                $today["14:00:00"]=$doctorid;
            }else{
                $today["14:00:00"]=$today["14:00:00"].'|'.$doctorid;
            }
        }elseif(in_array("15:00:00",$evening_time_slot_list[$doctorid][$i],TRUE)){
            if($today["15:00:00"]==0){
                $today["15:00:00"]=$doctorid;
            }else{
                $today["15:00:00"]=$today["15:00:00"].'|'.$doctorid;
            }
        }elseif(in_array("16:00:00",$evening_time_slot_list[$doctorid][$i],TRUE)){
            if($today["16:00:00"]==0){
                $today["16:00:00"]=$doctorid;
            }else{
                $today["16:00:00"]=$today["16:00:00"].'|'.$doctorid;
            }
        } 
        else{
        {{echo "no time matched"; }}
        }
    }
//    foreach ($time_slot_list as $key => $time_slot) {
    //            if($time_slot['slot_start_time'] == $booking_time){
    //                array_push($available_doctor_by_day_and_time,$available_doctor_by_day_id);
    //            } 
    //        }
           
    //    if(count($all_doctors_list_by_today_id)>0){
    //        $time_slot_list= $this->getTimeSlot('60', $night_from_time, $night_to_time);
    //        // print_r($time_slot_list);
    //        foreach ($time_slot_list as $key => $time_slot) {
    //            if($time_slot['slot_start_time'] == $booking_time){
    //                array_push($available_doctor_by_day_and_time,$available_doctor_by_day_id);
    //            } 
    //        }
    //    }
    }
    return $today;
    }
 


    public function confirm_appointment_booking(Request $request){
        // return $request;
        $datetime_value=explode(' ',$request->datetime_value);
        // return $datetime_value;
        if(is_null($request->doctor_id)){
        $credentails = explode('|',$request->if_exact_date_time_not_matched); 
        $appointment_time_=explode('-',$credentails[1]);
        $doctor_id = $request->if_exact_date_time_not_matched;
        $appointment_data=[
            'doctor_id'=>$credentails[0],
            'patient_id'=>$request->patient_id,
            'appointment_date'=>$credentails[2],
            'appointment_time'=>$appointment_time_[0],
            'status'=>1,
            'created_at' => Carbon::now()
        ];


        }else{
        $doctor_id = $request->doctor_id;
        $appointment_data=[
            'doctor_id'=>$doctor_id,
            'patient_id'=>$request->patient_id,
            'appointment_date'=>$datetime_value[0],
            'appointment_time'=>$datetime_value[1],
            'status'=>1,
            'created_at' => Carbon::now()
        ];
        }
        
         // $doctor_id = is_null($request->doctor_id) ? $request->if_exact_date_time_not_matched : $request->doctor_id;
        // $appointment_data=[
        //     'doctor_id'=>$doctor_id,
        //     'patient_id'=>$request->patient_id,
        //     'appointment_date'=>$datetime_value[0],
        //     'appointment_time'=>$datetime_value[1],
        //     'status'=>1,
        //     'created_at' => Carbon::now()
        // ];
        $payment_link_id = Patient::find($request->patient_id)
        ->select('last_razorpay_payment_link_id')
        ->get();
        // dd($payment_link_id);
        $inserted_appointment_id = Appointment::insertGetId($appointment_data);

        $patient_payment_status = Patient_payment::where(['razorpay_payment_link_id'=>$payment_link_id[0]->last_razorpay_payment_link_id,'payment_status'=>"success"])
                                 ->update(['appointment_id'=>$inserted_appointment_id]);
            
            // if($patient_payment_status){
                $notification = array(
                    'message' => 'Appointment scheduled Successfully',
                    'alert-type' => 'success'
                ); 
               
            // return redirect()->route('patient.show',$request->patient_id)->with($notification);

            return response()->json(["status"=>"success", "data"=>$notification]);

            // }
            // return response()->json(["status"=>"failed", "data"=>"failed"]);

    }

    public function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i:s');
        $endTime = $end->format('H:i:s');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i:s', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $startTime = date('H:i:s', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time[$i]['slot_start_time'] = date('H:i:s', strtotime($start));
                $time[$i]['slot_end_time'] = date('H:i:s', strtotime($end));
            }
            $i++;
        }
        return $time;
    }

}
