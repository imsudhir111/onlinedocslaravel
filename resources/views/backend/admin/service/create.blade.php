@extends('backend.admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="content pt-3">
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
                                    <div class="form-group">
                                        <label for="service">Service Name</label>
                                        <input type="text" name="service_name" class="form-control" id="service_name"
                                            placeholder="Service Name">
                                        @error('service_name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Caption</label>
                                        <input type="text" class="form-control" id="caption" name="caption"
                                            placeholder="Caption" value="{{ old('caption') }}">

                                        @error('caption')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" id="description" name="description"
                                            placeholder="Description">{{ old('description') }}</textarea> 
                                            @error('description')
                                            <span class="text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                            @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="icon">Icon</label>
                                        <input type="file" class="form-control p-1" id="service_icon" name="service_icon"
                                            placeholder="Service Icon" onchange="readURL(this)">
                                            @error('service_icon')
                                            <span class="text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                            @enderror
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
