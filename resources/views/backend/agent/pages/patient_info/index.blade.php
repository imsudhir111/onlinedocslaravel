@extends('backend.agent.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Services</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section> --}}
<!-- start add new service form -->
<div class="card-body">
    
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>PATIENT LISTS</b> 
                    <a href="{{ route('patient.create') }}" class="btn-sm btn btn-primary" 
                    style="position: absolute;
                    right: 14px;
                    margin: 0 auto;
                    top:8px;
                    ">  <i class="fa fa-plus"></i>&nbsp;Add New </a>      
                      </h3>
      
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="all_services" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Email</th> 
                        <th>Mobile</th>
                        <th>Type</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1; ?>
                    @foreach($patient_lists as $patient_list)
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$patient_list->name ? $patient_list->name:'n/a'}}</td>
                        <td>{{$patient_list->email}}</td>
                        <td>{{$patient_list->mobile ? $patient_list->mobile:'n/a'}}</td>
                        <td>{{$patient_list->type ? $patient_list->type:'n/a'}}</td>
                        <td><img style="height:50px; width:50px;" class="profile-user-img img-fluid img-circle" src="{{ !empty($patient_list->photo) ? url('upload/profile_image/' . $patient_list->photo) : url('upload/profile_image/no_image.png') }}" alt="profile"></td>
                        <td>
                            <form class="form-inline"
                                action="{{ route('patient.destroy', $patient_list->id) }}"
                                method="POST" onsubmit="return confirm('Are you sure?');">
                                
                                <a href="{{ route('patient.show', $patient_list->id) }}"
                                    class="btn btn-info btn-xs m-1" title="View Patient"> View </a>
                                 
                                <a href="{{ route('patient.edit', $patient_list->id) }}"
                                    class="btn btn-warning btn-xs m-1" title="Edit Data"> Edit
                                </a>
                               
                                </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                     
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
@endsection
