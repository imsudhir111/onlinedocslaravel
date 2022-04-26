@extends('backend.admin.layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Service</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="serviceFormEdit" action="{{ route('service.update', $service->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    
                                    
                                            <div class="form-group">
                                                <label for="service_name">Service Name </label>
                                                    <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Service Name"
                                                        value="{{ $service->service_name }}">
                                                        @error('service_name')
                                                            <span class="text-danger" role="alert">
                                                            {{ $message }}
                                                            </span>
                                                        @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="caption">Caption </label>
                                                
                                                    <input type="text" class="form-control" id="caption" name="caption"
                                                        placeholder="Caption" value="{{ $service->caption }}">
                                                        @error('caption')
                                                        <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                        </span>
                                                        @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="caption" >Description </label>
                                                     <textarea type="text" class="form-control" id="description" name="description"
                                                        placeholder="Description">{{ $service->description }}</textarea>
                                                        @error('description')
                                                        <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                        </span>
                                                        @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="caption" >Service Icon </label> 
                                                
                                                     <input type="file" class="form-control p-1" id="service_icon"
                                                        name="service_icon" placeholder="Service Icon"
                                                        {{-- onchange="readURL(this)" --}}
                                                        onchange="document.getElementById('update_icon_image').src = window.URL.createObjectURL(this.files[0])">
                                                        <br>
                                                        <img style="max-height:auto;" id="update_icon_image" width="100px" src="{{ !empty($service->service_icon) ? url('upload/service_icon/' . $service->service_icon) : url('upload/service_icon/no_image.jpg') }}" alt="">
                                                        <input type="hidden" class="form-control" id="old_service_icon"
                                                        name="old_service_icon" value="{{ $service->service_icon }}">
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
