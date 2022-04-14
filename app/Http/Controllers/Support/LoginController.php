<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function login() {
        return view('backend.support.auth.login');
    }

    public function authenticate(Request $request) {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('support')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {

            return redirect('/support/dashboard');

        } else {
            session()->flash('error','Either Email/Password is incorrect');
            return back()->withInput($request->only('email'));
        }

    }

    public function logout() {
        Auth::guard('support')->logout();
        return redirect()->route('support.login');
    }
}
