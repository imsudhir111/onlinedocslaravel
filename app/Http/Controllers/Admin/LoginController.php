<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

ob_start();
require_once 'zoom_meeting/api.php';
include('zoom_meeting/config.php');

class LoginController extends Controller
{
    function zoom_meeting(Request $request){
        // view('zoom_meeting');
        $doctor = Doctor::find(7);
        session()->forget('ZOOM_API_KEY');
        session()->forget('ZOOM_API_SECRET');
        session()->forget('ZOOM_GMAIL_ID');

        $request->session()->put('ZOOM_API_KEY', $doctor->zoom_api_key);
        $request->session()->put('ZOOM_API_SECRET', $doctor->zoom_api_secret); 
        $request->session()->put('ZOOM_GMAIL_ID', $doctor->zoom_gmail_id); 
      
        $arr['topic']='Test by SHAHZAD';
        $arr['start_date']=date('2021-05-16 00:02:30');
        $arr['duration']=30;
        $arr['password']=rand(20000,200000);
        $arr['type']='2';
        // return $arr;
        $result=createMeeting($arr);
        // return $result;
        echo '<pre>';
        print_r($result);

        if(isset($result->id)){
            echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
            echo "Password: ".$result->password."<br/>";
            echo "Start Time: ".$result->start_time."<br/>";
            echo "Duration: ".$result->duration."<br/>";
        }else{
            echo '<pre>';
            print_r($result);
        }
        
    }
    public function login() {
        return view('backend.admin.auth.login');
    }

    public function authenticate(Request $request) {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {

            return redirect('/admin/dashboard');

        } else {
             return back()->withInput($request->only('email'))->with('message','Invalid Login credentials');
        }

    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
