<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Application_setting;

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
        ->latest()->take(4)->get();
        // return $blog_lists;
        return view('frontend.blogs.index',compact('blog_lists'));

    }
    public function blog_detail($slug)
    {
          $blog_detail['blog_detail'] = Blog::select('id','caption','tagline','slug','photo','description')->where('active_status', '=', '1')
        ->where('published_at', '!=', 'Null')
        ->where('slug','=',$slug)
        ->get();
        // return isset($blog_detail['blog_detail']->id) ? 'y' : 'n';
        if (isset($blog_detail['blog_detail'][0])) {

         $blog_detail['blog_list'] = Blog::select('id','caption','slug')->where('active_status', '=', '1')
        ->where('published_at', '!=',    'Null')
        ->whereNotIn('id', [$blog_detail['blog_detail'][0]->id])
        ->get();
        $blog_detail['social_link'] = Application_setting::select('social_media','url')->get();
 
           
                return view('frontend.blogs.blog_detail',$blog_detail);
        }else{
                return redirect('blogs');
            }

 

        //
        //  $blog_detail['blog_detail'] = Blog::where('active_status', '=', '1')
        // ->where('published_at', '!=', 'Null')
        // ->where('id','=',$id)
        // ->get();
        //  $blog_detail['blog_list'] = Blog::where('active_status', '=', '1')
        // ->where('published_at', '!=', 'Null')
        // ->whereNotIn('id', [$id])
        // ->get();
        //  $blog_detail['social_link'] = Application_setting::select('social_media','url','social_media_font_class')->get();
        // if (sizeof($blog_detail['blog_detail'])==0) {
        //     // code...
        // return redirect('/blogs');
        
        // }
        return view('frontend.blogs.blog_detail',$blog_detail);

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
