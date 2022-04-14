@extends('backend.admin.layouts.app')

@section('content')

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
                                    <li class="breadcrumb-item active" aria-current="page">View</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-12 col-lg-5 col-xl-4">

                        <div class="box box-inverse bg-img" style="background-image: url(../images/gallery/full/1.jpg);"
                            data-overlay="2">
                            <div class="flexbox px-20 pt-20">
                                {{-- <label class="toggler toggler-danger text-white">
                        <input type="checkbox">
                        <i class="fa fa-heart"></i>
                      </label>
                      <div class="dropdown">
                        <a data-toggle="dropdown" href="#"><i class="ti-more-alt rotate-90 text-white"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                          <a class="dropdown-item" href="#"><i class="fa fa-picture-o"></i> Shots</a>
                          <a class="dropdown-item" href="#"><i class="ti-check"></i> Follow</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fa fa-ban"></i> Block</a>
                        </div>
                      </div> --}}
                            </div>

                            <div class="box-body text-center pb-50">
                                <a href="#">

                                    @if($user->role_id == 1)
                                    <img id="showImage"
                                        src="{{ !empty($userdetails->image_path) ? url('upload/admin_images/' . $userdetails->image_path) : url('upload/admin_images/no_image.jpg') }}"
                                         alt="" class="profile-img img-responsive center-block" style="width: 50%" ;>
                                    @elseif($user->role_id == 2)
                                    <img id="showImage"
                                    src="{{ (!empty($userdetails->image_path))? url('upload/pharmacy_images/'.$userdetails->image_path):url('upload/pharmacy_images/no_image.jpg') }}"
                                    alt="" class="profile-img img-responsive center-block" style="width: 50%" ;>
                                    @elseif($user->role_id == 3)
                                    <img id="showImage"
                                    src="{{ (!empty($userdetails->image_path))? url('upload/customer_images/'.$userdetails->image_path):url('upload/customer_images/no_image.jpg') }}"
                                    alt="" class="profile-img img-responsive center-block" style="width: 50%" ;>
                                    @elseif($user->role_id == 4)
                                    <img id="showImage"
                                    src="{{ (!empty($userdetails->image_path))? url('upload/courier_images/'.$userdetails->image_path):url('upload/courier_images/no_image.jpg') }}"
                                    alt="" class="profile-img img-responsive center-block" style="width: 50%" ;>
                                    @elseif($user->role_id == 5)
                                    <img id="showImage"
                                    src="{{ (!empty($userdetails->image_path))? url('upload/support_images/'.$userdetails->image_path):url('upload/support_images/no_image.jpg') }}"
                                    alt="" class="profile-img img-responsive center-block" style="width: 50%" ;>
                                    @elseif($user->role_id == 6)
                                    <img id="showImage"
                                        src="{{ !empty($userdetails->image_path) ? url('upload/admin_images/' . $userdetails->image_path) : url('upload/admin_images/no_image.jpg') }}"
                                         alt="" class="profile-img img-responsive center-block" style="width: 50%" ;>
                                    @endif
                                </a>

                                <h4 class="mt-2 mb-0"><a class="hover-primary text-white"
                                        href="#">{{ $user->name }}</a></h4>

                            </div>

                            @if($user->role_id == 1)
                            <a href="{{ route('admin.member.edit', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Profile
                            </a>
                            @elseif($user->role_id == 2)
                            <a href="{{ route('admin.member.edit', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Profile
                            </a>
                            <a href="{{ route('admin.member.editaddress', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Address
                            </a>
                            @elseif($user->role_id == 3)
                            <a href="{{ route('admin.member.edit', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Profile
                            </a>
                            @elseif($user->role_id == 4)
                            <a href="{{ route('admin.member.edit', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Profile
                            </a>
                            @elseif($user->role_id == 5)
                            <a href="{{ route('admin.member.edit', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Profile
                            </a>
                            @elseif($user->role_id == 6)
                            <a href="{{ route('admin.member.edit', $user->id) }}"
                                class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                                <i class="fa fa-pencil-square fa-lg"></i> Edit Profile
                            </a>
                            @endif
                        </div>

                        <!-- Profile Image -->
                    </div>
                    <div class="col-12 col-lg-7 col-xl-8">
                        <div class="box">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-12">
                                        <div>
                                            <p>Email :<span
                                                    class="text-gray pl-10">{{ !empty($user->email) ? $user->email : '' }}</span>
                                            </p>
                                            <p>Phone :<span
                                                    class="text-gray pl-10">{{ !empty($userdetails->phone) ? $userdetails->phone : '' }}</span>
                                            </p>


                                            <p>
                                                Country :<span class="text-gray pl-10">
                                                @if($user->role_id == 3)
                                                {{ !empty($userdetails->address_country) ? $userdetails->address_country : '' }}
                                                @else
                                                {{ !empty($userdetails->country->name) ? $userdetails->country->name : '' }}
                                                @endif
                                                </span>
                                            </p>

                                            <p>
                                                State :<span class="text-gray pl-10">
                                                @if($user->role_id == 3)
                                                {{ !empty($userdetails->address_state) ? $userdetails->address_state : '' }}
                                                @else
                                                {{ !empty($userdetails->state->name) ? $userdetails->state->name : '' }}
                                                @endif
                                                </span>
                                            </p>

                                            <p>
                                                City :<span class="text-gray pl-10">
                                                @if($user->role_id == 3)
                                                {{ !empty($userdetails->address_city) ? $userdetails->address_city : '' }}
                                                @else
                                                {{ !empty($userdetails->city->name) ? $userdetails->city->name : '' }}
                                                @endif
                                                </span>
                                            </p>

                                            <p>Address :<span
                                                    class="text-gray pl-10">
                                                    {{ !empty($userdetails->address_line1) ? $userdetails->address_line1 : '' }},
                                                    {{ !empty($userdetails->address_city) ? $userdetails->address_city : '' }},
                                                    {{ !empty($userdetails->address_state) ? $userdetails->address_state : '' }},
                                                    {{ !empty($userdetails->address_country) ? $userdetails->address_country : '' }},

                                                </span>
                                            </p>
                                            @if($user->role_id == 4)
                                            <p>
                                                Wallet Amount :<span class="text-gray pl-10">
                                                ${{ !empty($userdetails->wallet_amount) ? $userdetails->wallet_amount : '' }}
                                                </span>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="pb-15">
                                            <p class="mb-10">Social Profile</p>
                                            <div class="user-social-acount">
                                                <a href="  {{ !empty($userdetails->facebook) ? $userdetails->facebook : '' }}" class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>

                                                <a href="  {{ !empty($userdetails->twitter) ? $userdetails->twitter : '' }}" class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>

                                                <a href="  {{ !empty($userdetails->instagram) ? $userdetails->instagram : '' }}" class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>

                                                <a href="  {{ !empty($userdetails->skype) ? $userdetails->skype : '' }}" class="btn btn-circle btn-social-icon btn-skype"><i class="fa fa-skype"></i></a>

                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
    </div>

@endsection
