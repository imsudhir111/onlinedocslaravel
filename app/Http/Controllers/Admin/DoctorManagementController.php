<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\State;
use App\Models\City;
class DoctorManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $doctor_lists = Doctor::all();
         return view('backend.admin.doctor.index', compact('doctor_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $profile_info = Doctor::select('id','name','email','mobile','photo','age','gender','highest_education','working_days','experience','address','state_id','city_id','zoom_gmail_id','zoom_api_key')
        ->find($id);
        $profile_info['city']=City::select('id','name')->where(['state_id'=>$profile_info->state_id,'id'=>$profile_info->city_id])->get();
        $profile_info['state']=State::where(['id'=>$profile_info->state_id])->get();
        // return $profile_info;
        return view('backend.admin.doctor.show', compact('profile_info'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function make_counsellor_active_deactive(Request $request){
    
        $active_status = Doctor::select('is_counsellor')
                         ->where(['id'=>$request->id])
                         ->get();
        $is_counsellor = $active_status[0]->is_counsellor;
     if($is_counsellor==1){
     $doctor_status=0;
     $notification = array(
        'message' => 'Counsellor Changed to Doctor successfuly',
        'alert-type' => 'Warning'
    );
     }else{
     $doctor_status=1;
     $notification = array(
        'message' => 'Doctor Changed to Counsellor successfuly',
        'alert-type' => 'Warning'
    );
    }
    $status = Doctor::where(['id'=>$request->id])->update(['is_counsellor'=>$doctor_status]);
    if($status){
    return response()->json(["status"=>"success", "data"=>$notification]);
    }
    return response()->json(["status"=>"error", "data"=>$notification]);
    
    
    }
}
