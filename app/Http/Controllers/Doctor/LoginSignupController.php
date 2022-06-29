<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\State;
use Validator;
use Mail;

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
            $data['states']=State::All();
            // return $state;
            
             
            if(is_null(Auth::guard('doctor')->user()->name)){
            return view('backend.doctor.profile.create',$data);
            }
            return redirect('/doctor/dashboard');

        } else {
            $notification = array(
                'message' => 'Invalid Login details',
                'alert-type' => 'warning'
            );
            return back()->withInput($request->only('email'))->with($notification);
        }

    }

// doctor registration
public function signupform(Request $request){
   
    return view('backend.doctor.auth.signupform');
 }
 
 public function signup_process(Request $request){
    //  return $request;
     
    $this->validate($request,[
        'email' => 'required|email|unique:doctors,email',
        'password' => 'required|confirmed|min:4',
        'tnc' => 'required'
        ]);
        $doctor_id = Doctor::insertGetId([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if(isset($doctor_id)){
            $data=['name'=>'Doctor'];
            $user['to']=$request->email;
            // $user['from']='medonline@californiadigitals.com';
            Mail::send('mail.doctor_signup_welcome_mail', $data, function($messages) use ($user){
                $messages->to($user['to']);
                // $messages->to($user['from']);
                $messages->subject('Welcome To Online Docs');
            });
            return redirect('/doctor/login')->with('message', 'Signed Up successfully');
        }
 }
 







    public function logout() {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
