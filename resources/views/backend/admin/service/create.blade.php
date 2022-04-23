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
                        <li class="breadcrumb-item active">Add Service</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Service</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form role="form" id="serviceForm" action="{{ route('service.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-group row">
                                            <label for="service_name" class="col-2 col-form-label">Service Name </label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="service_name"
                                                    name="service_name" placeholder="Service Name"
                                                    value="{{old('service_name')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="caption" class="col-2 col-form-label">Caption </label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="caption"
                                                    name="caption" placeholder="Caption"
                                                    value="{{old('caption')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="caption" class="col-2 col-form-label">Description </label>
                                            <div class="col-10">
                                                <textarea type="text" class="form-control" id="description"
                                                    name="description" placeholder="Description">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="service_icon" class="col-2 col-form-label">Service Icon </label>
                                            <div class="col-10">
                                                <input type="file" class="form-control" id="service_icon" name="service_icon" placeholder="Service Icon" onchange="readURL(this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
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
