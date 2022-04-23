@extends('backend.admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Question</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Question</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form role="form" id="serviceForm" action="{{ route('question.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-group row">
                                            <label for="question" class="col-2 col-form-label">Question </label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="question"
                                                    name="question" placeholder="Question"
                                                    value="{{old('question')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="option1" class="col-2 col-form-label">Option 1</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="option1"
                                                    name="option[]" placeholder="Option">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="option2" class="col-2 col-form-label">Option 2</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="option2"
                                                    name="option[]" placeholder="Option">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="option3" class="col-2 col-form-label">Option 3</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="option3"
                                                    name="option[]" placeholder="Option">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="option4" class="col-2 col-form-label">Option 4</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="option4"
                                                    name="option[]" placeholder="Option">
                                            </div>
                                        </div>
                                    </div>
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
