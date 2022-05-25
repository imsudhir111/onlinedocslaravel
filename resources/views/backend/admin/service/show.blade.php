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
                                <h3 class="card-title">Service Information</h3>
                                <a href="{{url('admin/service')}}" class="btn-sm btn-primary"
                                    style="float: right; position: absolute;right: 14px;margin: 0 auto;top: 8px;">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="serviceFormEdit" action="{{ route('service.update', $service->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">


                                    <div class="form-group">
                                        <label for="service_name">Service Name </label>
                                        <input type="text" class="form-control" id="service_name" readonly
                                            name="service_name" placeholder="Service Name"
                                            value="{{ $service->service_name }}">
                                        @error('service_name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Caption </label>

                                        <input type="text" class="form-control" id="caption" readonly name="caption"
                                            placeholder="Caption" value="{{ $service->caption }}">
                                        @error('caption')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Paragraph 1 </label>

                                        <input type="text" class="form-control" id="paragraph_1" readonly
                                            name="paragraph_1" placeholder="paragraph 1"
                                            value="{{ $service->paragraph1 }}">
                                        @error('paragraph_1')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Paragraph 2 </label>

                                        <input type="text" class="form-control" id="paragraph_2" readonly
                                            name="paragraph_2" placeholder="paragraph 2"
                                            value="{{ $service->paragraph2 }}">

                                    </div>
                                    <div class="row">
                                        <?php $i = 1; ?>
                                        @foreach (json_decode(urldecode($service->list)) as $list)
                                            <div class="col-lg-6  form-group">
                                                <label for="list1">List {{ $i }}</label>
                                                <input type="text" class="form-control" id="list1" readonly
                                                    value="{{ $list }}" name="list[]"
                                                    placeholder="List {{ $i }}">
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach


                                    </div>

                                    <div class="form-group">
                                        <label for="caption">Description </label>
                                        <textarea type="text" class="form-control" id="description" readonly name="description"
                                            placeholder="Description">{{ $service->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Service Icon </label>

                                        <input type="file" class="form-control p-1" id="service_icon" readonly
                                            name="service_icon" placeholder="Service Icon" {{-- onchange="readURL(this)" --}}
                                            onchange="document.getElementById('update_icon_image').src = window.URL.createObjectURL(this.files[0])">
                                        <br>
                                        <img style="max-height:auto;" id="update_icon_image" width="100px"
                                            src="{{ !empty($service->service_icon) ? url('upload/service_icon/' . $service->service_icon) : url('upload/service_icon/no_image.jpg') }}"
                                            alt="">
                                        <input type="hidden" class="form-control" readonly id="old_service_icon"
                                            name="old_service_icon" value="{{ $service->service_icon }}">
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
