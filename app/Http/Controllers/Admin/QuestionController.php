<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->selected_service)){
            $questions_list = Question::with('service:id,service_name')->latest()->get();
            $services_list = Service::select('id','service_name')->get();
    
            $questions['questions_list']=$questions_list;
            $questions['services_list']=$services_list;
           
            $ques_options_list = Question::with('options')
            ->where('service_id', $request->selected_service)
            ->orderBy('id', 'DESC')
            ->get();
            $questions['ques_options_list']=$ques_options_list;
            return view('backend.admin.question.index', $questions);

        }


        $questions_list = Question::with('service:id,service_name')->latest()->get();
        $services_list = Service::select('id','service_name')->get();

        $questions['questions_list']=$questions_list;
        $questions['services_list']=$services_list;
       
        $ques_options_list = Question::with('options')->get();
        $questions['ques_options_list']=$ques_options_list;
        
        // return $questions;

        return view('backend.admin.question.index', $questions);
    }
    public function question_filter(Request $request)
    {
        if(isset($request->selected_service)){
            $questions_list = Question::with('service:id,service_name')->latest()->get();
            $services_list = Service::select('id','service_name')->get();
    
            $questions['questions_list']=$questions_list;
            $questions['services_list']=$services_list;
           
            $ques_options_list = Question::with('options')
            ->where('service_id', $request->selected_service)
            ->get();
            $questions['ques_options_list']=$ques_options_list;
            return view('backend.admin.question.index', $questions);

        }


        $questions_list = Question::with('service:id,service_name')->latest()->get();
        $services_list = Service::select('id','service_name')->get();

        $questions['questions_list']=$questions_list;
        $questions['services_list']=$services_list;
       
        $ques_options_list = Question::with('options')->get();
        $questions['ques_options_list']=$ques_options_list;
        
        // return $questions;

        return view('backend.admin.question.index', $questions);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::select('id','service_name')->get();
         return view('backend.admin.question.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->selected_service;
        $validated = $request->validate([
            'question' => 'required|max:255',
            'option' => 'required|max:255',
        ]);

        $question_id = Question::insertGetId([
            'question' => $request->question,
            'service_id' => $request->selected_service,
        ]);

        if(count($request->option)>0){
            $options = $request->option;
            foreach($options as $option){
                Option::insert([
                    'ques_id' => $question_id,
                    'option' => $option,
                ]);
            }
        }

        $notification = array(
            'message' => 'Question Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('question.index', $question_id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with('options')->where('id',$id)->first();
        return view('backend.admin.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $question = Question::with('options')->where('id',$id)->first();
        // $question = Question::with([
        //     'options'  => function($query) {
        //     $query->select(['option']);
        // }])->find($id);
        $question = Question::with('options')->find($id);
        // return $question;
        return view('backend.admin.question.edit', compact('question'));
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
        // return $request;
        $validated = $request->validate([
            'question' => 'required|max:255',
            'option' => 'required|array|min:4',
        ]);
      
             $options = $request->option;
            $options_id = $request->option_id;

            DB::table('questions')
                ->where('id','=', $id)
                ->update([
                'question' => $request->question,
                ]);

            for ($i = 0; $i < count($options_id); $i++) {
                $option_id=$i+1;
                DB::table('options')
                ->where('id','=', $options_id[$i])
                ->update([
                'option' => $options[$i],
                ]);
              }

        // return 'yes';
        $notification = array(
            'message' => 'Question Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('question.index')->with($notification);

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::where('id',$id)->delete();

        $notification = array(
            'message' => 'Question Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('question.index')->with($notification);
    }
}
