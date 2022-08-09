<?php

namespace App\Http\Controllers\admin\Media_Press;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media_press;
use App\Models\Media_press_release;
use App\Models\Content_media_press_release;

use Carbon\Carbon;
class MediaPressReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $media_press_released_post['media_press_released_post'] = Media_press_release::All();
        $media_press_released_post['media_press'] = Media_press_release::All();
        // return $media_press_relesed_post;
        return view('backend.admin.media_press_release.index',$media_press_released_post);
    }
    public function press_media_list_filterd_by_release_id(Request $request){
            $media_press_id=[];
           $assigned_media_pres_id = Content_media_press_release::select('media_press_id')->where(['media_press_release_id'=>$request->id])->get();
        //   return $assigned_media_pres_id;
           foreach ($assigned_media_pres_id as $key => $value) {
            # code...
            array_push($media_press_id,$value->media_press_id);
           }
       
           $media_press = Media_press::select('id','name')
           ->where(['active_status'=>1])->whereNotIn('id', $media_press_id)->get();
           
           $assigned_media=Content_media_press_release::with('media_press:id,name')->select('id','media_press_id')
           ->where(['media_press_release_id' => $request->id])->get();
           
           $html['assigned_media_press_list']='';
           foreach ($assigned_media as $key=>$value){
            $html['assigned_media_press_list'].='<li class="li__"><div class="content">'.$assigned_media[$key]['media_press']->name.'</div><button onclick="remove_assigned_media_press('.$assigned_media[$key]->id.')" class="btn btn-danger delete__"><i class="fas fa-trash"></i></button></li>';
             }
 
           $html['press_media_dropdown']='<option value="">select press/media</option>';
          
           foreach ($media_press as $key=>$value){
            $html['press_media_dropdown'].='<option value="'.$value->id.'">'.$value->name.'</option>';
           }


            // return $html;
            $notification = array(
                'message' => 'Press/Media Release Added Successfully',
                'alert-type' => 'success'
            );
        return response()->json(["status"=>"success", "data"=>$html, "msg"=>$notification]);

        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $create_press_media_release['media_press_list']=Media_press::select('id','name')->get();
         return view('backend.admin.media_press_release.create', $create_press_media_release);
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
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:200',
            'created_by' => 'required',
        ]);
        // return $request;

        $press_media_release_id =  media_press_release::insertGetId([
            'caption' => $request->caption,
            'description' => $request->description,
            'image' => $request->image,
            'created_by' => $request->created_by,
            'created_at' => Carbon::now()
        ]);
        if($request->file('image')) {
            $data = media_press_release::find($press_media_release_id);
            $file = $request->file('image');
            @unlink(public_path('upload/press-media-release/image' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/press-media-release/image/'), $filename);
            $data['image'] = $filename;
            $status=$data->save();
        }

     
        // $mapped_array=[];
        // $mapped_array=array_combine($request->media_press,$request->media_press_release_url);
        // foreach ($mapped_array as $media_press_id => $url) {
        //     $data=[
        //         'media_press_release_id'=>$press_media_release_id,
        //         'media_press_id'=>$media_press_id,
        //         'url'=>$url,
        //         'released_at'=>Carbon::now(),
        //         'status'=>1
        //     ];
        //      $status=Content_media_press_release::insert($data);
        // }
        if($status){
            $notification = array(
                'message' => 'Press/Media Release Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('media-press-release.create')->with($notification);
           }
           $notification = array(
            'message' => 'Something went wrong',
            'alert-type' => 'warning'
        );
           return redirect()->route('media-press-release.create')->with($notification);
     
    }



    public function save_assigned_media_press(Request $request){
        $validated = $request->validate([
            'media_press_release_id' => 'required',
            'url' => 'required',
            'media_press' => 'required',
        ]);
        $assigned_data=[
            'media_press_release_id'=>$request->media_press_release_id,
            'url'=>$request->url,
            'media_press_id'=>$request->media_press,
            'released_at' => Carbon::now()
        ];
        $press_media_assigned_id =  Content_media_press_release::insertGetId($assigned_data);
        if($press_media_assigned_id>0){
            $notification = array(
                'message' => 'Release Assigned successfuly',
                'alert-type' => 'Warning'
            );
            return response()->json(["status"=>"success", "data"=>$notification]);
            }
            $notification = array(
                'message' => 'Something went wrong please try again',
                'alert-type' => 'Warning'
            );
            return response()->json(["status"=>"error", "data"=>$notification]);
    }

    public function remove_assigned_media_press(Request $request){
        // return $request;
        $status = Content_media_press_release::where('id',$request->id)->delete();
        if($status){
            $notification = array(
                'message' => 'Removed successfuly',
                'alert-type' => 'Warning'
            );
            return response()->json(["status"=>"success", "data"=>$notification]);
            }
            $notification = array(
                'message' => 'Something went wrong please try again',
                'alert-type' => 'Warning'
            );
            return response()->json(["status"=>"success", "msg"=>$notification]);
    }

    public function press_media_release_active_deactive(Request $request){
        $active_status = Media_press_release::select('active_status')
                         ->where(['id'=>$request->id])
                         ->get();
        $active_status = $active_status[0]->active_status;
        if($active_status==1){
        $press_media_release=0;
        $notification = array(
            'message' => 'Release Deactivated successfuly',
            'alert-type' => 'Warning'
        );
        }else{
        $press_media_release=1;
        $notification = array(
            'message' => 'Release Activated successfuly',
            'alert-type' => 'Warning'
        );
        }
    $status = Media_press_release::where(['id'=>$request->id])->update(['active_status'=>$press_media_release]);
    if($status){
    return response()->json(["status"=>"success", "data"=>$notification]);
    }
    return response()->json(["status"=>"error", "data"=>$notification]);
    
    
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
        $media_press_released_post_byid['media_press_released_post_byid'] = Media_press_release::where(['id'=>$id])->get();
        // return $media_press_released_post_byid;
        return view('backend.admin.media_press_release.edit',$media_press_released_post_byid);
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
     
        $description = trim($request->description);
        $description = stripslashes($description);
        $description='<pre>'.$description.'</pre>';
       
        $post = Media_press_release::find($id);
        // return gettype($post);
        $post_data=[
            'caption'=> $request->caption,
            'description'=> $description,
         ];
        if(is_null($post)){
            $status=0;
            $notification = array(
                'message' => 'Record not found',
                'alert-type' => 'warning'
            );
            }else{
                $status = Media_press_release::where(['id'=>$id])->update($post_data);

                if($status){
                    $notification = array(
                        'message' => 'Release Updated successfully',
                        'alert-type' => 'success'
                    );
                if($request->file('image')) {
                    $data = Media_press_release::find($id);
                    $file = $request->file('image');
                    @unlink(public_path('upload/press-media-release/image/' . $data->photo));
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('upload/press-media-release/image/'), $filename);
                    $data['image'] = $filename;
                    $image_status=$data->save();
                    // return $image_status;
                    if($image_status){
                        $notification = array(
                            'message' => 'Release Updated successfully',
                            'alert-type' => 'success'
                        );
                    }
                }
                 
                }else{
                    $notification = array(
                        'message' => 'Somthing went wront try again',
                        'alert-type' => 'error'
                    ); 
                }
         }
  
         return redirect()->route('media-press-release.edit',$id)->with($notification);
    
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
