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

class BookAppointmentController extends Controller
{
    //
    public function book_appointment(){
        $day_from_time='10:00:00';
        $day_to_time='12:00:00';
        $booking_time='10:00:00';
        $booking_day='Thursday';
        $appointment_date='2022-06-23';
        $available_doctors_by_booking_times = Doctor::select('id','working_days')
        ->where('day_from_time','<=',$booking_time)
        ->get();
        return $available_doctors_by_booking_times[0]['id'];
        //  return json_decode($available_doctor[0]->working_days);
        //  $time_slot_list= $this->getTimeSlot('60', $day_from_time, $day_to_time);
        // $result = array_search($booking_time,$time_slot_list);

    //    foreach ($time_slot_list as $key => $time_slot) {
    //     if($time_slot['slot_start_time'] == $booking_time){
    //         print_r($time_slot['slot_start_time']);
    //     }else{
    //     echo 'no,';
    //     }
    // }
    //    return $time_slot_list;
    //    return $time_slot_list[0]['slot_start_time'];
        
        // return $day_from_time;

        // return $available_doctors_by_booking_times;
        $available_doctor_by_day_ids=[];

foreach ($available_doctors_by_booking_times as $available_doctors_by_booking_time) {
    foreach (json_decode($available_doctors_by_booking_time->working_days) as $key => $doctor_availabity) {
        if($key==$booking_day && $doctor_availabity == 1){
            array_push($available_doctor_by_day_ids,$available_doctor['id']);
        }
    }
}

return $available_doctor_by_day_ids;
$available_doctor_by_day_and_time=[];
foreach ($available_doctor_by_day_ids as $available_doctor_by_day_id) {
    //  print_r($available_doctor_by_day_id);
     $time_slot_list= $this->getTimeSlot('60', $day_from_time, $day_to_time);
     foreach ($time_slot_list as $key => $time_slot) {
            if($time_slot['slot_start_time'] == $booking_time){
                array_push($available_doctor_by_day_and_time,$available_doctor_by_day_id);
            } 
        }
}

foreach ($available_doctor_by_day_and_time as $key=>$available_doctor_by_day_and_time_id) {
   $check_appointment = Appointment::where(['doctor_id'=>$available_doctor_by_day_and_time_id,'appointment_date'=>$appointment_date,'appointment_time'=>$booking_time])->get();
    print_r($check_appointment[0]->doctor_id);
    unset($available_doctor_by_day_and_time[$key]);

}



     return $available_doctor_by_day_and_time;

        // $doctor_list = json_decode($available_doctor[1]->working_days);
        // return $doctor_list;
        // return gettype($doctor_list);
        // return $available_doctor;
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
