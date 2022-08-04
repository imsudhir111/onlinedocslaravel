<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function blog_list()
    {
        //
        $blog_lists = Blog::where('active_status', '=', '1')
        ->where('published_at', '!=', 'Null')
        ->get();
        // return $blog_lists;
        return view('frontend.blogs.index',compact('blog_lists'));

    }
    public function blog_detail($slug,$id)
    {
        //
        // $blog_detail = Blog::find($id);
        // $blog_detail = Blog::select('caption','tagline','photo','description')->where(['slug'=>$slug])->get();

        $blog_detail['blog_detail'] = Blog::select('caption','tagline','photo','description')->where('active_status', '=', '1')
        ->where('published_at', '!=', 'Null')
        ->where('id','=',$id)
        ->get();
         $blog_detail['blog_list'] = Blog::where('active_status', '=', '1')
        ->where('published_at', '!=', 'Null')
        ->whereNotIn('id', [$id])
        ->get();

        // return sizeof($blog_detail['blog_detail']);
        if (sizeof($blog_detail['blog_detail'])==1) {
            return view('frontend.blogs.blog_detail',$blog_detail);
        }else{
            return redirect('blogs');
        }

    }
    public function trial_report(){
        return redirect('/trial/report');
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
}
