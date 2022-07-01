<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Patient_payment;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
class PatientInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      

        $patient_lists = Patient::all();
        // return $doctor_lists;
         return view('backend.agent.pages.patient_info.index', compact('patient_lists'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.agent.pages.patient_info.create');
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function create_rajorpay_paymeny_link($patient_id,$name,$contact,$email,$amount){
 
    // }

    public function create_razorpay_paymeny_link($patient_id,$name,$contact,$email,$amount){
        $api = new Api('rzp_test_Yah6usTY4v3qOJ', '498XQUKxCAteRA98adD89qRY');
        $customer_info =  array('name'=> $name,'email' => $email, 'contact'=>$contact);
        $notify = array('sms'=>true, 'email'=>true);
        $notes = array('policy_name'=> 'Appointment Booking');
        $created_payment_link_response = $api->paymentLink->create(
            array('amount'=>$amount, 
            'currency'=>'INR', 
            'accept_partial'=>true,
            'first_min_partial_amount'=>100,
            'description' => 'For Online Docs', 
            'customer' => $customer_info,
            'notify'=> $notify,
            'reminder_enable'=>true ,
            'notes'=> $notes,
            'callback_url' => 'http://onlinedocslaravel.test/payment/thanyou','callback_method'=>'get'));
            return $created_payment_link_response;
    }
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'full_name' => 'required',
            'email'=> 'required|email',
            'phone' => 'required|digits:10',
            'address'=> 'required',
            'state'=> 'required',
            'city'=> 'required',
            'pincode'=> 'required|digits:6'
        ]);
        $patient_data=[
            'name' => $request->full_name,
            'email'=> $request->email,
            'mobile' => $request->phone,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'type' => 'tool-free'
        ];
         $inserted_patient_id = Patient::insertGetId($patient_data);
         $patient_by_id = Patient::find($inserted_patient_id);
        //  return $patient_by_id;
         
        $amount=3499;
        // $this->newlink();
        $result_response = $this->create_razorpay_paymeny_link($patient_by_id->id,$patient_by_id->name,$patient_by_id->mobile,$patient_by_id->email,$amount*100);
        
        $patient_payment_data= [
         'patient_id'=>$inserted_patient_id,
         'name'=>$patient_by_id->name,
         'phone'=>$patient_by_id->mobile,
         'email'=>$patient_by_id->email,
         'billing_address'=>$patient_by_id->address,
         'total_amount'=>$amount,
         'razorpay_payment_link_id'=>$result_response->id
        ];
        $inserted_patient_payments_id = Patient_payment::insertGetId($patient_payment_data);
        $patient_linkid_update = Patient::where(['id'=>$inserted_patient_id])
        ->update(['last_razorpay_payment_link_id'=>$result_response->id]);
        if($inserted_patient_id){
            $notification = array(
                'message' => 'Patient Added and link shared Successfully',
                'alert-type' => 'success'
            );
        }
        return redirect()->route('patient.show',$inserted_patient_id)->with($notification);
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

            $patient_by_id = Patient::find($id);
            $Patient_payment_history = Patient_payment::where(['patient_id'=>$patient_by_id->id])->get();
            $patient_data_by_id['Patient_payment_history']=$Patient_payment_history;
            $patient_data_by_id['patient_by_id']=$patient_by_id;
            // return $patient_data_by_id;
            if(isset($patient_by_id)){
                // return view('backend.agent.pages.patient_info.show', compact('patient_by_id'));
                return view('backend.agent.pages.patient_info.show', $patient_data_by_id);
            }else{
                return redirect('agent/patient');
            }	
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




    public function payment_with_link_thankyou(Request $request){
        $payment_status = new Api('rzp_test_Yah6usTY4v3qOJ', '498XQUKxCAteRA98adD89qRY');
        $status=0;   
    //    dd($payment_status->payment->fetch($request->razorpay_payment_id));
        if(isset($request->razorpay_payment_link_id)){
        $payment_link_id=Patient_payment::select('patient_id','razorpay_payment_link_id')
        ->where(['razorpay_payment_link_id'=>$request->razorpay_payment_link_id])->get();
    // return $payment_link_id[0]->razorpay_payment_link_id;
        if(count($payment_link_id)==1){
        if($request->razorpay_payment_link_id == $payment_link_id[0]->razorpay_payment_link_id){
            if($payment_status->payment->fetch($request->razorpay_payment_id)->status == "captured"){  
                $paymentstatus="success";
            }else{
                $paymentstatus="failed";
            } 
            $status = Patient_payment::where('razorpay_payment_link_id',$request->razorpay_payment_link_id)
            ->update(['payment_status'=>$paymentstatus,'razorpay_orderid'=>$payment_status->payment->fetch($request->razorpay_payment_id)->order_id,'razorpay_paymentid'=>$request->razorpay_payment_id]);
         }
        } 
        } 
        if($status){
            return view('backend.agent.pages.thankyou');
        }else{
        return view('backend.agent.pages.failed');
        }
    }

    public function destroy($id)
    {
        //
    }
}
