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
<!-- start add new contact form -->
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
          <div class="card-header style=" float:inherit="" !important;"="">
                        <h3 class="card-title">Add New <small>Contact</small></h3>
          </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputPassword1">Full Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
              
              <span id="s_full_name" class="text-danger" role="alert">
                
              </span>
            
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="text" name="email" class="form-control" id="s_email" placeholder="Email">
              
              <span id="error_s_email" class="text-danger" role="alert">
                
              </span>
            
            </div>
            <div class="form-group">
              <label for="mobile">Mobile</label>
              <input type="text" name="mobile" class="form-control" id="s_mobile" placeholder="mobile">
              
              <span id="error_s_mobile" class="text-danger" role="alert">
                
              </span>
            
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Photo</label>
              <input type="file" name="photo" class="form-control" id="s_photo" placeholder="photo">
              
              <span id="error_s_photo" class="text-danger" role="alert">
                
              </span>
            
            </div>
            <div class="row">
    
            <div class="col-xl-6">
                          <div class="form-group">
                          <label for="p_address">State*</label>
                          <select class="form-control" name="state" id="state" onchange="city_filter_handler()">
                            <option value="">select state</option>
    
                             
                          </select>
                          <span id="error_state" class="text-danger" role="alert">
                
                          </span>
                          {{-- <input type="text" name="city" class="form-control" id="city" placeholder="City"> --}}
                          @error('city')
                          <span class="text-danger" role="alert">
                              {{ $message }}
                          </span>
                      @enderror
                          </div>
                        
                    </div>
                        <div class="col-xl-6">
                          <div class="form-group">
                            <label for="p_address" >City*</label>
                            <select class="form-control" name="city" id="city_list">
                            <option value="">select state</option>
                            
                            </select>
                            <span id="error_city_list" class="text-danger" role="alert">
                
                            </span>
                              @error('city')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                          @enderror
                          </div>
                        </div>
                        </div>
    
                        <div id="update_password_msg" class="mt-3 btn btn-block btn-warning" role="alert" style="display:none;" > updated successfully </div>
          
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
    <!-- end add new contact form -->
    
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>CONTACT LISTS</b>
                        <a  href="{{url('/')}}" data-toggle="modal" data-target="#addNewService" id="addservice" class="btn-sm btn btn-primary" style="
                        position: absolute;
                        right: 14px;
                        margin: 0 auto;
                        top: 8px;
                        ">
                    <i class="fa fa-plus"></i>
                    Add New
                  </a>
      
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
