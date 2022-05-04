<?php
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Mail;
class PasswordController extends Controller
{
    //

public function forgot_password(){
    return view('backend.admin.auth.passwords.forgot_password_form');

    // return view('frontend.passwords.forgot_password_form');

}

public function forgot_password_process(Request $request){
        $this->validate($request,[
            'forgot_password_email' => 'required|email'
         ]);

        $email_exist=Admin::where(['email'=>$request->post('forgot_password_email')])->get();
        if(isset($email_exist[0])){
            $rand_id=rand(111111111,999999999);
            Admin::where(['email'=>$request->forgot_password_email])
            ->update(['is_forgot_password'=>1,'rand_id'=>$rand_id]);
            $data=['name'=>'sudhir','rand_id'=>$rand_id];
            $user['to']=$request->post('forgot_password_email');
            Mail::send('mail.forgot_password_mail', $data, function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Reset Password');
            });
            return redirect('/admin/reset-password')->with('message', 'Please check your email id, password reset link sent');

        } else {
            return redirect('/admin/reset-password')->with('message', 'Email id not registerd');
         }
    }
    function forgot_password_process_change(Request $request,$id){
         $result = Admin::where(['rand_id'=>$id,'is_forgot_password'=>1])
                ->get();
        if(isset($result[0])){
            $request->session()->put('FORGOT_PASSWORD_USER_ID', $result[0]->id);
           return view('backend.admin.auth.passwords.forgot_password_update');
        } else{
            return redirect('/admin/login');
        }
    }
    function forgot_password_update(Request $request){
        $this->validate($request,[
            'password' => 'required|confirmed|min:4'
         ]);
        $result = Admin::where(['id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
        ->update(
            [
                'is_forgot_password'=>0,
                'password'=>Hash::make($request->post('password')),
                'rand_id'=>''
            ]
        );
        session()->forget('FORGOT_PASSWORD_USER_ID');
        return redirect('/admin/login')->with('message', 'Password Updated successfully');

        return response()->json(["status"=>"success", "msg"=>"Password Changed"]);
}




}
