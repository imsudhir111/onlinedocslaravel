<?php



namespace App\Http\Controllers\Customer;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Razorpay\Api\Api;

use Razorpay\Api\Errors\SignatureVerificationError;

use Illuminate\Support\Facades\Redirect;

use Exception;

use Carbon\Carbon;

use App\Models\Patient;

use App\Models\Doctor;

use App\Models\PatientPayment;

use App\Models\Appointment;

use App\Models\Service;

use Illuminate\Support\Facades\Mail;

use App\Mail\AppointmentBooking;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use App\Mail\SupportMail;

use App\Mail\PatientMail;



ob_start();

require_once 'zoom_meeting/api.php';





class PaymentController extends Controller

{



    function zoom_meeting($doctor_id,$date,$time){

        $doctor = Doctor::find($doctor_id);

        $start_date_time = $date.' '.$time;

        Session::forget('ZOOM_API_KEY');

        Session::forget('ZOOM_API_SECRET');

        Session::forget('ZOOM_GMAIL_ID');

        Session::put('ZOOM_API_KEY', $doctor->zoom_api_key);

        Session::put('ZOOM_API_SECRET', $doctor->zoom_api_secret_key);

        Session::put('ZOOM_GMAIL_ID', $doctor->zoom_gmail_id);

        $arr['topic']='Appointment Booking for Meeting';

        $arr['start_date']=date($start_date_time);

        $arr['duration']=60;

        $arr['password']=rand(20000,200000);

        $arr['type']='2';


        $result=createMeeting($arr);

        if(isset($result->id)){

            $result = $result;

        }else{

            $result = 0;

        }

        return $result;

    }



    public function payment(Request $request)

    {

        $validateData=$this->validate($request,[

                'full_name' => ['required','max:255'],

                'email' => 'required|email|regex:/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/|unique:patients,email,'.$request->user_id,

                'phone' => ['required','regex:/^[6789]\d{9}$/'],

                'datetime' => ['required'],

                'doctor_id' => ['required'],

                'billing_address' => ["required","regex:/^[#.0-9a-zA-Z\s,-]+$/"],

                'pin_code' => ['required','regex:/^[0-9]{6,6}$/'],

                'doc_upload' => ['max:3000','mimes:pdf,png,jpg,jpeg'],

            ],

            [

                'full_name.required' => 'Name is required',

                'email.required' => 'Email is required',

                'phone.required' => 'Phone number is required',

                'datetime.required' => 'Please select date and time',

                'doctor_id.required' => 'Please select slot date and time',

                'billing_address.required' => 'Billing address is required',

                'pin_code.required' => 'Pincode is required',

                'doc_upload.max' => 'File size should be less than 3MB',

                'doc_upload.mimes' => 'File format should be pdf,png,jpg,jpeg',

            ]

        );



        if($request->file('doc_upload')) {

            $file = $request->file('doc_upload');

            $filename = date('YmdHi') . "_" . $request->user_id . "_" . $file->getClientOriginalName();

            $file->move(public_path('upload/patient_record'), $filename);

            Session::put('doc_filename', $filename);

            $form_data['doc_upload'] = $filename;

        }


        $keyId = env('RAZORPAY_KEY');

        $keySecret = env('RAZORPAY_SECRET');



        $datetime_array = explode(" ",$request->datetime);



        $appointment_date = $datetime_array[0];

        $appointment_time = $datetime_array[1];

        $doctor_id = $request->doctor_id;



        $total_amount = 3499;

        if((Session::has('coupon_code')) && ($request->coupon_code != "")){

            $coupon_code = Session::get('coupon_code');

            $coupon_id = Session::get('coupon_id');

            $discount_amount = Session::get('discount_amount');

            $discounted_amount = ($total_amount - $discount_amount);

        }else if(!Session::has('coupon_code')){

            $coupon_code = "";

            $coupon_id = 0;

            $discount_amount = 0;

            $discounted_amount = ($total_amount - $discount_amount);

        }



        $form_data['coupon_id'] = $coupon_id;

        $form_data['coupon_code'] = $coupon_code;

        $form_data['total_amount'] = $total_amount;

        $form_data['discount_amount'] = $discount_amount;

        $form_data['discounted_amount'] = $discounted_amount;

        $form_data['full_name'] = $request->full_name;

        $form_data['email'] = $request->email;

        $form_data['phone'] = $request->phone;

        $form_data['billing_address'] = $request->billing_address;

        $form_data['pin_code'] = $request->pin_code;

        $form_data['service'] = "Online Appointment Booking";

        $form_data['order_id'] = uniqid();



        $update_patient_details = Patient::where('id',$request->user_id)->update([

            'name' => $request->full_name,

            'email' => $request->email,

            'mobile' => $request->phone,

            'address' => $request->billing_address,

            'pincode' => $request->pin_code,

        ]);



        $razorpayPaymentId ="";

        $paymentStatus ="PENDING";

        $service ="Online Appointment Booking";

        $orderData = [

            'receipt'         => $form_data['order_id'],

            'amount'          => $form_data['discounted_amount'] * 100, // 2000 rupees in paise

            'currency'        => 'INR',

            'payment_capture' => 1 // auto capture

        ];



        $api = new Api($keyId, $keySecret);



        $razorpayOrder = $api->order->create($orderData);



        $razorpayOrderId = $razorpayOrder['id'];



        Session::put('razorpay_order_id', $razorpayOrderId);



        $displayAmount = $amount = $orderData['amount'];



        $amount_in_rupees = $form_data['discounted_amount'];



        $data = [

            "key"               => $keyId,

            "amount"            => $amount,

            "name"              => "Online Docs",

            "description"       => $form_data['service'],

            "image"             => "",

            "prefill"           => [

            "name"              => $form_data['full_name'],

            "email"             => $form_data['email'],

            "contact"           => $form_data['phone'],

            ],

            "notes"             => [

            "address"           => "Online Payments",

            "merchant_order_id" => $form_data['order_id'],

            ],

            "theme"             => [

            "color"             => "#F37254"

            ],

            "order_id"          => $razorpayOrderId,

        ];



        $data['display_currency']  = 'INR';

        $data['display_amount']    = $amount_in_rupees;



        $payment_id = PatientPayment::insertGetId([

            'patient_id' => Auth::guard('patient')->user()->id,

            'name' => $request->full_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'billing_address' => $request->billing_address,

            'service' => $service,

            'total_amount' => $form_data['total_amount'],

            'discount_amount' =>  $form_data['discount_amount'],

            'discounted_amount' => $form_data['discounted_amount'],

            'coupon_id' => $form_data['coupon_id'],

            'coupon_code' => $form_data['coupon_code'],

            'razorpay_orderid' => $razorpayOrderId,

            'razorpay_paymentid' => $razorpayPaymentId,

            'payment_status' => $paymentStatus,

            'created_at' => Carbon::now()

        ]);



        $form_data['patient_id'] = Auth::guard('patient')->user()->id;

        $form_data['doctor_id'] = $doctor_id;

        $form_data['payment_id'] = $payment_id;

        $form_data['appointment_date'] = $appointment_date;

        $form_data['appointment_time'] = $appointment_time;



        return view('frontend.payment',compact('form_data','data'));

    }



    public function payment_process(Request $request)

    {

        $input = $request->all();

        $keyId = env('RAZORPAY_KEY');

        $keySecret = env('RAZORPAY_SECRET');

        $razorpayOrderId = Session::get('razorpay_order_id');


        $razorpayPaymentId = $input['razorpay_payment_id'];

        $email = $request->email;


        $success = true;

        $error = "Payment Failed";



        if(!empty($input['razorpay_payment_id']))

        {

            $api = new Api($keyId, $keySecret);

            try

            {

                $attributes = array(

                    'razorpay_order_id' => $razorpayOrderId,

                    'razorpay_payment_id' => $input['razorpay_payment_id'],

                    'razorpay_signature' => $input['razorpay_signature']

                );



                $api->utility->verifyPaymentSignature($attributes);



            }

            catch(\Exception $e)

            {

                $success = false;

                $error = 'Razorpay Error : ' . $e->getMessage();

            }

        }

         if($success === true){

            $paymentStatus = 'SUCCESS';

            $select_query = PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->where('razorpay_paymentid','!=','')->get();



            if (count($select_query) > 0) {

                $msg = "You have already submitted.";

            }

            else

            {

                $service_id = Session::get('service_id');

                $service_name = Session::get('service_name');

                $appointment_id = Appointment::insertGetId([

                    'doctor_id' => $request->doctor_id,

                    'patient_id' => Auth::guard('patient')->user()->id,

                    'service_id' => $service_id,

                    'service_name' => $service_name,

                    'appointment_date' => $request->appointment_date,

                    'appointment_time' => $request->appointment_time,

                    'status' => 1,

                    'created_at' => Carbon::now()

                ]);



                if(Session::has('doc_filename')){

                    $data = Appointment::find($appointment_id);

                    $filename = Session::get('doc_filename');

                    $data['patient_docs'] = $filename;

                    $data->save();

                    Session::forget('doc_filename');

                }



                PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->update([

                    'appointment_id' => $appointment_id,

                    'razorpay_paymentid' => $razorpayPaymentId,

                    'payment_status' => $paymentStatus,

                    'updated_at' => Carbon::now(),

                ]);

                $msg = "Your payment has been completed successfully...";



                $patient_details = Patient::where('id',$request->patient_id)->first();

                $doctor_details = Doctor::where('id',$request->doctor_id)->first();

                $appointment_details = Appointment::where('id',$appointment_id)->first();

                $payment_details = PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->first();



                $zoom_meeting_date = $appointment_details->appointment_date;

                $zoom_meeting_time = $appointment_details->appointment_time;


                $zoom_details = $this->zoom_meeting($request->doctor_id,$zoom_meeting_date,$zoom_meeting_time);


                if(isset($zoom_details->id)){

                    $zoom_details = $zoom_details;

                }

                else if($zoom_details==0){

                    $zoom_details = 0;

                }



                try {

                    // Email To Admin

                    Mail::to('support@onlinedocs.us')->send(new AppointmentBooking($patient_details,$doctor_details,$appointment_details,$payment_details,$zoom_details,1));

                } catch (\Exception $e) {

                    //dd("Error: ". $e->getMessage());

                }



                try {

                    // Email To Patient

                    Mail::to($patient_details->email)->send(new AppointmentBooking($patient_details,$doctor_details,$appointment_details,$payment_details,$zoom_details,2));

                } catch (\Exception $e) {

                    //dd("Error: ". $e->getMessage());

                }



                try {

                    // Email To Doctor

                    Mail::to($doctor_details->email)->send(new AppointmentBooking($patient_details,$doctor_details,$appointment_details,$payment_details,$zoom_details,3));

                } catch (\Exception $e) {

                    //dd("Error: ". $e->getMessage());

                }



                Session::forget('service_id');

                Session::forget('service_name');

                Session::forget('coupon_code');

                Session::forget('coupon_id');

                Session::forget('discount_amount');



                return redirect('/thanks/'.$appointment_id);

            }

        }else{

            $paymentStatus = 'FAILURE';



            if(Session::has('doc_filename')){

                $filename = Session::get('doc_filename');

                @unlink(public_path('upload/patient_record/' . $filename));

                Session::forget('doc_filename');

            }



            Session::forget('coupon_code');

            Session::forget('coupon_id');

            Session::forget('discount_amount');



            PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->update([

                'razorpay_paymentid' => $razorpayPaymentId,

                'payment_status' => $paymentStatus,

                'updated_at' => Carbon::now()

            ]);

            $msg = "Your payment has been failed.";

            return redirect()->route('failed');

        }

    }



    public function thanks($id)

    {

        $appointment_details = Appointment::with('patient')->where('id',$id)->first();

        return view('frontend.patient.thanks',compact('appointment_details'));

    }



    public function failed()

    {

        return view('frontend.patient.failed');

    }



    public function direct_payment(Request $request)

    {

        $patient_details_check = Patient::where('email',$request->email)->first();



        if(isset($patient_details_check->id)){

            $validateData=$this->validate($request,[

                    'service' => ['required'],

                    'full_name' => ['required','max:255'],

                    'email' => 'required|email|regex:/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/|unique:patients,email,'.$patient_details_check->id,

                    'phone' => ['required','regex:/^[6789]\d{9}$/'],

                    'datetime' => ['required'],

                    'doctor_id' => ['required'],

                    'billing_address' => ["required","regex:/^[#.0-9a-zA-Z\s,-]+$/"],

                    'pin_code' => ['required','regex:/^[0-9]{6,6}$/'],

                    'doc_upload' => ['max:3000','mimes:pdf,png,jpg,jpeg'],

                ],

                [

                    'service.required' => 'Service is required',

                    'full_name.required' => 'Name is required',

                    'email.required' => 'Email is required',

                    'phone.required' => 'Phone number is required',

                    'datetime.required' => 'Please select date and time',

                    'doctor_id.required' => 'Please select slot date and time',

                    'billing_address.required' => 'Billing address is required',

                    'pin_code.required' => 'Pincode is required',

                    'doc_upload.max' => 'File size should be less than 3MB',

                    'doc_upload.mimes' => 'File format should be pdf,png,jpg,jpeg',

                ]

            );



            $update_patient_details = Patient::where('id',$patient_details_check->id)->update([

                'name' => $request->full_name,

                'mobile' => $request->phone,

                'address' => $request->billing_address,

                'pincode' => $request->pin_code

            ]);



            Auth::guard('patient')->login($patient_details_check);

            $patient_id = $patient_details_check->id;

        }

        else{

            $validateData=$this->validate($request,[

                    'service' => ['required'],

                    'full_name' => ['required','max:255'],

                    'email' => ['required','email','regex:/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/','unique:patients'],

                    'phone' => ['required','regex:/^[6789]\d{9}$/'],

                    'datetime' => ['required'],

                    'doctor_id' => ['required'],

                    'billing_address' => ["required","regex:/^[a-zA-Z0-9\s,'-]*$/"],

                    'pin_code' => ['required','regex:/^[0-9]{6,6}$/'],

                    'doc_upload' => ['max:100','mimes:pdf,png,jpg,jpeg'],

                ],

                [

                    'service.required' => 'Service is required',

                    'full_name.required' => 'Name is required',

                    'email.required' => 'Email is required',

                    'phone.required' => 'Phone number is required',

                    'datetime.required' => 'Please select date and time',

                    'doctor_id.required' => 'Please select slot date and time',

                    'billing_address.required' => 'Billing address is required',

                    'pin_code.required' => 'Pincode is required',

                    'doc_upload.max' => 'File size should be less than 100KB',

                    'doc_upload.mimes' => 'File format should be pdf,png,jpg,jpeg',

                ]

            );

            $request->password = rand(000000,999999);

            $patient_id = Patient::insertGetId([

                'name' => $request->full_name,

                'email' => $request->email,

                'mobile' => $request->phone,

                'address' => $request->billing_address,

                'pincode' => $request->pin_code,

                'password' => Hash::make($request->password),

                'created_at' => Carbon::now()

            ]);



            $patient_details = Patient::where('id',$patient_id)->first();

            Auth::guard('patient')->login($patient_details);



            try {

                // Email To Patient

                Mail::to($request->email)->send(new PatientMail($request->full_name));

            } catch (\Exception $e) {

                //dd("Error: ". $e->getMessage());

            }



        }



        if($request->file('doc_upload')) {

            $file = $request->file('doc_upload');

            $filename = date('YmdHi') . "_" . $patient_id . "_" . $file->getClientOriginalName();

            $file->move(public_path('upload/patient_record'), $filename);

            Session::put('doc_filename', $filename);

            $form_data['doc_upload'] = $filename;

        }


        $keyId = env('RAZORPAY_KEY');

        $keySecret = env('RAZORPAY_SECRET');



        $datetime_array = explode(" ",$request->datetime);



        $appointment_date = $datetime_array[0];

        $appointment_time = $datetime_array[1];

        $doctor_id = $request->doctor_id;



        $total_amount = 3499;

        if((Session::has('coupon_code')) && ($request->coupon_code != "")){

            $coupon_code = Session::get('coupon_code');

            $coupon_id = Session::get('coupon_id');

            $discount_amount = Session::get('discount_amount');

            $discounted_amount = ($total_amount - $discount_amount);

        }else if(!Session::has('coupon_code')){

            $coupon_code = "";

            $coupon_id = 0;

            $discount_amount = 0;

            $discounted_amount = ($total_amount - $discount_amount);

        }



        $form_data['coupon_id'] = $coupon_id;

        $form_data['coupon_code'] = $coupon_code;

        $form_data['total_amount'] = $total_amount;

        $form_data['discount_amount'] = $discount_amount;

        $form_data['discounted_amount'] = $discounted_amount;

        $form_data['full_name'] = $request->full_name;

        $form_data['email'] = $request->email;

        $form_data['phone'] = $request->phone;

        $form_data['billing_address'] = $request->billing_address;

        $form_data['pin_code'] = $request->pin_code;

        $form_data['service'] = "Online Appointment Booking";

        $form_data['order_id'] = uniqid();


        $razorpayPaymentId ="";

        $paymentStatus ="PENDING";

        $service ="Online Appointment Booking";



        $orderData = [

            'receipt'         => $form_data['order_id'],

            'amount'          => $form_data['discounted_amount'] * 100, // 2000 rupees in paise

            'currency'        => 'INR',

            'payment_capture' => 1 // auto capture

        ];



        $api = new Api($keyId, $keySecret);



        $razorpayOrder = $api->order->create($orderData);



        $razorpayOrderId = $razorpayOrder['id'];



        Session::put('razorpay_order_id', $razorpayOrderId);



        $displayAmount = $amount = $orderData['amount'];



        $amount_in_rupees = $form_data['discounted_amount'];



        $data = [

            "key"               => $keyId,

            "amount"            => $amount,

            "name"              => "Online Docs",

            "description"       => $form_data['service'],

            "image"             => "",

            "prefill"           => [

            "name"              => $form_data['full_name'],

            "email"             => $form_data['email'],

            "contact"           => $form_data['phone'],

            ],

            "notes"             => [

            "address"           => "Online Payments",

            "merchant_order_id" => $form_data['order_id'],

            ],

            "theme"             => [

            "color"             => "#F37254"

            ],

            "order_id"          => $razorpayOrderId,

        ];



        $data['display_currency']  = 'INR';

        $data['display_amount']    = $amount_in_rupees;



        $payment_id = PatientPayment::insertGetId([

            'patient_id' => $patient_id,

            'name' => $request->full_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'billing_address' => $request->billing_address,

            'service' => $service,

            'total_amount' => $form_data['total_amount'],

            'discount_amount' =>  $form_data['discount_amount'],

            'discounted_amount' => $form_data['discounted_amount'],

            'coupon_id' => $form_data['coupon_id'],

            'coupon_code' => $form_data['coupon_code'],

            'razorpay_orderid' => $razorpayOrderId,

            'razorpay_paymentid' => $razorpayPaymentId,

            'payment_status' => $paymentStatus,

            'created_at' => Carbon::now()

        ]);
//update razorpay_orderid to patient table
        Patient::where('id',$patient_id)->update([
        'razorpay_orderid'=>Session::get('razorpay_order_id')
        ]);

        $form_data['patient_id'] = $patient_id;

        $form_data['doctor_id'] = $doctor_id;

        $form_data['payment_id'] = $payment_id;

        $form_data['service_id'] = $request->service;

        $form_data['appointment_date'] = $appointment_date;

        $form_data['appointment_time'] = $appointment_time;



        return view('frontend.direct_payment',compact('form_data','data'));

    }





    public function direct_payment_process(Request $request)

    {

        $input = $request->all();




        $keyId = env('RAZORPAY_KEY');

        $keySecret = env('RAZORPAY_SECRET');

        $razorpayOrderId = Session::get('razorpay_order_id');

        $razorpayPaymentId = $input['razorpay_payment_id'];

        $email = $request->email;


        $success = true;

        $error = "Payment Failed";



        if(!empty($input['razorpay_payment_id']))

        {

            $api = new Api($keyId, $keySecret);

            try

            {

                $attributes = array(

                    'razorpay_order_id' => $razorpayOrderId,

                    'razorpay_payment_id' => $input['razorpay_payment_id'],

                    'razorpay_signature' => $input['razorpay_signature']

                );



                $api->utility->verifyPaymentSignature($attributes);



            }

            catch(\Exception $e)

            {

                $success = false;

                $error = 'Razorpay Error : ' . $e->getMessage();

            }

        }



        if($success === true){

            $paymentStatus = 'SUCCESS';

            $select_query = PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->where('razorpay_paymentid','!=','')->get();



            if (count($select_query) > 0) {

                $msg = "You have already submitted.";

            }

            else

            {


                $service = Service::where('id',$request->service_id)->first();



                $patient_id = Auth::guard('patient')->user()->id;

                        // dd(session::get('razorpay_order_id'));

               $check_if_slot_available = Appointment::where([
                    'doctor_id' => $request->doctor_id,
                    'appointment_date' => $request->appointment_date,
                    'appointment_time' => $request->appointment_time
                ]);
                    if($check_if_slot_available->count()>0){
                        $msg="Your selected slot is not available please try new slot";
                        $services = Service::orderBy('id', 'ASC')->get();
                        // return session::get('razorpay_order_id');
                        $patientid= PatientPayment::select('patient_id')
                       ->where(['razorpay_orderid'=>session::get('razorpay_order_id'),
                        'payment_status'=>'SUCCESS'])->get();
                        // return $patientid;

                       // $patient_saved_details=Patient::where(['id'=>$patientid])->get();
                          // return $patient_saved_details;
                          return view('frontend.reschedule_booking_payment_done',compact('services'));

                    } 

                     $appointment_id = Appointment::insertGetId([

                    'doctor_id' => $request->doctor_id,

                    'patient_id' => Auth::guard('patient')->user()->id,

                    'service_id' => $service->id,

                    'service_name' => $service->service_name,

                    'appointment_date' => $request->appointment_date,

                    'appointment_time' => $request->appointment_time,

                    'status' => 1,

                    'created_at' => Carbon::now()

                ]);



                if(Session::has('doc_filename')){

                    $data = Appointment::find($appointment_id);

                    $filename = Session::get('doc_filename');

                    $data['patient_docs'] = $filename;

                    $data->save();

                    Session::forget('doc_filename');

                }



                PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->update([

                    'appointment_id' => $appointment_id,

                    'razorpay_paymentid' => $razorpayPaymentId,

                    'payment_status' => $paymentStatus,

                    'updated_at' => Carbon::now(),

                ]);

                $msg = "Your payment has been completed successfully...";



                $patient_details = Patient::where('id',$request->patient_id)->first();

                $doctor_details = Doctor::where('id',$request->doctor_id)->first();

                $appointment_details = Appointment::where('id',$appointment_id)->first();

                $payment_details = PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->first();



                $zoom_meeting_date = $appointment_details->appointment_date;

                $zoom_meeting_time = $appointment_details->appointment_time;



                $zoom_details = $this->zoom_meeting($request->doctor_id,$zoom_meeting_date,$zoom_meeting_time);

                if(isset($zoom_details->id)){

                    $zoom_details = $zoom_details;

                }

                else if($zoom_details==0){

                    $zoom_details = 0;

                }



                try {

                    // Email To Admin

                    Mail::to('support@onlinedocs.us')->send(new AppointmentBooking($patient_details,$doctor_details,$appointment_details,$payment_details,$zoom_details,1));

                } catch (\Exception $e) {

                    //dd("Error: ". $e->getMessage());

                }



                try {

                    // Email To Patient

                    Mail::to($patient_details->email)->send(new AppointmentBooking($patient_details,$doctor_details,$appointment_details,$payment_details,$zoom_details,2));

                } catch (\Exception $e) {

                    //dd("Error: ". $e->getMessage());

                }



                try {

                    // Email To Doctor

                    Mail::to($doctor_details->email)->send(new AppointmentBooking($patient_details,$doctor_details,$appointment_details,$payment_details,$zoom_details,3));

                } catch (\Exception $e) {

                    //dd("Error: ". $e->getMessage());

                }



                Session::forget('coupon_code');

                Session::forget('coupon_id');

                Session::forget('discount_amount');



                return redirect('/thanks/'.$appointment_id);

            }

        }else{

            $paymentStatus = 'FAILURE';



            if(Session::has('doc_filename')){

                $filename = Session::get('doc_filename');

                @unlink(public_path('upload/patient_record/' . $filename));

                Session::forget('doc_filename');

            }



            Session::forget('coupon_code');

            Session::forget('coupon_id');

            Session::forget('discount_amount');



            PatientPayment::where('email',$email)->where('razorpay_orderid',$razorpayOrderId)->update([

                'razorpay_paymentid' => $razorpayPaymentId,

                'payment_status' => $paymentStatus,

                'updated_at' => Carbon::now()

            ]);

            $msg = "Your payment has been failed.";

            return redirect()->route('failed');

        }


    }

}

