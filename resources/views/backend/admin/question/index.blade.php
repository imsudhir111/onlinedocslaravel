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
                  <table id="question_list" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Service Name</th>
                        <th>Question</th>
                        {{-- <th>Option1</th>
                        <th>Option2</th>
                        <th>Option3</th>
                        <th>Option4</th> --}}
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sr_no=1;    
                    ?>
                    @foreach($questions as $question)
                    {{-- {{$question}} --}}
                    {{-- {{$question->service}} --}}
                    {{-- {{$question['service']}} --}}

                    <tr>
                        <td>{{$sr_no++}}</td>
                        <td>{{$question->service_name ?'':''}}</td>
                        <td >{{$question->question}}</td> 
                        <td>
                            <form class="form-inline"
                                action="{{ route('service.destroy', $question->id) }}"
                                method="POST" onsubmit="return confirm('Are you sure?');">
                                <a href="{{ route('service.show', $question->id) }}"
                                    class="btn btn-info btn-xs m-1" title="Edit Data"> View </a>
                                <a href="{{ route('question.edit', $question->id) }}"
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
                    {{-- <tr>
                        <th>Id</th>
                        <th>Service Name</th>
                        <th>Question</th>
                        <th>Actions</th>
                    </tr> --}}
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
