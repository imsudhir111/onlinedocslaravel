<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class CounsellorController extends Controller
{
    //

    public function counsellors(){
        $counsellers=Doctor::select('name','highest_education','experience','photo')->where(['status'=>1])->get();
        return view('frontend.counsellors',compact('counsellers'));
    }
}
