<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    //
    public function dashboard() {
        return view('backend.agent.pages.dashboard');
     }
}
