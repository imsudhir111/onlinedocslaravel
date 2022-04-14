@extends('backend.admin.layouts.app')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Profile</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Profile</li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <form action="{{ route('admin.member.update', $userdetails->user_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row" id="user-profile">

                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <div class="main-box clearfix">


                                        <img id="showImage" src="{{ (!empty($userdetails->image_path))? url('upload/admin_images/'.$userdetails->image_path):url('upload/admin_images/no_image.jpg') }}" alt=""  class="profile-img img-responsive center-block" style="width: 100%" ;>




                                        <div class="form-group row">
                                            <label id="" for="image_path" class=" col-form-label form-control-sm">Change
                                                Image</label>
                                            <div class="">
                                                <input type="file" name="image_path" class="form-control"
                                                        id="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="main-box clearfix">
                                        <div class="profile-header">

                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="row profile-user-info">

                                            <div class="col-sm-8">

                                                <div class="form-group row">
                                                    <label for="firstname"
                                                        class="col-sm-3 col-form-label form-control-sm">First
                                                        Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="firstname"
                                                            value="{{ isset($userdetails->firstname) ? $userdetails->firstname : '' }}"
                                                            class="form-control form-control-sm" id="firstname">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="lastname"
                                                        class="col-sm-3 col-form-label form-control-sm">Last
                                                        Name:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="lastname"
                                                            value="{{ isset($userdetails->lastname) ? $userdetails->lastname : '' }}"
                                                            class="form-control form-control-sm" id="lastname">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="qualification"
                                                        class="col-sm-3 col-form-label form-control-sm">Qualification
                                                        :</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="qualification"
                                                            value="{{ isset($userdetails->qualification) ? $userdetails->qualification : '' }}"
                                                            class="form-control form-control-sm" id="qualification">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email"
                                                        class="col-sm-3 col-form-label form-control-sm">Email(Reg):</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="email"
                                                            value=" {{ $user->email ? $user->email : '' }}"
                                                            class="form-control form-control-sm" id="email" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="second_text"
                                                        class="col-sm-3 col-form-label form-control-sm">Second
                                                        Email:</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="second_email"
                                                            value="{{ isset($userdetails->second_email) ? $userdetails->second_email : '' }}"
                                                            class="form-control form-control-sm" id="inputEmail3">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label for="address_line1"
                                                            class="col-form-label form-control-sm">Address:</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="address_line1"
                                                            value=" {{ isset($userdetails->address_line1) ? $userdetails->address_line1 : '' }}"
                                                            class="form-control form-control-sm" id="address_line1">
                                                        <input type="text" name="address_line2"
                                                            value=" {{ isset($userdetails->address_line2) ? $userdetails->address_line2 : '' }}"
                                                            class="form-control form-control-sm" id="address_line2">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-sm-4 profile-social">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-twitter-square"></i>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="twitter"
                                                            value="{{ isset($userdetails->twitter) ? $userdetails->twitter : '' }}"
                                                            class="form-control form-control-sm" id="twitter">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-linkedin-square"></i>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="linkedin"
                                                            value="{{ isset($userdetails->linkedin) ? $userdetails->linkedin : '' }}"
                                                            class="form-control form-control-sm" id="inputEmail3">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-facebook-square"></i>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="facebook"
                                                            value="{{ isset($userdetails->facebook) ? $userdetails->facebook : '' }}"
                                                            class="form-control form-control-sm" id="facebook">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-skype"></i>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="skype"
                                                            value="{{ isset($userdetails->skype) ? $userdetails->skype : '' }}"
                                                            class="form-control form-control-sm" id="skype">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-instagram"></i>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="instagram"
                                                            value="{{ isset($userdetails->instagram) ? $userdetails->instagram : '' }}"
                                                            class="form-control form-control-sm" id="instagram">
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-sm-6">

                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="address_pincode"
                                                            class="col-form-label form-control-sm">Pincode:</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="address_pincode"
                                                            value="{{ isset($userdetails->address_pincode) ? $userdetails->address_pincode : '' }}"
                                                            class="form-control form-control-sm" id="address_pincode">

                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="
                                                        state_id"
                                                            class="col-form-label form-control-sm">State:
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <select name="state_id" id="state_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select State</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}" {{$userdetails->state_id == $state->id ? 'selected' : ''}}>
                                                                    {{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('state_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="city_id"
                                                            class="col-form-label form-control-sm">City:
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <select name="city_id" id="city_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select City</option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}" {{$userdetails->city_id == $city->id ? 'selected' : ''}}>
                                                                    {{ $city->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="country_id"
                                                            class="col-form-label form-control-sm">Country:
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <select name="country_id" id="country_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}" {{$userdetails->country_id == $country->id ? 'selected' : ''}}>
                                                                    {{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="phone"
                                                            class="col-form-label form-control-sm">Phone:</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="phone"
                                                            value="{{ isset($userdetails->phone) ? $userdetails->phone : '' }}"
                                                            class="form-control form-control-sm" id="phone">

                                                    </div>
                                                </div>

                                            </div>

                                            <input class="btn btn-danger save-profile" type="submit" name=""
                                                value="Save profile">

                                        </div>
                        </form>


                    </div>

                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="country_id"]').on('change', function() {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: "{{ url('/admin/state/ajax') }}/" + country_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="state_id"]').html('');
                        var d = $('select[name="state_id"]').empty();
                        $('select[name="state_id"]').append(
                                '<option value=""  selected="" disabled="">Select State</option>');
                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });



        $('select[name="state_id"]').on('change', function() {
            var state_id = $(this).val();
            if (state_id) {
                $.ajax({
                    url: "{{ url('/admin/city/ajax') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append(
                                '<option value=""  selected="" disabled="">Select City</option>');
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });


    });
</script>
@endsection
