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
                                <h3 class="card-title">Update Media/Press</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="blog_Form_update" action="{{ route('media-press.update',$media_press[0]->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Media/Press Name" value="{{ $media_press[0]->name }}"">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                 
                                    <div class="form-group">
                                        <label for="photo">Small Icon</label><br>
                                        <img id="preview_small_icon_photo"
                                        class="profile-user-img img-fluid" 
                                        src="{{ !empty($media_press[0]->small_icon) ? url('upload/press-media/small_icon/' . $media_press[0]->small_icon) : url('upload/service_icon/no_image.jpg') }}"
                                         style="margin:0 auto;" max-height="200" max-width="200"> 
                                        <input type="file" class="form-control p-1" id="small_icon" 
                                        name="small_icon"
                                        onchange="document.getElementById('preview_small_icon_photo').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="Small Icon" onchange="readURL(this)">
                                        @error('small_icon')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Big Icon</label><br>
                                        <img id="preview_big_icon_photo" 
                                        class="profile-user-img img-fluid "
                                        src="{{ !empty($media_press[0]->big_icon) ? url('upload/press-media/big_icon/' . $media_press[0]->big_icon) : url('upload/service_icon/no_image.jpg') }}"
                                        style="margin:0 auto;" max-height="200" max-width="200"> 
                                        <input type="file" class="form-control p-1" id="big_icon" 
                                        name="big_icon"
                                        onchange="document.getElementById('preview_big_icon_photo').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="Small Icon" onchange="readURL(this)">
                                        @error('big_icon')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Created By</label>
                                       <select  class="form-control p-1" name="created_by" id="created_by">
                                       <option value="admin">Admin</option>
                                    </select>
                                        @error('created_by')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
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
