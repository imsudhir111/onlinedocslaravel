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

    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Zoom Setting</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 form-group"> 
                            <form action="{{ url('admin/update-zoom-setting') }}"
                                method="POST" >
                                @csrf
                            <select class="form-control" style="cursor: pointer" required name="selected_doctor">
                                <option value="">Select doctor</option>
                                @foreach ($doctor_list as $doctor)
                                <option  style="cursor: pointer"  value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Zoom Api Key</label>
                                <input id="zoom_api_key" class="form-control" type="text" name="zoom_api_key" placeholder="Zoom Api Key" 
                                value="{{ old('zoom_api_key') }}">
                                @error('zoom_api_key')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Api Secret Key</label>
                                <input type="text" class="form-control" id="age"
                                value="{{ old('zoom_api_secret_key') }}"
                                name="zoom_api_secret_key" placeholder="Zoom Api Secret key">
                            @error('zoom_api_secret_key')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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
