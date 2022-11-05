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
                                        <label for="caption">Paragraph 1</label>
                                      <!--   <input type="text" class="form-control" id="caption" name="paragraph_1"
                                            placeholder="Paragraph 1" > -->
                                        <textarea type="text" class="form-control" id="first_para_section" name="paragraph_1"
                                        placeholder="Paragraph 1" value="{{ old('paragraph_1') }}">
                                        </textarea>
                                        @error('paragraph_1')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Paragraph 2</label>
                                       <!--  <input type="text" class="form-control" id="paragraph_2" name="paragraph_2"
                                            placeholder="paragraph 2" >
 -->                                        <textarea type="text" class="form-control" id="second_para_section" name="paragraph_2"
                                            placeholder="Paragraph 2" value="{{ old('paragraph_2') }}">
                                        </textarea>
                                        @error('paragraph_2')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-lg-6  form-group">
                                            <label for="list1" >List 1</label>
                                                <input type="text"  class="form-control" id="list1"
                                                    name="list[]" placeholder="List 1">
                                        </div>
                                        <div class="col-lg-6  form-group">
                                            <label for="list2" >List 2</label>
                                                 <input type="text"  class="form-control" id="list2"
                                                    name="list[]" placeholder="List 2">
                                         </div>
                                        </div>
                                <div class="row" id="wrap">

                                        <div class="col-lg-6 form-group">
                                            <label for="option3">List 3</label>
                                                 <input type="text"  class="form-control" id="list3"
                                                    name="list[]" placeholder="List 3">
                                         </div>
                                         
                                        <div class="col-lg-6 form-group">
                                            <label for="list4" >List 4</label>
                                                 <input type="text"  class="form-control" id="option4"
                                                    name="list[]" placeholder="List 4">
                                         </div>
                                         
                                        </div>

                                       
                                         <input type="hidden" id="box_count" value="1">
                                         <input type="hidden" id="list_count" value="4">
                                         <input type="hidden" name="__update_id" id="__update_id" value="">
                                   
                                    <div class="form-group btn-group" role="group" aria-label="First group">
                                        <a onclick="add_more_list()" class="btn btn-primary" id="add_more_list"><i class="fa fa-plus"></i></a>
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
