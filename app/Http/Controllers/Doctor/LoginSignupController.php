<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use Validator;

class LoginSignupController extends Controller
{
    //Step 5: Created LoginController for doctor
    public function login() {
        return view('backend.doctor.auth.login');
    }

    public function authenticate(Request $request) {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {

            return redirect('/doctor/dashboard');

        } else {
            return back()->withInput($request->only('email'))->with('message', 'Invalid Login details');
        }

    }

// doctor registration
public function signupform(Request $request){
   
    return view('backend.doctor.signupform');
 }
 
 public function signup_process(Request $request){
    $this->validate($request,[
        'email' => 'required|email|unique:doctors,email',
        'password' => 'required|confirmed|min:4'
        ]);
        $doctor_id = Doctor::insertGetId([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if(isset($doctor_id)){
            return redirect('/doctor/login')->with('message', 'Signed Up successfully');
        }
 }
 







    public function logout() {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
