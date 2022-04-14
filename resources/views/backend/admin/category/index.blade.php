@extends('backend.admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-9">
                        <div class="box">
                            <div class="box-header with-border">

                                <div class="d-flex align-items-center">
                                    <div class="mr-auto">
                                        <h3 class="page-title">Category List <span class="badge badge-pill badge-danger">
                                               {{ count($category) }}
                                           </span></h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="categorylist" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th>Image</th>
                                                <th>Category En</th>
                                                <th>Category Native </th>
                                                <th>Status</th>
                                                <th>Navbar Menu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $item)
                                                <tr>
                                                    <td>
                                                        <img id="mainIcon"
                                                            src="{{ !empty($item->category_icon) ? url('upload/category_images/' . $item->category_icon) : url('upload/category_images/no_image.jpg') }}"
                                                            alt="" class="profile-img img-responsive center-block"
                                                            style="width: 60px; height: 50px;" ;>
                                                    </td>

                                                    <td>{{ $item->category_name_en }}</td>
                                                    <td>{{ $item->category_name_native }}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-pill badge-success"> Active </span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger"> InActive </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->navbar_menu == 1)
                                                            <span class="badge badge-pill badge-success"> Yes </span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">No</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div>

                                                            <form class="form-inline"
                                                                action="{{ route('admin.category.destroy', $item->id) }}"
                                                                method="POST" onsubmit="return confirm('Are you sure?');">

                                                                <a href="{{ route('admin.category.edit', $item->id) }}"
                                                                    class="btn btn-warning btn-xs m-1" title="Edit Data">
                                                                    Edit
                                                                </a>

                                                                {{-- <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="submit"
                                                                    class="btn  btn-danger btn-xs float-right m-1"
                                                                    value="Delete"> --}}
                                                            </form>
                                                            <!-- <a href="{{ route('admin.category.destroy', $item->id) }}" class="btn btn-danger" id="delete">Delete</a> -->
                                                        </div>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->


                    <!--   ------------ Add Category Page -------- -->


                    <div class="col-3">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Category </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">


                                    <form id="categoryFrom" method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-group">
                                            <h5>Category English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_name_en" class="form-control">
                                                @error('category_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <h5>Category Native <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_name_native" class="form-control">
                                                @error('category_name_native')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Category Icon <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="category_icon" class="form-control" onChange="mainIconUrl(this)">
                                                @error('category_icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <img src="" id="mainIcon">
                                            </div>
                                        </div>

                                        <div class="form-group row col-sm-4">
                                            <input type="checkbox" id="checkbox_3" name="status" value="1">
                                            <label for="checkbox_3">Activate</label>
                                            @error('product_favourite')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group row col-sm-4">
                                            <input type="checkbox" id="checkbox_4" name="navbar_menu" value="1">
                                            <label for="checkbox_4">Navbar Menu</label>
                                            @error('navbar_menu')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                       {{--
                                        <div class="form-group">
                                            <h5>Category Icon <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_icon" class="form-control">
                                                @error('category_icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        --}}

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>




                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>
    <script type="text/javascript">
        function mainIconUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainIcon').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
