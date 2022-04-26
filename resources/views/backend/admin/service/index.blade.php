@extends('backend.admin.layouts.app')

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
            <h3 class="card-title"><b>ADD SERVICE</b>
            </h3>
          </div>
      </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="service">Service Name</label>
              <input type="text" name="service_name" class="form-control" id="service_name" placeholder="Service Name">

              <span id="error_service_name" class="text-danger" role="alert">
              </span>
            
            </div>
            <div class="form-group">
              <label for="caption">Caption</label>
              <input type="text" name="service_caption" class="form-control" id="service_caption" placeholder="Caption">
              <span id="error_caption" class="text-danger" role="alert">
              </span>
            
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input type="text" name="description" class="form-control" id="description" placeholder="mobile">
              <textarea name="description" id="description" cols="30" rows="10"  placeholder="Description"></textarea>
              <span id="error_description" class="text-danger" role="alert">
                
              </span>
            
            </div>
            <div class="form-group">
              <label for="icon">Icon</label>
              <input type="file" name="service_icon" class="form-control" id="service_icon" placeholder="photo">
              <span id="error_service_icon" class="text-danger" role="alert">
                
              </span>
            
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
                        <th>Service Name</th>
                        <th>Caption</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1; ?>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$service->service_name}}</td>
                        <td>{{$service->caption}}</td>
                        <td>{{$service->description}}</td>
                        <td><img class="profile-user-img img-fluid img-circle" src="{{ !empty($service->service_icon) ? url('upload/service_icon/' . $service->service_icon) : url('upload/service_icon/no_image.jpg') }}" alt="profile"></td>
                        <td>
                            <form class="form-inline"
                                action="{{ route('service.destroy', $service->id) }}"
                                method="POST" onsubmit="return confirm('Are you sure?');">
                                <a href="{{ route('service.show', $service->id) }}"
                                    class="btn btn-info btn-xs m-1" title="Edit Data"> View </a>
                                <a href="{{ route('service.edit', $service->id) }}"
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
