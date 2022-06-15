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
                                <h3 class="card-title">Profile Information </h3>
                                 <a href="{{ url('admin/doctor-list') }}" class="btn-sm btn-primary"
                                    style="float: right; position: absolute;right: 14px;margin: 0 auto;top: 8px;">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="serviceFormEdit"
                                action="{{ route('service.update', $profile_info->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="service_name">Name </label>
                                                <input type="text" class="form-control" id="service_name" readonly
                                                    name="service_name" placeholder="Service Name"
                                                    value="{{ $profile_info->name ? $profile_info->name : 'n/a' }}">
                                                @error('service_name')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="caption">Email </label>
                                                <input type="text" class="form-control" id="caption" readonly
                                                    name="caption" placeholder="Caption"
                                                    value="{{ $profile_info->email }}">

                                            </div>
                                            <div class="row">
                                            <div class="col-4">
                                            <div class="form-group">
                                                <label for="caption">Mobile</label>

                                                <input type="text" class="form-control" id="paragraph_1" readonly
                                                    name="paragraph_1" placeholder="paragraph 1"
                                                    value="{{ $profile_info->mobile ? $profile_info->mobile : 'n/a' }}">

                                            </div>
                                            </div>
                                             <div class="col-4">
                                                <div class="form-group">
                                                    <label for="caption">Age</label>
            
                                                    <input type="text" class="form-control" id="age" readonly
                                                        name="age" placeholder="Age" value="{{ $profile_info->age ? $profile_info->age.' Years' : 'n/a' }}">
            
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="caption">Gender </label>
                                                   <input type="text" class="form-control" readonly value="{{$profile_info->gender ? $profile_info->gender : 'n/a'}}"">
                                                </div>
                                            </div>
                                        </div>
            
                                        </div>
                                        <div class="text-center col-lg-4">
                                            <img class="img-fluid user-img"
                                                src="{{ !empty($profile_info->photo) ? url('upload/profile_image/' . $profile_info->photo) : url('upload/profile_image/no_image.png') }}">
                                        </div>
                                    </div>
                                <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="caption">Address </label>
                                        <textarea type="text"  rows="2" cols="50" class="form-control" readonly >{{$profile_info->address ? $profile_info->address : 'n/a'}} State: {{isset($profile_info['state'][0]->state) ? $profile_info['state'][0]->state  : 'n/a'}} City: {{isset($profile_info['city'][0]->name) ? $profile_info['city'][0]->name  : 'n/a'}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="caption">Working Days</label><br>
                                        {{-- <input type="text" class="form-control" readonly value="{{$profile_info->gender ? $profile_info->gender : 'n/a'}}""> --}}
                                       @isset($profile_info->working_days)
                                            @foreach (json_decode($profile_info->working_days) as $key=>$working_day)
                                            {{$working_day ==='1' ? $key.',' : '' }}
                                            @endforeach
                                       @endisset
                                       
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="caption">Experience </label>
                                       <input type="text" class="form-control" readonly value="{{$profile_info->experience ? $profile_info->experience.' Years' : 'n/a'}}"">
                                    </div>
                                </div>
                                
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="caption">Highest Education </label>
                                       <input type="text" class="form-control" readonly value="{{$profile_info->highest_education ? $profile_info->highest_education : 'n/a'}}"">
                                    </div>
                                </div>
                                
                               
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="caption">Zoom Gmail Id </label>
                                       <input type="text" class="form-control" readonly value="{{$profile_info->zoom_gmail_id ? $profile_info->zoom_gmail_id : 'n/a'}}"">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="caption">Zoom Api Key </label>
                                       <input type="text" class="form-control" readonly value="{{$profile_info->zoom_api_key ? $profile_info->zoom_api_key : 'n/a'}}"">
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
