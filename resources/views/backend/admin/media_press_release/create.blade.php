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
                                <h3 class="card-title">Add New Media/Press Release</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="bog_Form" action="{{ route('media-press-release.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="name">Caption</label>
                                        <input type="text" name="caption" class="form-control" id="caption"
                                            placeholder="Media/Press Release caption" value="{{ old('caption') }}"">
                                        @error('caption')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" id="press_release_description" name="description"
                                            placeholder="Description" value="{{ old('description') }}">
                                        </textarea>

                                        @error('description')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

                                 
                                    <div class="form-group">
                                        <label for="photo">Small Icon</label><br>
                                        <img id="preview_image_photo"  style="margin:0 auto;" max-height="200" max-width="200"> 
                                        <input type="file" class="form-control p-1" id="image" 
                                        name="image"
                                        onchange="document.getElementById('preview_image_photo').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="Small Icon" onchange="readURL(this)">
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="row">
                                            @foreach ($media_press_list as $list)
                                                <div class="form-group col-3">
                                                        <label for="media press" class="">{{$list->name}}</label>
                                                        <input type="checkbox" value="{{$list->id}}" name="media_press[]"> 
                                                        <input type="text" class="form-control" value="" name="media_press_release_url[]">
                                                </div>
                                            @endforeach
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="created_by">Created By</label>
                                       <select  class="form-control p-1" name="created_by" id="created_by">
                                       <option value="Admin">Admin</option>
                                    </select>
                                        @error('created_by')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
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
