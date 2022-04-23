<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('service:id,service_name')->latest()->get();
        // return $questions;

        return view('backend.admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'option' => 'required|max:255',
        ]);

        $question_id = Question::insertGetId([
            'question' => $request->question,
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

        return redirect()->route('question.show', $question_id)->with($notification);
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
        $question = Question::with('options')->where('id',$id)->first();
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
        $validated = $request->validate([
            'question' => 'required|max:255',
            'option' => 'required|max:255',
        ]);

        Question::find($id)->update([
            'question' => $request->question,
        ]);

        if(count($request->option)>0){
            $options = $request->option;
            foreach($options as $option){
                Option::insert([
                    'ques_id' => $id,
                    'option' => $option,
                ]);
            }
        }

        Question::find($id)->update([
            'service_name' => $request->service_name,
            'caption' => $request->caption,
            'description' => $request->description,
        ]);

        $notification = array(
            'message' => 'Question Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('question.show', $id)->with($notification);
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
