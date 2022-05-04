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
                  <h3 class="card-title">All Questions</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 form-group"> 
                            <form action="{{ route('question.index') }}" method="resource" enctype="multipart/form-data">
                                @csrf
                            <select class="form-control" style="cursor: pointer" required name="selected_service">
                                <option value="">Select service</option>
                                @foreach ($services_list as $service)
                                <option  style="cursor: pointer"  value="{{$service->id}}">{{$service->service_name}}</option>
                                @endforeach
                            </select>
                       
                        </div>
                        <div class="col-lg-2 form-group"> 
                        <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </form>
                    </div>
             
                  <table id="question_list" class="table table-bordered table-striped">
                    <thead> 
                    <tr>
                        <th>Id</th>
                        <th>Question</th>
                        <th>Option1</th>
                        <th>Option2</th>
                        <th>Option3</th>
                        <th>Option4</th>
                        <th>Option5</th>
                        <th>Option6</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sr_no=1;    
                    // die();
                    $i=1;
                    ?>
                    @foreach($ques_options_list as $question_option)
                     
                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td >{{$question_option->question}}</td> 
                         @for ($i = 0; $i < 6; $i++)
                        <td >{{isset($question_option->options[$i]['option']) ? $question_option->options[$i]['option']:'n/a'}}</td> 
                        @endfor
 
                        <td>
                            <form class="form-inline"
                                action="{{ route('question.destroy', $question_option->id) }}"
                                method="POST" onsubmit="return confirm('Are you sure?');">
                                <a href="{{ route('question.edit', $question_option->id) }}"
                                    class="btn btn-warning btn-xs m-1" title="Edit Data"> Edit
                                </a>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token"
                                    value="{{ csrf_token() }}">
                                <input type="submit"
                                    class="btn  btn-danger btn-xs float-right m-1"
                                    value="Delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    
                    </tfoot>
                  </table>
                </div>
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
