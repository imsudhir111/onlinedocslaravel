<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Step 6: Created DashboardController for doctor
    public function dashboard() {
       return view('backend.doctor.dashboard');
    }
}
