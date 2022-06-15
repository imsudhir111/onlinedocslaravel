<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Doctor;

class PasswordController extends Controller
{
    //
    public function change_doctor_password(){

        return view('backend.doctor.pages.changepassword');

    }
    public function change_doctor_password_update(Request $request){
        $this->validate($request,[
            'password' => 'required|confirmed|min:4'
         ]);
          $id = Auth::guard('doctor')->user()->id;

        $result = Doctor::where(['id'=>Auth::guard('doctor')->user()->id])
        ->update(['password'=>Hash::make($request->post('password'))]);

        return redirect('/doctor/dashboard')->with('message', 'Password Updated successfully');

        return response()->json(["status"=>"success", "msg"=>"Password Changed"]);
    }
    
    public function forgot_password(){
        return view('backend.doctor.auth.forgotpassword');
    }
}
