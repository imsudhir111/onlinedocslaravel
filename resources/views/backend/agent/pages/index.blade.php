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
    <form  id="add_new_service" >
    @csrf
    <div class="modal fade" id="addNewService" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
          </div> -->
          <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><b>ADD DOCTOR</b>
            </h3>
          </div>
      </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="service">Name</label>
              <input type="text" name="service_name" class="form-control" id="service_name" placeholder="Service Name">
 
            </div>
            <div class="form-group">
              <label for="caption">Email</label>
              <input type="text" name="service_caption" class="form-control" id="email" placeholder="Email">
              
            
            </div>
            <div class="form-group">
              <label for="description">Mobile</label>
              <input type="text" name="mobile" class="form-control" id="mobile" placeholder="mobile">
               
            </div>
            <div class="form-group">
              <label for="icon">Photo</label>
              <input type="file" name="photo" class="form-control" id="photo" placeholder="photo">
               
            
            </div>
        
          <div class="modal-footer">
    
          <button type="submit" id="contact_save" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
    
        </div>
        
      </div>
    </div>
    </div>
    </form>
    <!-- end add new service form -->
    
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>SERVICE LISTS</b> 
                    <a href="{{ route('service.create') }}" class="btn-sm btn btn-primary" 
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
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1; ?>
                    @foreach($doctor_lists as $doctor_list)
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$doctor_list->name ? $doctor_list->name:'n/a'}}</td>
                        <td>{{$doctor_list->email}}</td>
                        <td>{{$doctor_list->mobile ? $doctor_list->mobile:'n/a'}}</td>
                        <td><img class="profile-user-img img-fluid img-circle" src="{{ !empty($doctor_list->photo) ? url('upload/profile_image/' . $doctor_list->photo) : url('upload/profile_image/no_image.jpg') }}" alt="profile"></td>
                        <td>
                            <form class="form-inline"
                                action="{{ route('doctor-list.destroy', $doctor_list->id) }}"
                                method="POST" onsubmit="return confirm('Are you sure?');">
                                <a href="{{ route('doctor-list.show', $doctor_list->id) }}"
                                    class="btn btn-info btn-xs m-1" title="Edit Data"> View </a>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                      </label>
                                <a href="{{ route('doctor-list.edit', $doctor_list->id) }}"
                                    class="btn btn-warning btn-xs m-1" title="Edit Data"> Edit
                                </a>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token"
                                    value="{{ csrf_token() }}">
                                <input type="submit"
                                    class="btn  btn-danger btn-xs float-right m-1"
                                    value="Delete">
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
