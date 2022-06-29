<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorWorkingHour;
use App\Models\Doctor;
use App\Models\State;
use App\Models\City;
use Carbon\Carbon;

class DoctorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::guard('doctor')->user()->id;
        $profile_info = Doctor::find($id);
        // return $profile_info->working_days;
        // return $profile_info->state_id;
        $profile_info['city']=City::where(['state_id'=>$profile_info->state_id,'id'=>$profile_info->city_id])->get();
        $profile_info['state']=State::where(['id'=>$profile_info->state_id])->get();
        if(isset($profile_info->name)){
            return view('backend.doctor.profile.index', compact('profile_info'));
        }
        $data['states']=State::All();
        // return $state;
        return view('backend.doctor.profile.create',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'hi doctor';
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
        // return $request;
        $lastname=explode(' ',$request->full_name);
        $id = Auth::guard('doctor')->user()->id;
         if(isset($lastname[1])){
             $zoom_gmail_id=$lastname[1].$id.'.onlinedocs@gmail.com';
             $zoom_gmail_password='Onlinedocs@123';
            //  return $zoom_gmail_id.$zoom_gmail_password;
         }else{
            $zoom_gmail_id=$lastname[0].$id.'.onlinedocs@gmail.com';
            $zoom_gmail_password='Onlinedocs@123';
            // return 'elsepart'.$zoom_gmail_id.$zoom_gmail_password;

         }

 
        $validated = $request->validate([
            'full_name' => 'required',
            'email'=> 'required',
            'dob' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits:10',
            'profile_image' => 'mimes:png,jpeg,jpg',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'highest_education' => 'required',
            'professional_experience' => 'required',
            'working_days' =>'required',
            'day_from_time' => 'required',
            'day_to_time' => 'required', 
            'night_from_time' => 'required',
            'night_to_time' => 'required',
        ]);
        $working_days=[
            'Monday'=>isset($request->working_days["'Monday'"]) ? '1' : '0',
            'Tuesday'=>isset($request->working_days["'Tuesday'"]) ? '1' : '0',
            'Wednesday'=>isset($request->working_days["'Wednesday'"]) ? '1' : '0',
            'Thursday'=>isset($request->working_days["'Thursday'"]) ? '1' : '0',
            'Friday'=>isset($request->working_days["'Friday'"]) ? '1' : '0',
            'Saturday'=>isset($request->working_days["'Saturday'"]) ? '1' : '0',
            'Sunday'=>isset($request->working_days["'Sunday'"]) ? '1' : '0'
        ];
      
        $doctor_profile=[
        'name' => $request->full_name,
        'email'=> $request->email,
        'age' => $request->age,
        'gender' => $request->gender,
        'mobile' => $request->phone,
        'address' => $request->address,
        'state_id' => $request->state,
        'city_id' => $request->city,
        'highest_education' => $request->highest_education,
        'experience' => $request->professional_experience,
        'working_days' => $working_days,
        'day_from_time' => $request->day_from_time,
        'day_to_time' => $request->day_to_time,
        'night_from_time' => $request->night_from_time,
        'night_to_time' => $request->night_to_time,
        'zoom_gmail_id'=>$zoom_gmail_id,
        'zoom_gmail_password'=>Hash::make($zoom_gmail_password),
        'updated_at' => Carbon::now()
        ];         

        $status = Doctor::find($id)->update($doctor_profile);
        DoctorWorkingHour::insert([
            [
            'doctor_id' => $id,
            'fromTime' => $request->day_from_time,
            'ToTime' => $request->day_to_time,
        ],[
            'doctor_id' => $id,
            'fromTime' => $request->night_from_time,
            'ToTime' => $request->night_to_time,
        ]]);

        if($request->hasFile('profile_image')) {
            $data = Doctor::find($id);
            $file = $request->file('profile_image');
            @unlink(public_path('upload/profile_image/' . $data->profile_image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/profile_image'), $filename);
            $data['photo'] = $filename;
            $data->save();
        }
        if($status){
            $notification = array(
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('doctor.dashboard')->with($notification);
            return redirect('/doctor/dashboard')->with('message', 'Successfully updated');
        }else{
            return redirect('/admin/reset-password')->with('message', 'Please check something went wrong !!');
        }
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
        $profile_info = Doctor::find($id);
        $profile_info['profile_info']=$profile_info;
        $profile_info['states']=State::All();
        $profile_info['city']=City::All();
                                            
        // return $profile_info->states;
        // return $profile_info;
        if(isset($profile_info->name)){
            // return view('backend.doctor.profile.edit', compact('profile_info'));
            return view('backend.doctor.profile.edit', $profile_info);
        }
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
        // return $request;
        $validated = $request->validate([
            'full_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'working_days' =>'required',
            'highest_education' => 'required',
            'professional_experience' => 'required',
        ]);
      
        $working_days=[
            'Monday'=> isset($request->working_days['Monday']) ? '1' : '0',
            'Tuesday'=> isset($request->working_days['Tuesday']) ? '1' : '0',
            'Wednesday'=> isset($request->working_days['Wednesday']) ? '1' : '0',
            'Thursday'=> isset($request->working_days['Thursday']) ? '1' : '0',
            'Friday'=> isset($request->working_days['Friday']) ? '1' : '0',
            'Saturday'=> isset($request->working_days['Saturday']) ? '1' : '0',
            'Sunday'=> isset($request->working_days['Sunday']) ? '1' : '0'
        ];
        $doctor_profile=[
        'name' => $request->full_name,
        'age' => $request->age,
        'gender' => $request->gender,
        'mobile' => $request->phone,
        'address' => $request->address,
        'state_id' => $request->state,
        'city_id' => $request->city,
        'highest_education' => $request->highest_education,
        'experience' => $request->professional_experience,
        'working_days' => $working_days,
        'day_from_time' => $request->day_from_time,
        'day_to_time' => $request->day_to_time,
        'night_from_time' => $request->night_from_time,
        'night_to_time' => $request->night_to_time,
        'updated_at' => Carbon::now()
        ];     
        $profile_update_status = Doctor::find($id)->update($doctor_profile);
        if($request->hasFile('profile_image')){
            $data = Doctor::find($id);
            $profile_img=$request->file('profile_image');
            @unlink(public_path('upload/profile_image/' . $data->profile_image));
            $filename = date('YmdHi') . $profile_img->getClientOriginalName();
            $profile_img->move(public_path('upload/profile_image'), $filename);
            $data['photo'] = $filename;
            $data->save();
        }
        $working_hours = [
            [
            'fromTime' => $request->day_from_time,
            'ToTime' => $request->day_to_time,
        ],[
            'fromTime' => $request->night_from_time,
            'ToTime' => $request->night_to_time,
        ]]; 


        $morning_shift= DoctorWorkingHour::where('doctor_id', '=', $id)->first();
        $evening_shift= DoctorWorkingHour::where('doctor_id', '=', $id)->latest('id')->first();
        $evening_shift->fromTime=$request->night_from_time;
        $evening_shift->toTime=$request->night_to_time;
        $morning_shift->fromTime=$request->day_from_time;
        $morning_shift->toTime=$request->day_to_time;
        if($evening_shift->save() && $morning_shift->save()){
            if($profile_update_status){
                $notification = array(
                    'message' => 'Profile Updated Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect('/doctor/profile')->with($notification);
            }else{
                return redirect('/admin/reset-password')->with('message', 'Please check something went wrong !!');
            }
        }
      
    }

    function getstate(Request $request){
        $state=State::All();
        return $state;
        $state=DB::table('states')->orderBy('state','asc')->get();
        $html='<option value="">select state</option>';
       
       foreach ($state as $list){
         $html.='<option value="'.$list->id.'">'.$list->state.'</option>';
       }
       echo $html;
 
  }
    function getcity(Request $request){
        $state_id= $request->state_id;
        $city=City::where('state_id', $state_id)->get();
        $html='<option value="">select city</option>';
       
          foreach ($city as $list){
            $html.='<option value="'.$list->id.'">'.$list->name.'</option>';
          }
          echo $html;
     }
     
     function zoom_meeting_setting(){
     
        return view('backend.doctor.pages.zoom_meeting_setting');
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
}
