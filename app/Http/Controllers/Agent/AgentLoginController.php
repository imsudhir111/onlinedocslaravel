<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class AgentLoginController extends Controller
{
    //
    public function login() {
        return view('backend.agent.auth.login');
    }

    public function authenticate(Request $request) {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('agent')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {

            return redirect('/agent/dashboard');

        } else {
             return back()->withInput($request->only('email'))->with('message','Invalid Login credentials');
        }

    }

    public function logout() {
        Auth::guard('agent')->logout();
        return redirect()->route('agent.login');
    }
}
