@extends('backend.admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary" >
                        <div class="card-header">
                            <h3 class="card-title">Add Question</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form role="form" id="serviceForm" action="{{ route('question.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                            <div class="card-body pb-0" id="wrapx">
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label for="question"  >Question </label>
                                             <input type="text" required class="form-control" id="question"
                                                name="question" placeholder="Question"
                                                value="{{old('question')}}">
                                     </div>
                                     <div class="col-lg-6 form-group">
                                        <label for="question"  >Services </label>
                                             {{-- <input type="text" class="form-control" id="question"
                                                name="question" placeholder="Question"
                                                value="{{old('question')}}"> --}}
                                                <select class="form-control" required name="selected_service">
                                                    <option value="">Select service</option>
                                                    @foreach ($services as $service)
                                                    <option value="{{$service->id}}">{{$service->service_name}}</option>
                                                    @endforeach
                                                  </select>
                                     </div>
                                </div>
                                <div class="row">
                                        
                                        <div class="col-lg-6  form-group">
                                            <label for="option1" >Option 1</label>
                                                <input type="text" required class="form-control" id="option1"
                                                    name="option[]" placeholder="Option">
                                        </div>
                                        <div class="col-lg-6  form-group">
                                            <label for="option2" >Option 2</label>
                                                 <input type="text" required class="form-control" id="option2"
                                                    name="option[]" placeholder="Option">
                                         </div>
                                        </div>
                                <div class="row" id="wrap">

                                        <div class="col-lg-6 form-group">
                                            <label for="option3">Option 3</label>
                                                 <input type="text" required class="form-control" id="option3"
                                                    name="option[]" placeholder="Option">
                                         </div>
                                         
                                        <div class="col-lg-6 form-group">
                                            <label for="option4" >Option 4</label>
                                                 <input type="text" required class="form-control" id="option4"
                                                    name="option[]" placeholder="Option">
                                         </div>
                                         
                                        </div>

                                       
                                         <input type="hidden" id="box_count" value="1">
                                         <input type="hidden" id="option_count" value="4">
                                         <input type="hidden" name="__update_id" id="__update_id" value="">
                                    </div>
                                    <div class="form-group btn-group" role="group" style="padding-left: 1.2rem!important;" aria-label="First group">
                                        <a onclick="add_more()" class="btn btn-primary "><i class="fa fa-plus"></i></a>
                                       </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </div>
                            <!-- /.card-body -->
                            
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
