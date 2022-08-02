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
                  <h3 class="card-title"><b>BLOG /POSTS</b>
                    <a href="{{ route('blog.create') }}" class="btn-sm btn btn-primary" 
                    style="position: absolute;
                    right: 14px;
                    margin: 0 auto;
                    top:8px;
                    ">  <i class="fa fa-plus"></i>&nbsp;Add New </a> 
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="blog_post_list" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Caption</th>  
                        <th>Tagline</th>  
                        <th>Image</th>  
                        <th>Published By</th>  
                        <th>Action</th>  

                    </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1; ?>
                    @foreach($blog_post as $list)
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$list->caption}}</td>
                        <td>{{$list->tagline ? $list->tagline:'n/a'}}</td>
                        <td>
                          <img class="profile-user-img img-fluid img-circle" src="{{ !empty($list->photo) ? url('upload/blog/photo/' . $list->photo) : url('upload/service_icon/no_image.jpg') }}" alt="profile">
                        </td>
                        <td>{{$list->published_by}}</td>
                        <td>
                          <form class="form-inline" id="blog_form_id"
                              action="{{ route('blog.destroy', $list->id) }}"
                              method="POST" onsubmit="return confirm('Are you sure?');">

                                <a href="{{ route('blog.show', $list->id) }}"
                                    class="btn btn-primary btn-sm m-1" title="Edit Data"> View </a>
                              <a href="{{ route('blog.edit', $list->id) }}"
                                    class="btn btn-primary btn-sm m-1" title="Edit Data"> Update </a>

                                    <label class="switch">
                                      <input type="checkbox"  id="{{$list->id}}" onchange="active_deactive_oncheck(this)" {{$list->active_status == 1 ? 'checked':''}}>
                                      <span class="slider round"></span>
                                    </label>
                                    
                                   <a class="btn btn-sm btn-{{is_null($list->published_at) ? 'warning' : 'success pointer__event'}} m-1"  href="{{url('admin/blog/publish')}}/{{ $list->id }}" data-toggle="tooltip" data-placement="top" title="Publish!">
                                    {{is_null($list->published_at) ? 'Publish' : 'Published'}}
                              </a>
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
