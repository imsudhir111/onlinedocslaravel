<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News_letter;

class NewsLetterController extends Controller
{
    //
    public function news_letter(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        $id = News_letter::insertGetId([
            'email' => $request->email,
        ]);
        if($id>0){
            $notification = array(
                'message' => 'News Letter Joined successfully',
                'alert-type' => 'success'
            ); 
        return response()->json(["status"=>"success", "data"=>$notification]);

        }else{
            $notification = array(
                'message' => 'Something went wrong please try again',
                'alert-type' => 'warning'
            ); 
            return response()->json(["status"=>"success", "data"=>$notification]);
  
        }

    }
    public function news_letter_emails(Request $request){
        $news_letter_subscribers_email = News_letter::all();

        return view('backend.admin.newsletter.index', compact('news_letter_subscribers_email'));
    }
}
