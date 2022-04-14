<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
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
            session()->flash('error','Either Email/Password is incorrect');
            return back()->withInput($request->only('email'));
        }

    }

    public function logout() {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
