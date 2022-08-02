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

    <!-- end add new service form -->
    
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Media /Press release</b>
                    <a href="{{ route('media-press-release.create') }}" class="btn-sm btn btn-primary" 
                    style="position: absolute;
                    right: 14px;
                    margin: 0 auto;
                    top:8px;
                    ">  <i class="fa fa-plus"></i>&nbsp;Add New </a> 
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="media_press_release_list" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Caption</th>  
                        <th>Image</th>  
                        <th>Created By</th>  
                        <th>Action</th>  

                    </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1; ?>
                    @foreach($media_press_released_post as $list)
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$list->caption}}</td>
                        <td>
                          <img class="profile-user-img img-fluid " src="{{ !empty($list->image) ? url('upload/press-media-release/image/' . $list->image) : url('upload/service_icon/no_image.jpg') }}" alt="profile">
                        </td>
                        <td>{{$list->created_by}}</td>
                        <td>
                          <form class="form-inline" id="media_press_release_form_id"
                              action="{{ route('media-press-release.destroy', $list->id) }}"
                              method="POST" onsubmit="return confirm('Are you sure?');">
                                    <label class="switch">
                                      <input type="checkbox"  id="{{$list->id}}" onchange="press_media_release_deactive_oncheck(this)" {{$list->active_status == 1 ? 'checked':''}}>
                                      <span class="slider round"></span>
                                    </label>
                                    <a href="{{ route('media-press-release.edit', $list->id) }}"
                                      class="btn btn-primary btn-sm m-1" title="Edit Data"> Update </a>
  
                               <button type="button" class="btn btn-primary btn-sm float-right m-1" id="{{$list->id}}" onclick="filter_media_press_by_media_press_release_id(this)" 
                                 data-toggle="modal" data-target="#add_media_press" data-whatever="@fat">Add Media/Press</button>

                             <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token"
                                  value="{{ csrf_token() }}">
                              <input type="submit"
                                  class="btn  btn-danger btn-sm float-right m-1"
                                  value="Delete">

                          </form>
                      </td>
                 
                    </tr>
                    @endforeach
                    </tbody>
                   </table>
                </div>
                <!-- /.card-body -->

                        <!-- start update new contact form by id-->
<div class="card-body">
  <form  id="assign_media_release_form" >
  @csrf
  <div class="modal fade" id="add_media_press" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
        </div> -->
        <div class="card-header" style=" float:inherit !important;"="">
            <h3 class="card-title">Add <small>New Press/Media</small></h3>
        </div>
      <div class="modal-body">
          <div class="row">
          <div class="col-xl-12">
            <div class="form-group">
              <label for="p_address">Media/Press*</label>
              
              <select class="form-control" name="media_press" id="media_press_list">
              
              </select>
              
                @error('media_press')
              {{-- <span class="text-danger" role="alert"> --}}
                  {{ $message }}
              {{-- </span> --}}
            @enderror
            </div>
          </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Url</label>
            <input type="text" name="url" class="form-control" id="url" placeholder="Enter Url">
            @error('url')
              <span class="text-danger" role="alert">
                  {{ $message }}
              </span>
            @enderror
        </div>
              <input type="hidden" name="media_press_release_id" id="media_press_release_id" value="">
         </div>
        <div class="modal-footer">
        <button type="submit" id="" class="save_assigned_media_press btn btn-primary" onclicks="save_assigned_media_press(this)" >Save</button>
          <button class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
  
      </div>
      
    </div>
  </div>
  </div>
  </form>
  <!-- end update contact form -->
  
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
      <script>
   
    
    </script>  
</div>
@endsection
@section('script')
@endsection
