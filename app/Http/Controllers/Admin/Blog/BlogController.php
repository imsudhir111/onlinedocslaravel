<?php

namespace App\Http\Controllers\admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blog_post = Blog::all();        

         return view('backend.admin.blogs.index',compact('blog_post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
   
   
         return view('backend.admin.blogs.create');
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
        $validated = $request->validate([
            'caption' => 'required',
            'tagline' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:jpg,png,jpeg,webp|max:200',
            'small_image' => 'required|mimes:jpg,png,jpeg,webp|max:200',
            'published_by'=>'required',
        ]);
        $data = trim($request->description);
        $data = stripslashes($data);
        $data='<pre>'.$data.'</pre>';
        // return $data;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->caption)));

        $post_id = Blog::insertGetId([
            'caption' => $request->caption,
            'tagline' => $request->tagline,
            'published_by' => $request->published_by,
            'description' => $data,
            'slug'=>$slug,
            'created_at' => Carbon::now()
        ]);
        if($request->file('photo')) {
            $data = Blog::find($post_id);
            $file = $request->file('photo');
            @unlink(public_path('upload/blog/images' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/blog/photo/'), $filename);
            $data['photo'] = $filename;
            $status=$data->save();
        }
        if($request->file('small_image')) {
            $data = Blog::find($post_id);
            $small_file = $request->file('small_image');
            @unlink(public_path('upload/blog/images' . $data->small_image));
            $filename = date('YmdHi') . $small_file->getClientOriginalName();
            $small_file->move(public_path('upload/blog/photo/'), $filename);
            $data['small_image'] = $filename;
            $status=$data->save();
        }
       if($status){
        $notification = array(
            'message' => 'Blog Post Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.create')->with($notification);
       }
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
        $blog_post = Blog::find($id);
        return view('backend.admin.blogs.show',compact('blog_post'));
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
        $blog_post = Blog::find($id);
        
        return view('backend.admin.blogs.edit',compact('blog_post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function RemoveSpecialChar($str)
    {
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $str); // Removes special chars.
        $output = strtolower(preg_replace('!\s+!', '-', $string));
        return $output;
    }

    public function update(Request $request, $id)
    {
        //
        
        $description = trim($request->description);
        $description = stripslashes($description);
        $description='<pre>'.$description.'</pre>';
       
        $post = Blog::find($id);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->caption)));
        // $slug = $this->RemoveSpecialChar($request->caption);

        $post_data=[
            'caption'=> $request->caption,
            'tagline'=> $request->tagline,
            'description'=> $description,
            'slug'=> $slug,
            'published_by' => $request->published_by
        ];
        if(is_null($post)){
            $status=0;
            $notification = array(
                'message' => 'Record not found',
                'alert-type' => 'warning'
            );
            }else{
                $status = Blog::where(['id'=>$id])->update($post_data);
                if($status){
                    $notification = array(
                        'message' => 'Post Updated successfully',
                        'alert-type' => 'success'
                    );
                if($request->file('photo')) {
                    $data = Blog::find($id);
                    $file = $request->file('photo');
                    @unlink(public_path('upload/blog/images' . $data->photo));
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('upload/blog/photo/'), $filename);
                    $data['photo'] = $filename;
                    $image_status=$data->save();
                    // return $image_status;
                    if($image_status){
                        $notification = array(
                            'message' => 'Post Updated successfully',
                            'alert-type' => 'success'
                        );
                    }
                }
                if($request->file('small_image')) {
                    $data = Blog::find($id);
                    $small_file = $request->file('small_image');
                    @unlink(public_path('upload/blog/images' . $data->small_image));
                    $filename = date('YmdHi') . $small_file->getClientOriginalName();
                    $small_file->move(public_path('upload/blog/photo/'), $filename);
                    $data['small_image'] = $filename;
                    $status=$data->save();
                }
                }else{
                    $notification = array(
                        'message' => 'Somthing went wront try again',
                        'alert-type' => 'error'
                    ); 
                }
         }
  
    return redirect()->route('blog.edit',$id)->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function blog_publish($id){
        Blog::where(['id'=>$id])->update(['published_at'=>Carbon::now()]);
        $notification = array(
            'message' => 'Post Published successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.index')->with($notification);
     }
    public function destroy($id)
    {
        //
        $status = Blog::where('id',$id)->delete();
        if($status){
        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Something went wrong please try later',
                'alert-type' => 'Warning'
            );
        return redirect()->route('blog.index')->with($notification);

    }
}
public function post_active_deactive(Request $request){
    
    $active_status = Blog::select('active_status')
                     ->where(['id'=>$request->id])
                     ->get();
    $active_status = $active_status[0]->active_status;
 if($active_status==1){
 $post_status=0;
 $notification = array(
    'message' => 'Post Deactivated successfuly',
    'alert-type' => 'Warning'
);
 }else{
 $post_status=1;
 $notification = array(
    'message' => 'Post Activated successfuly',
    'alert-type' => 'Warning'
);
}
$status = Blog::where(['id'=>$request->id])->update(['active_status'=>$post_status]);
if($status){
return response()->json(["status"=>"success", "data"=>$notification]);
}
return response()->json(["status"=>"error", "data"=>$notification]);


}
}
