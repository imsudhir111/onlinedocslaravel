<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;

class AppointmentController extends Controller
{
    //
    public function myappointment() {
        $id = Auth::guard('doctor')->user()->id;
         $myappointment = Appointment::select('patient_id','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id, ])
        ->where('appointment_date','>=',date("Y-m-d"))
        ->where('appointment_date','<=',date("Y-m-d", strtotime("+2 day")))
       ->get();
      
        $mydate=getdate(date("U"));
        $myappointment['current_date']= Appointment::select('patient_id','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id, ])->where('appointment_date',date("Y-m-d"))
        ->get();
        $myappointment['current_date_plus1']= Appointment::select('patient_id','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id, ])->where('appointment_date',date("Y-m-d",strtotime("+1 day")))
        ->get();
        $myappointment['current_date_plus2']= Appointment::select('patient_id','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id, ])->where('appointment_date',date("Y-m-d", strtotime("+2 day")))
        ->get();

         return view('backend.doctor.pages.myappointment', compact('myappointment'));
     }
     public function all_appointment(){
        $id = Auth::guard('doctor')->user()->id;
        $allappointment = Appointment::select('patient_id','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id])
       ->get();
        // return response()->json(["status"=>"success", "data"=>$allappointment]);

        return view('backend.doctor.pages.allappointments', compact('allappointment'));
     }
     public function all_appointments_ajax(){
        $id = Auth::guard('doctor')->user()->id;
        $allappointment = Appointment::select('patient_id','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id])
       ->get();
        return response()->json(["status"=>"success", "data"=>$allappointment]);
     }
     public function datewise_appointment($date){
        $datewise_appointment= Appointment::with('patient:id,name')
        ->select('patient_id','appointment_date','service_name','appointment_time')
        ->where(['doctor_id'=>Auth::guard('doctor')->user()->id])->where('appointment_date','=', $date)
        ->get();
        // return $datewise_appointment;
    return view('backend.doctor.pages.datewise_appointment', compact('datewise_appointment'));
     }
     public function patient_detail($id,$date){
// return $id.$date;
        $patient_detail= Appointment::with('patient:id,name,photo,age,email,mobile,address,city,state')
        ->select('id as appointment_id','patient_id','service_name','appointment_date','service_name','appointment_time','doctor_remark')
        ->where(['doctor_id'=>Auth::guard('doctor')->user()->id,'patient_id'=>$id])->where('appointment_date','=', $date)
        ->get();
      //   return $patient_detail;
        return view('backend.doctor.pages.patient_details', compact('patient_detail'));
     }

   
 }
