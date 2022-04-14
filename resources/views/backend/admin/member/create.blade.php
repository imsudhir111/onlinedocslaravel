@extends('backend.admin.layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">


<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Member</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Member</li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">

            <div class="row">


                <!-- Profile Image -->
            </div>
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="container bootstrap snippets bootdeys">
                    <form action="{{ route('admin.member.registernewuser') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row" id="user-profile">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="main-box clearfix">
                                    <div class="profile-header">

                                </div>

                                <div class="row profile-user-info">
                                    <div class="row form-group row col-sm-12 "><span class="header nav-small-cap">Product Info</span><br>
                                    </div>
                                    <div class="form-group row col-sm-6">
                                        <label for="name" class="col-sm-3 col-form-label form-control-sm">Name:</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Enter Name" required>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-6">
                                        <label for="email" class="col-sm-3 col-form-label form-control-sm">Email:</label>
                                        <div class="controls col-sm-9">
                                            <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Enter Email" required>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-6">
                                        <label for="phone_number" class="col-sm-3 col-form-label form-control-sm">Phone Number:</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" value="{{ old('phone_number') }}" name="phone_number" class="form-control" placeholder="Enter Phone Number" required>
                                            @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-6">
                                        <label for="role_id"
                                            class="col-sm-3 col-form-label form-control-sm">Select User Type
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="role_id" class="form-control">
                                                <option value="" selected="">Select User Type</option>
                                                <option value="2">Pharmacy</option>
                                                <option value="3">Customer</option>
                                                <option value="4">Delivery Driver</option>
                                                <option value="5">Support Member</option>
                                                <option value="6">Sub Admin</option>
                                            </select>
                                            @error('role_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-6">
                                        <label for="password" class="col-sm-3 col-form-label form-control-sm">Password:</label>
                                        <div class="controls col-sm-9">
                                            <input type="password" value="{{ old('password') }}" name="password" class="form-control" placeholder="Enter Password">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-6">
                                    </div>

                                    <input class="btn btn-info save-profile" type="submit" name="" value="Create Member">

                                </div>
                    </form>


                </div>

                <!-- /.nav-tabs-custom -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.row -->
</div>
<script src="{{ asset('/backend/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('.date').datepicker({
       format: 'dd-mm-yyyy'
     });
</script>


<script type="text/javascript">
    function mainThumUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(80)
                                    .height(80); //create image element
                                $('#preview_img').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

@endsection
