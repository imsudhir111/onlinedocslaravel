<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
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
    public function addemp()
    {
        $services = Service::latest()->get();
        return view('backend.admin.service.addemp');
    }
    public function treeview()
    {
        $services = Service::latest()->get();
        return view('backend.admin.service.treeview');
    }
    public function create_emp(Request $request)
    {
        $validated = $request->validate([
            'employee_name' => 'required|max:255'
        ]);

    }

// main resource controller start here

    public function index()
    {
        $services = Service::latest()->get();
        // return(($services));
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
// return print_r($request->list);
// return gettype($request->list);
if($request->emp_secretid==001){
    $validated = $request->validate([
        'employee_name' => 'required'
    ]);

    $data = 1;
$length = 4;
$code = substr(str_repeat(0, $length) . $data, -$length);

// return $code;
    $str=str_replace(' ', '', $request->employee_name);
    
    $cmp_id='bmw001';
    $sbstr=substr($str,0,3);
    $last_id =DB::table('employee')
                    ->orderBy('id','desc')->first();
    $emp_id_last_digits = substr(str_replace(' ', '', $last_id->emp_id),-5);
    $emp_id_last_digits = $emp_id_last_digits+1;
    $emp_id= $cmp_id.'-'.$sbstr.'-'.substr(str_repeat(0, 4) . $emp_id_last_digits, -4);;
    
    $status= DB::table('employee')->insert(
        ['emp_id' => $emp_id, 'emp_name' => $request->employee_name]
    );
echo $emp_id;
     
// return $status;
}

        $validated = $request->validate([
            'service_name' => 'required',
            'caption' => 'required',
            'description' => 'required',
            'paragraph_1' => 'required',
            'service_icon' => 'required|mimes:jpg,png,jpeg,webp|max:200',
        ]);

        $paragraph_1 = trim($request->paragraph_1);
        $paragraph_1 = stripslashes($paragraph_1);
        $paragraph_1='<pre>'.$paragraph_1.'</pre>';
        $paragraph_2 = trim($request->paragraph_2);
        $paragraph_2 = stripslashes($paragraph_2);
        $paragraph_2='<pre>'.$paragraph_2.'</pre>';

// return gettype(urlencode(json_encode($request->list)));
        $service_id = Service::insertGetId([
            'service_name' => $request->service_name,
            'caption' => $request->caption,
            'description' => $request->description,
            'paragraph1' => $paragraph_1,
            'paragraph2' => $paragraph_2,
            'list' => json_encode($request->list),
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
        return redirect()->route('service.index')->with($notification);

        // return redirect()->route('service.show', $service_id)->with($notification);
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
    public function RemoveSpecialChar($str)
    {
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $str); // Removes special chars.
        $output = strtolower(preg_replace('!\s+!', '-', $string));
        return $output;
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_name' => 'required',
            'caption' => 'required',
            'description' => 'required',
            'paragraph_1' => 'required',
        ]);
        $slug = $this->RemoveSpecialChar($request->caption);

        Service::find($id)->update([
            'service_name' => $request->service_name,
            'caption' => $request->caption,
            'paragraph1' => $request->paragraph_1,
            'paragraph2' => $request->paragraph_2,
            'list' => json_encode($request->list),
            'description' => $request->description,
            'slug'=> $slug,
            'updated_at' => Carbon::now()
        ]);
        $data = Service::find($id);
        if($request->hasFile('service_icon')){
            $file = $request->file('service_icon');
            @unlink(public_path('upload/service_icon/' . $data->service_icon));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/service_icon'), $filename);
            $data['service_icon'] = $filename;
        }
        $status=$data->save();
        if($status){
            $notification = array(
                'message' => 'Service Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('service.index')->with($notification);
        }else{
        
        }

        $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );

        // return redirect()->route('service.show', $id)->with($notification);
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
