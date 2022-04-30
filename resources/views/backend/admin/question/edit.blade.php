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
                            {{-- {{die()}} --}}
                            <form role="form" id="serviceFormEdit" action="{{ route('question.update', $question->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="questions">Question </label>

                                                <input type="text" class="form-control" id="question" name="question"
                                                    placeholder="Question Name" value="{{ $question->question }}">
                                                 @error('question')
                                                    <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <?php 
                                            $sr_no=1;    
                                            ?>
                                           
                                            @foreach ($question->options as $option)
                                                <div class="form-group">
                                                    <label for="options">Option {{$sr_no}} </label>
                                                    <input type="text" class="form-control" id="option<?php echo $sr_no++ ?>" name="option[]"
                                                    placeholder="Option" value="{{ $option->option }}">
                                                    <input type="hidden" name="option_id[]"  value="{{$option->id }}" >                                                 
                                                </div>
                                            @endforeach

                                            @error('option[]')
                                            <span class="text-danger" role="alert">
                                            {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
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
