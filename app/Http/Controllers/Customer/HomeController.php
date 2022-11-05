<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Question;
use App\Models\Option;
use App\Models\Patient;
use App\Models\PatientAnswer;
use App\Models\PatientAnswerDetail;
use App\Models\Doctor;
use App\Models\DoctorWorkingHour;
use App\Models\Appointment;
use App\Models\CouponCode;
use App\Models\PatientPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mail;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function trial_report1(){
        return redirect('/trial/report');
    }
    public function index()
    {
        $services = Service::whereIn('id', [1, 5, 6, 9])->orderBy('id', 'ASC')->limit(4)->get(); 
        // Warning : Service ids 1, 5, 6, 9 are used to show services of small name on the home page. If the above ids are changed then an error will occur.
        return view('frontend.home',compact('services'));
    }

    public function sitemap(){
        return  response('sitemap.sitemap')->withHeaders([
            'Content-Type' => 'TEXT/XML'
        ]);
    }

    public function trial_report()
    {
        $services = Service::where('service_name','!=','OTHERS')->orderBy('id', 'ASC')->get();
        $div_logic_array = ['golden', 'gray', 'gray', 'golden', 'golden', 'gray', 'gray', 'golden', 'golden', 'gray', 'gray', 'golden']; 
        // Warning : Do not change the div_logic_array and row_logic_array. If you changed these an error will occur.
        $row_logic_array = [
            'anxiety' => 'anxiety',
            'alcohol use disorder' => 'alcohol',
            'behavioral and emotional disorders in children/teenagers' => 'behaviour',
            'bipolar disorder' => 'bipolar',
            'depression' => 'DEPRESSION',
            'dissociation' => 'DISSOCIATION',
            'eating disorders' => 'eatingDisorder',
            'obsessive compulsive disorder' => 'ocd',
            'paranoia' => 'PARANOIA',
            'post-traumatic stress disorder' => 'TRAUMATIC',
            'psychosis' => 'PSYCHOSIS',
            'schizophrenia' => 'schizophrenia'
        ];
        return view('frontend.trial_report', compact('services', 'div_logic_array', 'row_logic_array'));
    }

    public function get_modal_ajax(Request $request)
    {
        $service = Service::where('id', $request->serviceid)->first();

        $service_details['id'] = $service->id;
        $service_details['service_name'] = $service->service_name;
        $service_details['caption'] = $service->caption;
        $service_details['description'] = $service->description;
        $service_details['paragraph1'] = $service->paragraph1;
        $service_details['paragraph2'] = $service->paragraph2;
        $service_details['list'] = json_decode($service->list);
        $service_details['service_icon'] = $service->service_icon;

        return response()->json(array(
            'service' => $service_details,
        ));
    }

    public function quiz_logic($id)
    {
        $service_detail = Service::where('id', $id)->first();

        if($service_detail->yes_no_status==1){
            return view('frontend.questions_ptsd',compact('id'));
        }else if($service_detail->yes_no_status==0){

            $all_questions = Question::with('service', 'options')->where('service_id', $id)->inRandomOrder()->limit(5)->get();

            Session::forget('questions');
            $questions_array = [];
            if (!Session::has('questions')) {
                $i = 0;

                foreach ($all_questions as $question) {
                    $questions_array[$i]['qid'] = $question['id'];
                    $questions_array[$i]['serviceid'] = $question['service_id'];
                    $questions_array[$i]['ques'] = $question['question'];
                    $questions_array[$i]['choices'] = count($question->options);
                    if (count($question->options) > 0) {
                        $j = 1;
                        foreach ($question->options as $option_value) {
                            $questions_array[$i]['option_id' . $j] = $option_value->id;
                            $questions_array[$i]['option_value' . $j] = $option_value->option;
                            $j++;
                        }
                    }
                    $questions_array[$i]['patient_ans'] = '';
                    $questions_array[$i]['patient_ans_marks'] = '';
                    $i++;
                }
                Session::put('questions', $questions_array);
            }
            return view('frontend.questions', compact('all_questions', 'questions_array'));
        }
    }

    public function quiz_store(Request $request)
    {

        $questions_array = Session::get('questions');
        if (Session::has('questions')) {
            for ($i = 0; $i < count($questions_array); $i++) {
                $qid=$questions_array[$i]['qid'];
                if ($questions_array[$i]['qid'] == $request->input('ques'.$qid)) {
                    $selected_option_id = $request->input('ans'.$qid);
                    $selected_option_details = Option::where('id', $selected_option_id)->first();
                    $questions_array[$i]['patient_ans'] = $selected_option_details->option;
                    $questions_array[$i]['patient_ans_marks'] = $selected_option_details->option_marks;
                }
            }
        }
        Session::put('questions', $questions_array);

        $total_points = 0;

        for ($i = 0; $i < count($questions_array); $i++) {
            $total_points += $questions_array[$i]['patient_ans_marks'];
        }

        $service = Service::where('id',$questions_array[0]['serviceid'])->first();

        if(Session::has('service_id') && Session::has('service_name')){
            Session::forget('service_id');
            Session::forget('service_name');

            Session::put('service_id', $service->id);
            Session::put('service_name', $service->service_name);
        }
        else{
            Session::put('service_id', $service->id);
            Session::put('service_name', $service->service_name);
        }

        $answer = ($total_points/5);

        $patient_answer_id = PatientAnswer::insertGetId([
            'service_id' => $questions_array[0]['serviceid'],
            'patient_ans' => $answer,
            'quiz_date' => Carbon::now(),
            'quiz_time' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        Session::put('last_inserted_user_answer_id', $patient_answer_id);

        foreach($questions_array as $questions1){
            $patient_answer_details_id = PatientAnswerDetail::insertGetId([
                'service_id' => $questions1['serviceid'],
                'ques_id' => $questions1['qid'],
                'ques' => $questions1['ques'],
                'patient_answer_id' => $patient_answer_id,
                'patient_answer' => $questions1['patient_ans'],
                'answer_submitted_status' => 0,
                'created_at' => Carbon::now()
            ]);
        }

        return redirect()->route('check.symptoms');
    }

    public function quiz_ptsd_store(Request $request)
    {
        if($request->ans==1){
            $service_id = $request->service_id;

            $all_questions = Question::with('service', 'options')->where('service_id', $service_id)->inRandomOrder()->limit(5)->get();

            Session::forget('questions');
            $questions_array = [];
            if (!Session::has('questions')) {
                $i = 0;

                foreach ($all_questions as $question) {
                    $questions_array[$i]['qid'] = $question['id'];
                    $questions_array[$i]['serviceid'] = $question['service_id'];
                    $questions_array[$i]['ques'] = $question['question'];
                    $questions_array[$i]['choices'] = count($question->options);
                    if (count($question->options) > 0) {
                        $j = 1;
                        foreach ($question->options as $option_value) {
                            $questions_array[$i]['option_id' . $j] = $option_value->id;
                            $questions_array[$i]['option_value' . $j] = $option_value->option;
                            $j++;
                        }
                    }
                    $questions_array[$i]['patient_ans'] = '';
                    $questions_array[$i]['patient_ans_marks'] = '';
                    $i++;
                }
                Session::put('questions', $questions_array);
            }
            return view('frontend.questions', compact('all_questions', 'questions_array'));
        }
        else{
            return redirect()->route('trial.report');
        }
    }

    public function appointment()
    {
        return view('frontend.appointment');
    }

    public function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i:s');
        $endTime = $end->format('H:i:s');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i:s', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $startTime = date('H:i:s', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time[$i]['slot_start_time'] = date('H:i:s', strtotime($start));
                $time[$i]['slot_end_time'] = date('H:i:s', strtotime($end));
            }
            $i++;
        }
        return $time;
    }

    public function getDoctorsWithSlot($date, $time, $day_count)
    {
        $onlydate = $date;

        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $multiSlots = array();

        for ($m = 0; $m <= 2; $m++) {
            $date = date('Y-m-d', strtotime($onlydate . ' +' . $m . ' days'));

            $userdate = date('l', strtotime($date));

            $s = 'SELECT doctors.id,';
            foreach ($days as $day) :
                $s .= 'JSON_EXTRACT(doctors.working_days, "$.' . $day . '") as ' . $day . ',';
            endforeach;
            $s = trim($s, ',');
            $s .= ' FROM doctors where JSON_EXTRACT(doctors.working_days, "$.' . $userdate . '") AND doctors.status=1';

            $slots_ar = array();
            $docid = array();
            $i = 0;
            $k = 0;

            $multiSlots[$m]['date'] = $date;
            $multiSlots[$m]['date_format'] = date('j F, Y', strtotime($date));

            $results = DB::select($s);
            foreach($results as $result){
                $j = 0;

                $docTime_results = DoctorWorkingHour::where('doctor_id',$result->id)->get();

                foreach($docTime_results as $docTime_result){

                    $newar = $this->getTimeSlot(60, $docTime_result->fromTime, $docTime_result->toTime);

                    for ($k = 0; $k < count($newar); $k++) {
                        if (in_array($newar[$k]['slot_start_time']. "-" . $newar[$k]['slot_end_time'], $slots_ar)) {
                            $key = array_search($newar[$k]['slot_start_time']. "-" . $newar[$k]['slot_end_time'], $slots_ar);
                            $docid[$key]=$docid[$key].",".$result->id;
                        }
                        else{
                            $appoint_result = Appointment::where('appointment_date',$date)->where('appointment_time',$newar[$k]['slot_start_time'])->get();

                            if (count($appoint_result) <= 0) {
                                array_push($slots_ar, $newar[$k]['slot_start_time'] . "-" . $newar[$k]['slot_end_time']);
                                array_push($docid, $result->id);
                            }
                        }

                    }

                    $j++;
                }
                $i++;
            }

            $multiSlots[$m]['slots'] = $slots_ar;
            $multiSlots[$m]['docid'] = $docid;
        }

        return [$multiSlots];
    }

    public function get_appointment_ajax(Request $request)
    {
        $datetime_array = explode(" ",$request->datetime_value);

        $date = $datetime_array[0];
        $timefrom = $datetime_array[1];

        $slots = $this->getDoctorsWithSlot($date,$timefrom,'');
        $slots = $slots[0];

        $result = array();

        for($i=0;$i<=2;$i++){

            $new_array = array(
                'date' => $slots[$i]['date'],
                'formated_date' => date('j F, Y', strtotime($slots[$i]['date'])),
                'slots' => $slots[$i]['slots'],
                'docid' => $slots[$i]['docid']
            );
            array_push($result,$new_array);
        }

        $doctor_ids = 0;
        $slot_timing = '';
        $time_slot = ($timefrom. "-" . date('H:i:s',strtotime('+1 hour',strtotime($timefrom))));
        foreach($slots as $slot){
            if($slot['date'] == $date){
                foreach($slot['slots'] as $key=>$value){
                    if($time_slot == $value){
                        $slot_timing = $slot['slots'][$key];
                        $doctor_ids = $slot['docid'][$key];
                    }
                }
            }
        }

        $count = (substr_count($doctor_ids,",")+1);

        if($count > 1){
            $doctorIdArray = explode(',', $doctor_ids);
            $randomDoctorId = $doctorIdArray[mt_rand(0, count($doctorIdArray))];
        }
        else{
            $randomDoctorId = $doctor_ids;
        }

        return response()->json(array(
            'result' => $result,
            'slot_timing' => $slot_timing,
            'doctor_ids' => $doctor_ids,
            'randomDoctorId' => $randomDoctorId,
        ));
    }


    public function direct_book_appointment()
    {
        $services = Service::orderBy('id', 'ASC')->get();
        return view('frontend.book_appointment',compact('services'));
    }
    public function contact()
    {
        return view('frontend.contact');
    }
  
    public function contact_mail(Request $request)
    { 
            $item=$request->name;
            $data=['name'=>$request->name, 'email'=>$request->email,  'mobile'=>$request->mobile, 'msg'=>$request->message];
            $user['to']='sudhir.cmw@gmail.com';
            $user['from']='ONLINE DOCS';

          Mail::send('mail.contact', $data, function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Customer Query');
                $messages->from('support@onlinedocs.us','ONLINE DOCS');
            });
            $notification = array(
            'message' => 'Your Query Sent Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('contact')->with($notification);
 
    }
    public function plans_pricing()
    {
        return view('frontend.plans_pricing');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        $services = Service::orderBy('id', 'ASC')->get();
        $div_logic_array = ['golden', 'gray', 'gray', 'golden', 'golden', 'gray', 'gray', 'golden', 'golden', 'gray', 'gray', 'golden'];
        $row_logic_array = [
            'anxiety' => 'anxiety',
            'alcohol use disorder' => 'alcohol',
            'behavioral and emotional disorders in children/teenagers' => 'behaviour',
            'bipolar disorder' => 'bipolar',
            'depression' => 'DEPRESSION',
            'dissociation' => 'DISSOCIATION',
            'eating disorders' => 'eatingDisorder',
            'obsessive compulsive disorder' => 'ocd',
            'paranoia' => 'PARANOIA',
            'post-traumatic stress disorder' => 'TRAUMATIC',
            'psychosis' => 'PSYCHOSIS',
            'schizophrenia' => 'schizophrenia'
        ];
        return view('frontend.services', compact('services', 'div_logic_array', 'row_logic_array'));
    }
    
    public function service_detail($id)
    {
        // return $slug;
        $service_detail = Service::where('id', $id)->first();
        // return $service_detail;
        return view('frontend.service_detail', compact('service_detail'));
    }
     public function treatment_detail($slug)
    {
        // return $slug;
         
        $service_detail['service_detail'] = Service::where('slug', $slug)->first();
           $service_detail['seo_config'] = DB::table('seo_configs')
                ->where('service_id','=', $service_detail['service_detail']->id)
                ->where(['status'=>1])
                ->get();
                // return $service_detail['seo_config'];
                // return $service_detail;

    if(isset($service_detail['service_detail']->id)){
           
            return view('frontend.service_detail', $service_detail);            
            // return view('frontend.service_detail', compact('service_detail'));            

    }else{
            return redirect('/');            
       
    }
       

        
    }
    
    public function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }

    public function refund_policy()
    {
        return view('frontend.refund_policy');
    }

    public function termsandconditions()
    {
        return view('frontend.termsandconditions');
    }
    
    public function apply_coupon(Request $request)
    {
        // return $request;
        if(empty(trim($request->coupon_code))){
                    return response()->json(['type' => 'error','msg' => 'Please input valid coupon code!']);
        }
        if($request->coupon_code == ""){
            return response()->json(['type' => 'error','msg' => 'Please input valid coupon code!']);
        }

        $couponcode = CouponCode::where('name',$request->coupon_code)
        ->where('start_date','<=',Carbon::now()->format('Y-m-d'))
        ->where('end_date','>=',Carbon::now()->format('Y-m-d'))
        ->get();

        if(count($couponcode) == 0){
            return response()->json(['type' => 'error','msg' => 'Coupon Code Not Valid']);
        }
        else if(count($couponcode) == 1){

            if(Auth::guard('patient')->check()){
                $user = Auth::guard('patient')->user();
            }else if(!Auth::guard('patient')->check()){
                    $user = Patient::where('mobile',$request->mobile)->orWhere('email',$request->email)->first();
            }

            if(isset($user->id)){
                $check_coupon_applied = PatientPayment::where('patient_id',$user->id)
                ->where('coupon_id',$couponcode[0]->id)
                ->get();
            }else{
                $check_coupon_applied = array();
            }


            if(count($check_coupon_applied)==1){
                return response()->json(['type' => 'error','msg' => 'Coupon Code Already Used!']);
            }
            else{

                if(Session::get('coupon_code') == $request->coupon_code){
                    return response()->json(['type' => 'warning','msg' => 'Coupon Code Already Applied!']);
                }

                if($couponcode[0]->flat_discount){ // Fixed
                    // $discount_amount = (($couponcode[0]->percentage/100)*3499);
                    $discount_amount = $couponcode[0]->flat_discount;
                }
                if(!Session::has('coupon_code')) {
                    Session::put('coupon_code', $request->coupon_code);
                    Session::put('coupon_id', $couponcode[0]->id);
                    Session::put('discount_amount', $discount_amount);
                }else{
                    Session::put('coupon_code', $request->coupon_code);
                    Session::put('coupon_id', $couponcode[0]->id);
                    Session::put('discount_amount', $discount_amount);
                }
                return response()->json(['type' => 'success','msg' => 'Coupon Code Applied Successfully!']);
            }

        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('frontend.home');
    // }
    
}
