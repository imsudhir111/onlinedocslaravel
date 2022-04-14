
@extends('backend.admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Product</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Product</li>
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

                <div class="box box-inverse bg-img" style="background-image: url(../images/gallery/full/1.jpg);" data-overlay="2">
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


                        <img id="showImage" src="{{ (!empty($product->product_thumbnail))? url('upload/product_images/'.$product->product_thumbnail):url('upload/no_image.jpg') }}"  alt=""                    class="profile-img img-responsive center-block" style="width: 50%" ;>
                      </a>

                      </div>

                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-outline btn-rounded btn-secondary mb-5  ">
                            <i class="fa fa-pencil-square fa-lg"></i> Edit Product
                        </a>

                  </div>

                <!-- Profile Image -->
            </div>
            <div class="col-12 col-lg-7 col-xl-8">
                <div class="box">
                    <div class="box-body box-profile">
                      <div class="row">
                        <div class="col-6">
                            <div>
                                <p class="text-gray pl-10 m-5" >Name : <span class="text-gray pl-10 ml-5">{{ $product->product_name_en}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Category : <span class="text-gray pl-10">{{ $product->category->category_name_en}}</span></p>
                                <p  class="text-gray pl-10 m-5" >Type : <span class="text-gray pl-10">
                                    @if(!empty($product->ProductType->product_types_name_en))
                                    {{ $product->ProductType->product_types_name_en }}
                                    @endif
                                </span></p>
                                <p  class="text-gray pl-10 m-5" >Brand : <span class="text-gray pl-10">
                                    @if(!empty($product->Brand->brands_name_en))
                                    {{ $product->Brand->brands_name_en }}
                                    @endif
                                </span></p>
                                <p  class="text-gray pl-10 m-5" >Pharmacy : <span class="text-gray pl-10">
                                @if($product->product_pharmacy_id == 0 )
                                Default Pharmacy
                                @else
                                {{ $product->PharmacyDetails->name}}
                                @endif
                                </span></p>
                                <p  class="text-gray pl-10 m-5" >Generic Name :<span class="text-gray pl-10">{{ $product->product_generic_name}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Code : <span class="text-gray pl-10">{{ $product->product_code}}</span> </p>
                                <!-- <p  class="text-gray pl-10 m-5" >Category : <span class="text-gray pl-10">{{ $product->category_id}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Sub Category : <span class="text-gray pl-10">{{ $product->subcategory_id}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Sub Sub Category : <span class="text-gray pl-10">{{ $product->subsubcategory_id}}</span> </p> -->
                                <p  class="text-gray pl-10 m-5" >Strength : <span class="text-gray pl-10">{{ $product->product_strength}}</span> </p>

                                <p  class="text-gray pl-10 m-5" >Batch No : <span class="text-gray pl-10 m-5 ">{{ $product->product_batch_no}}</span> </p>

                                <p  class="text-gray pl-10 m-5" >Manufacture Date : <span class="text-gray pl-10">{{ $product->product_manuf_date}}</span></p>
                                <p class="text-gray pl-10 m-5" >Expiry Date : <span class="text-gray pl-10"></span>{{ $product->product_expiry_date}}</p>

                                <p class="text-gray pl-10 m-5" >Status : <span class="text-gray pl-10"></span> @if ($product->status == 1)
                                    <span class="badge badge-pill badge-success"> Active </span>
                                @else
                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                @endif</p>

                                <p class="text-gray pl-10 m-5" >Show in Frontend : <span class="text-gray pl-10"></span> @if ($product->show_frontend == 1)
                                    <span class="badge badge-pill badge-success"> Yes </span>
                                @else
                                    <span class="badge badge-pill badge-danger"> No </span>
                                @endif</p>

                                <p class="text-gray pl-10 m-5" >New Arrival : <span class="text-gray pl-10"></span> @if ($product->new_arrival == 1)
                                    <span class="badge badge-pill badge-success"> Yes </span>
                                @else
                                    <span class="badge badge-pill badge-danger"> No </span>
                                @endif</p>

                                <p class="text-gray pl-10 m-5" >Prescription Required : <span class="text-gray pl-10"></span>
                                    @if ($product->prescription_required == 1)
                                        <span class="badge badge-pill badge-success"> Yes </span>
                                    @else
                                        <span class="badge badge-pill badge-danger"> No </span>
                                    @endif
                                </p>

                                <p class="text-gray pl-10 m-5" >SKU Code :
                                {{ $product->product_sku_code }}
                                </p>
                                <p class="text-gray pl-10 m-5" >Bar Code :
                                    <br>
                                {!! $product->barcode !!}
                                </p>

                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-gray pl-10 m-5" >MRP :<span class="text-gray pl-10 ml-5">${{ $product->product_mrp}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Selling Price :<span class="text-gray pl-10">${{ $product->selling_price}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Discount Price :<span class="text-gray pl-10">${{ $product->product_box_price}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Box Price :<span class="text-gray pl-10">${{ $product->discount_price}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Quantity :<span class="text-gray pl-10">{{ $product->product_qty}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Short Stock :<span class="text-gray pl-10">{{ $product->product_short_stock}}</span> </p>
                                <!-- <p  class="text-gray pl-10 m-5" >Show On Frontend :<span class="text-gray pl-10">{{ $product->show_frontend}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Status :<span class="text-gray pl-10">{{ $product->status}}</span> </p> -->
                                <p  class="text-gray pl-10 m-5" >Short Description :<span class="text-gray pl-10">{{ $product->short_descp_en}}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Long Description :<span class="text-gray pl-10">{!! $product->long_descp_en !!}</span> </p>
                                <p  class="text-gray pl-10 m-5" >Side Effect :<span class="text-gray pl-10">{{ $product->product_side_effect}}</span> </p>
                            </div>
                        </div>

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
