<?php

namespace App\Http\Controllers\admin\Media_Press;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media_press;
use Carbon\Carbon;

class MediaPressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $media_press_post = Media_press::All();
        return view('backend.admin.media_press.index',compact('media_press_post'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.admin.media_press.create');

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
            'name' => 'required',
            'small_icon' => 'required|mimes:jpg,png,jpeg|max:200',
            'big_icon' => 'required|mimes:jpg,png,jpeg|max:200',
        ]);
        $press_media_id = Media_press::insertGetId([
            'name' => $request->name,
            'small_icon' => $request->small_icon,
            'big_icon' => $request->big_icon,
            'created_by' => $request->created_by,
            'created_at' => Carbon::now()
        ]);
        if($press_media_id>0){
        if($request->file('small_icon')) {
            $data = Media_press::find($press_media_id);
            $file = $request->file('small_icon');
            @unlink(public_path('upload/press-media/small_icon' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/press-media/small_icon/'), $filename);
            $data['small_icon'] = $filename;
            $status=$data->save();
        }
        if($request->file('big_icon')) {
            $data = Media_press::find($press_media_id);
            $file = $request->file('big_icon');
            @unlink(public_path('upload/press-media/big_icon' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/press-media/big_icon/'), $filename);
            $data['big_icon'] = $filename;
            $status=$data->save();
        }
    }
        if($status){
        $notification = array(
            'message' => 'Press/Media Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('media-press.create')->with($notification);
       }
       $notification = array(
        'message' => 'Something went wrong',
        'alert-type' => 'warning'
    );
       return redirect()->route('media-press.create')->with($notification);

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
        $status = Media_press::where('id',$id)->delete();
        if($status){
        $notification = array(
            'message' => 'Media/Press Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('media-press.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Something went wrong please try later',
                'alert-type' => 'Warning'
            );
        return redirect()->route('media-press.index')->with($notification);

    }
    }
    public function press_media_active_deactive(Request $request){
    
        $active_status = Media_press::select('active_status')
                         ->where(['id'=>$request->id])
                         ->get();
        $active_status = $active_status[0]->active_status;
        if($active_status==1){
        $press_media=0;
        $notification = array(
            'message' => 'Post Deactivated successfuly',
            'alert-type' => 'Warning'
        );
        }else{
        $press_media=1;
        $notification = array(
            'message' => 'Post Activated successfuly',
            'alert-type' => 'Warning'
        );
        }
    $status = Media_press::where(['id'=>$request->id])->update(['active_status'=>$press_media]);
    if($status){
    return response()->json(["status"=>"success", "data"=>$notification]);
    }
    return response()->json(["status"=>"error", "data"=>$notification]);
    
    
    }
}
