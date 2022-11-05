<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }

     /**
      * Store Enquiry in Contacts Table
      *
      */
     public function sendEnquiry(Request $request)
     {
          $data = $request->all();
          $rules = [
               'name' => 'required',
               'email' => 'required|email',
               'message' => 'required'
          ];
          $validator = \Validator::make($data, $rules);

          // Validate the input and return correct response
          if ($validator->fails()) {
               return \Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()

               ), 200); // 400 being the HTTP code for an invalid request.
          }

          $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
               'secret' => env('RECAPTCHA_SECRET_KEY'),
               'response' => $request->recaptchaToken,
          ]);
          $recaptchaResponse = $response->json();
          if ($recaptchaResponse['success'] == true) {
               Contact::create($data);


               $message = [
                    'success' => true,
               ];
               Session::flash('contact-msg', 'Will Contact you soon');
               return response()->json($message, 200);
          } else {
               $recaptchaFail = 'Something went wrong !';
               return response()->json($recaptchaFail, 200);
          }
     }
}
$url = "URL:https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$userIP";
