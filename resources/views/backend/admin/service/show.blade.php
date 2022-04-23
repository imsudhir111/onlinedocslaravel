@extends('backend.admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Show Service</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Show Service</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Caption</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
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
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Service Name</th>
                        <th>Caption</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
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
