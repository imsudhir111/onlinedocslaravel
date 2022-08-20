<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorWorkingHour;

class CounsellorController extends Controller
{
    //

    public function counsellors(){
        $counsellers=Doctor::select('id','name','highest_education','experience','photo')->where(['status'=>1, 'is_counsellor'=>1])->get();
        return view('frontend.counsellors',compact('counsellers'));
    }
    public function counselor_detail($id){
        $counsellor_detail['doctor_info']=Doctor::select('id','name','highest_education','experience','photo','working_days')->where(['id'=>$id,'status'=>1,'is_counsellor'=>1])->get();
        $counsellor_detail['doctor_working_hours']=DoctorWorkingHour::select('fromTime','toTime')
                                                   ->where(['doctor_id'=>$id])
                                                   ->get();
        // return $counsellor_detail;
        return view('frontend.counselor-detail', $counsellor_detail);
    }
    
}
