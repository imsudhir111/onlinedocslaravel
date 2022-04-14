@extends('backend.admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- <div class="container-full">
          Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Category</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Category</li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Wrapper. Contains page content -->

        <div class="container-full">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!--   ------------ Add Category Page -------- -->

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Category </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                    <form id="categoryFrom" method="post" action="{{ route('admin.category.update', $category->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-4"><div class="form-group ">
                                                <h5>Category Icon <span class="text-danger">*</span></h5>

                                                <img id="mainIcon"
                                                    src="{{ !empty($category->category_icon) ? url('upload/category_images/' . $category->category_icon) : url('upload/category_images/no_image.jpg') }}"
                                                    }}" alt="" class="profile-img img-responsive center-block"
                                                    style="width: 200px" ;>

                                                <div class="controls">
                                                    <input type="file" name="category_icon" class="form-control"
                                                        onChange="mainIconUrl(this)">
                                                    @error('category_icon')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainIcon">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-8">

                                                <div class="form-group  col-6 ">
                                                    <h5>Category English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_name_en" class="form-control"
                                                            value="{{ $category->category_name_en }}">
                                                        @error('category_name_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group  col-6">
                                                    <h5>Category native <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_name_native" class="form-control"
                                                            value="{{ $category->category_name_native }}">
                                                        @error('category_name_native')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group  col-6">
                                                    <input type="checkbox" id="checkbox_7" name="status" value="1"
                                                        {{ $category->status == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_7">Active</label>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group  col-6">
                                                    <input type="checkbox" id="checkbox_6" name="navbar_menu" value="1"
                                                        {{ $category->navbar_menu == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_6">Navbar Menu</label>
                                                    @error('navbar_menu')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                        value="Update">
                                                </div>
                                            </div>



                                        </div>
                                    </form>

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
