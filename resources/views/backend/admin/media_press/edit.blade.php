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
                                <h3 class="card-title">Add Blog Post</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="blog_Form_update" action="{{ route('blog.update',$blog_post->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="caption">Caption</label>
                                        <input type="text" name="caption" class="form-control" id="caption"
                                            placeholder="Caption" value="{{$blog_post->caption}}">
                                        @error('caption')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tagline">Tagline</label>
                                        <input type="text" name="tagline" class="form-control" id="tagline"
                                            placeholder="Tagline" value="{{ $blog_post->tagline }}"">
                                        @error('tagline')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" id="blog_description" name="description"
                                            placeholder="Description" value="{{ $blog_post->description }}">{{$blog_post->description}}
                                        </textarea>

                                        @error('description')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

 
                                    <div class="form-group">
                                        <label for="photo">Image</label><br>
                                        <img id="preview_photo" src="{{$blog_post->photo ? url('/upload/blog/photo/'.$blog_post->photo):''}}" style="margin:0 auto;" max-height="200" max-width="200"> 
                                        <input type="file" class="form-control p-1" id="image" 
                                        name="photo"
                                        onchange="document.getElementById('preview_photo').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="image" onchange="readURL(this)">
                                        @error('photo')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Publishid By</label>
                                       <select  class="form-control p-1" name="published_by" id="published_by">
                                       <option value="admin">Admin</option>
                                    </select>
                                        @error('published_by')
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
