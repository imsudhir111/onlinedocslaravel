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
                                <h3 class="card-title">Blog Post </h3>
                                 <a href="{{ route('blog.index') }}" class="btn-sm btn-primary"
                                    style="float: right; position: absolute;right: 14px;margin: 0 auto;top: 8px;">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="serviceFormEdit"
                                action="{{ route('service.update', $blog_post->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="service_name">Caption </label>
                                                <input type="text" class="form-control" id="service_name" readonly
                                                    name="service_name" placeholder="Service Name"
                                                    value="{{ $blog_post->caption ? $blog_post->caption : 'n/a' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="tagline">Tag line </label>
                                                <input type="text" class="form-control" id="caption" readonly
                                                    name="tagline" placeholder="tagline"
                                                    value="{{ $blog_post->tagline }}">

                                            </div>
                                            <div class="form-group">
                                                <label for="tagline">Image </label><br>
                                                <img src="{{url('/upload/blog/photo/'.$blog_post->photo)}}" id="image" readonly name="image" />
                                            </div>
                                            <div class="row">
                                            <div class="col-12">
                                                <label for="tagline">Description </label>
                                                    {!! $blog_post->description !!}
                                            </div>
                                        </div>
            
                                        </div>
                       
                                    </div>
                              
                            </div>
                        </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
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
