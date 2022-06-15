<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class DoctorRemarkController extends Controller
{
    //
    public function doctor_save_remark(Request $request){
        $validated = $request->validate([
           'doctor_remark' => 'required',
        ]);
        $form_data = explode('|', $request->doctor_remark);
       
        if($form_data[0] == ''){
            return response()->json(["status"=>"no_data", "data"=>'This field is required']);
        }else{
            $doctor_remark=[
                'doctor_remark'=>$form_data[0]
            ];
        $status = Appointment::find($form_data[1])->update($doctor_remark);
        if($status){
        return response()->json(["status"=>"success", "data"=>'Remark added successfully']);
        }
        return response()->json(["status"=>"success", "data"=>'Smething went wrong']);
    }
     }
}
