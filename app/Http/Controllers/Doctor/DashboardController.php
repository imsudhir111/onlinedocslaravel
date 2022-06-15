<?php

namespace App\Http\Controllers\Doctor;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class DashboardController extends Controller
{
    // Step 6: Created DashboardController for doctor
     
    public function dashboard() {
        $id = Auth::guard('doctor')->user()->id;
        $latest_four_appointment = Appointment::with('patient:id,name')
        ->select('id','patient_id','service_id','service_name','appointment_date','appointment_time')
        ->where(['doctor_id'=>$id])
        ->orderBy('id','DESC')
        ->limit(4)
        ->get();
       return view('backend.doctor.pages.dashboard', compact('latest_four_appointment'));
    }
}
