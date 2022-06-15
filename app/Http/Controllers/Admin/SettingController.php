<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class SettingController extends Controller
{
    //
    public function add_zoom_setting(){
        $add_zoom_setting['doctor_list']=Doctor::select('id','name')
         ->whereNotNull('name')
        ->get();
         return view('backend.admin.setting.add_zoom_setting', $add_zoom_setting);

    }
    public function update_zoom_setting(Request $request){
        $validated = $request->validate([
            'selected_doctor'=>'required',
            'zoom_api_key' => 'required',
            'zoom_api_secret_key' => 'required'
        ]);
      
        $zoom_setting=[
            'zoom_api_key' => $request->zoom_api_key,
            'zoom_api_secret_key'=> $request->zoom_api_secret_key,
        ];
        $status = Doctor::find($request->selected_doctor)->update($zoom_setting);
        if($status){
            $notification = array(
                'message' => 'Zoom Setting Added Successfully',
                'alert-type' => 'success'
            );
          return  redirect()->route('admin.dashboard')->with($notification);
        }

    }
}
