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
                                        <h3 class="page-title">{{ $data['heading'] }} <span class="badge badge-pill badge-danger">
                                                {{ count($products) }}
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
                                                <th>Image </th>
                                                <th>Name </th>
                                                <th>Generic Name </th>
                                                <th>Pharmacy</th>
                                                <th>Price- MRP </th>
                                                <th>Stock </th>
                                                <th>Status </th>
                                                <th style="width:25%">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $item)
                                                <tr>
                                                    <td>
                                                        <img id="mainThmb"
                                                            src="{{ !empty($item->product_thumbnail) ? url('upload/product_images/' . $item->product_thumbnail) : url('upload/no_image.jpg') }}"
                                                            alt="" class="profile-img img-responsive center-block"
                                                            style="width: 60px; height: 50px;" ;>
                                                    </td>
                                                    <td>{{ $item->product_name_en }}</td>
                                                    <td>{{ $item->product_generic_name }}</td>
                                                    <td>
                                                        @if($item->product_pharmacy_id == 0)
                                                        Default Pharmacy
                                                        @else
                                                        {{ $item->PharmacyDetails->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->product_mrp }}</td>
                                                    <td>{{ $item->product_qty }}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-pill badge-success"> Active </span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger"> InActive </span>
                                                        @endif
                                                    </td>

                                                    <td>

                                                        {{-- <a href="{{ route('admin.product.delete',$item->id) }}" class="btn btn-danger btn-xs" title="Delete Data" id="delete"> --}}

                                                        {{-- <i class="fa fa-trash"></i> Delete</a> --}}
                                                        <form class="form-inline"
                                                            action="{{ route('admin.product.destroy', $item->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?');">
                                                            <a href="{{ route('admin.product.show', $item->id) }}"
                                                                class="btn btn-info btn-xs m-1" title="Edit Data"> View </a>
                                                            <a href="{{ route('admin.product.edit', $item->id) }}"
                                                                class="btn btn-warning btn-xs m-1" title="Edit Data"> Edit
                                                            </a>

                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
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




    @endsection
