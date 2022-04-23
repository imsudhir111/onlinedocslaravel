<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->get();
        return view('backend.admin.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.service.create');
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
            'service_name' => 'required|max:255',
            'caption' => 'required|max:255',
            'description' => 'required|max:255',
            'service_icon' => 'mimes:jpg,png,jpeg,webp|max:200',
        ]);

        $service_id = Service::insertGetId([
            'service_name' => $request->service_name,
            'caption' => $request->caption,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        if($request->file('service_icon')) {
            $data = Service::find($service_id);
            $file = $request->file('service_icon');
            @unlink(public_path('upload/service_icon/' . $data->service_icon));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/service_icon'), $filename);
            $data['service_icon'] = $filename;
            $data->save();
        }

        $notification = array(
            'message' => 'Service Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('service.show', $service_id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::where('id',$id)->first();
        return view('backend.admin.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::where('id',$id)->first();
        return view('backend.admin.service.edit', compact('service'));
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
            'service_name' => 'required|max:255',
            'caption' => 'required|max:255',
            'description' => 'required|max:255',
            'service_icon' => 'mimes:jpg,png,jpeg,webp|max:200',
        ]);

        Service::find($id)->update([
            'service_name' => $request->service_name,
            'caption' => $request->caption,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);

        if($request->file('service_icon')) {
            $data = Service::find($id);
            $file = $request->file('service_icon');
            @unlink(public_path('upload/service_icon/' . $data->service_icon));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/service_icon'), $filename);
            $data['service_icon'] = $filename;
            $data->save();
        }

        $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('service.show', $id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::where('id',$id)->delete();

        $notification = array(
            'message' => 'Service Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('service.index')->with($notification);
    }
}
