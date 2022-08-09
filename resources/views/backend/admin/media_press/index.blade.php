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
                  <h3 class="card-title"><b>Media /Press</b>
                    <a href="{{ route('media-press.create') }}" class="btn-sm btn btn-primary" 
                    style="position: absolute;
                    right: 14px;
                    margin: 0 auto;
                    top:8px;
                    ">  <i class="fa fa-plus"></i>&nbsp;Add New </a> 
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="media_press_post_list" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>  
                        <th>Image</th>  
                        <th>Image</th>  
                        <th>Created By</th>  
                        <th>Action</th>  

                    </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1; ?>
                    @foreach($media_press_post as $list)
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$list->name}}</td>
                        <td>
                          <img class="profile-user-img img-fluid " src="{{ !empty($list->small_icon) ? url('upload/press-media/small_icon/' . $list->small_icon) : url('upload/service_icon/no_image.jpg') }}" alt="profile">
                        </td>
                        <td>
                          <img class="profile-user-img img-fluid " src="{{ !empty($list->big_icon) ? url('upload/press-media/big_icon/' . $list->big_icon) : url('upload/service_icon/no_image.jpg') }}" alt="profile">
                        </td>
                        <td>{{$list->created_by}}</td>
                        <td>
                          <form class="form-inline" id="media_press_form_id"
                              action="{{ route('media-press.destroy', $list->id) }}"
                              method="POST" onsubmit="return confirm('Are you sure?');">

                                {{-- <a href="{{ route('media-press.show', $list->id) }}"
                                    class="btn btn-primary btn-sm m-1" title="Edit Data"> View </a> --}}
                              <a href="{{ route('media-press.edit', $list->id) }}"
                                    class="btn btn-primary btn-sm m-1" title="Edit Data"> Update </a>

                                    <label class="switch">
                                      <input type="checkbox"  id="{{$list->id}}" onchange="press_media_deactive_oncheck(this)" {{$list->active_status == 1 ? 'checked':''}}>
                                      <span class="slider round"></span>
                                    </label>

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
