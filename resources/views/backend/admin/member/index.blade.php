@extends('backend.admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">

                            <div class="d-flex align-items-center">
                                <div class="mr-auto">
                                    <h3 class="page-title">{{ $data['heading']}} List <span class="badge badge-pill badge-danger">
                                            {{ count($users) }}
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

                                            <th>Name </th>
                                            <th>Email </th>
                                            <th>Role</th>
                                            <th>Member Since</th>

                                            <th style="width:25%">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <!-- <td>
                                                <img id="mainThmb" src="{{ !empty($item->product_thumbnail) ? url('upload/product_images/' . $item->product_thumbnail) : url('upload/no_image.jpg') }}" }}" alt="" class="profile-img img-responsive center-block" style="width: 60px; height: 50px;" ;>
                                            </td> -->
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->Role->name }}</td>

                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <form class="form-inline"
                                                        action="{{ route('admin.member.destroy', $item->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                                        <a href="{{ route('admin.member.show', $item->id) }}"
                                                            class="btn btn-info btn-xs m-1" title="Edit Data"> View </a>
                                                        <a href="{{ route('admin.member.edit', $item->id) }}"
                                                            class="btn btn-warning btn-xs m-1" title="Edit Data"> Edit
                                                        </a>

                                                        @if($item->role_id == 2)
                                                        <a href="{{ route('admin.member.editaddress', $item->id) }}"
                                                            class="btn btn-warning btn-xs m-1" title="Edit Data"> Edit Address
                                                        </a>
                                                        @endif

                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit"
                                                            class="btn  btn-danger btn-xs float-right m-1"
                                                            value="Delete">
                                                    </form>
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

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>
@endsection
