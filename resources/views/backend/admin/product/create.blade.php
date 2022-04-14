@extends('backend.admin.layouts.app')

@section('content')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"> --}}


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
                    <form id="productForm" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row" id="user-profile">



                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="main-box clearfix">
                                    <div class="profile-header">

                                        {{-- @if ($errors->any())
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
                                    @endif --}}

                                </div>

                                <div class="row profile-user-info">
                                    <div class="row form-group row col-sm-12 "><span class="header nav-small-cap">Product Info</span><br>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_15" name="presc_required" value="1" {{old('presc_required') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_15">Prescription Required</label>
                                        @error('presc_required')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row col-sm-4">
                                    </div>

                                    <div class="form-group row col-sm-4">
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_name_en" class="col-sm-3 col-form-label form-control-sm">Product
                                            Name:</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" value="{{ old('product_name_en') }}" name="product_name_en" id="product_name_en" class="form-control" reqiured>
                                            @error('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_sku_code" class="col-sm-3 col-form-label form-control-sm">SKU
                                            Code:</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" value="{{ old('product_sku_code') }}" name="product_sku_code" id="product_sku_code" class="form-control" reqiured>
                                            @error('product_sku_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="products_type_id" class="col-sm-3 col-form-label form-control-sm">Product Type:</label>

                                        <div class="col-sm-9">
                                                <select name="products_type_id" id="products_type_id" class="form-control">
                                                    <option value="">Select Product Type</option>
                                                    @foreach ($product_type as $product_types)
                                                        <option value="{{ $product_types->id }}" {{old('products_type_id') == $product_types->id ? 'selected' : ''}}>
                                                            {{ $product_types->product_types_name_en }}</option>
                                                    @endforeach
                                                </select>
                                            @error('products_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row col-sm-4">
                                        <label for="brand_id"
                                            class="col-sm-3 col-form-label form-control-sm">Brand:
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="" selected="" disabled="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{old('brand_id') == $brand->id ? 'selected' : ''}}>
                                                        {{ $brand->brands_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="category_id"
                                            class="col-sm-3 col-form-label form-control-sm">Category:
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : ''}}>
                                                        {{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="subcategory_id"
                                            class="col-sm-3 col-form-label form-control-sm">SubCategory:</label>
                                        <div class="col-sm-9">
                                            <div class="controls">
                                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                    <option value="" selected="" disabled="">Select SubCategory
                                                    </option>

                                                </select>
                                                @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <label for="subsubcategory_id"
                                            class="col-sm-3 col-form-label form-control-sm">SubSubCategory
                                            :</label>
                                        <div class="col-sm-9">
                                            <select name="subsubcategory_id" id="subsubcategory_id" class="form-control">
                                                <option value="" selected="" disabled="">Select SubSubCategory
                                                </option>

                                            </select>
                                            @error('subsubcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_qty" class="col-sm-3 col-form-label form-control-sm">Stock:</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="0" step="1" value="{{ old('product_qty') }}" name="product_qty" id="product_qty" class="form-control">
                                            @error('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_weight" class="col-sm-3 col-form-label form-control-sm">Weight:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_weight') }}" name="product_weight" id="product_weight" class="form-control">
                                            @error('product_weight')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="short_descp_en" class="col-sm-3 col-form-label form-control-sm">Short Description:</label>
                                        <div class="col-sm-9">
                                            <textarea name="short_descp_en" id="short_descp_en" class="form-control" placeholder="Enter Details">{{ old('short_descp_en') }}</textarea>
                                            @error('short_descp_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">

                                        <label for="stars" class="col-sm-3 col-form-label form-control-sm">Stars:</label>

                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('stars') }}" name="stars" id="stars" class="form-control">
                                            @error('stars')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="form-group row col-sm-4">
                                        <label for="product_pharmacy_id" class="col-sm-3 col-form-label form-control-sm">Pharmacy:</label>

                                        <div class="col-sm-9">

                                                <select name="product_pharmacy_id" id="product_pharmacy_id" class="form-control">
                                                    <option value="">Select Pharmacy</option>
                                                    @foreach ($pharmacies as $pharmacy)
                                                        <option value="{{ $pharmacy->id }}" {{old('product_pharmacy_id') == $pharmacy->id ? 'selected' : ''}}>
                                                            {{ $pharmacy->name }}</option>
                                                    @endforeach
                                                </select>

                                            @error('product_pharmacy_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_generic_name" class="col-sm-3 col-form-label form-control-sm">Generic Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_generic_name') }}" name="product_generic_name" id="product_generic_name" class="form-control">
                                            @error('product_generic_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_code" class="col-sm-3 col-form-label form-control-sm">Code:
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_code') }}" name="product_code" id="product_code" class="form-control">
                                            @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row col-sm-4">
                                        <label for="product_short_stock" class="col-sm-3 col-form-label form-control-sm">Short Stock:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_short_stock') }}" name="product_short_stock" id="product_short_stock" class="form-control">
                                            @error('product_short_stock')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <label for="product_strength" class="col-sm-3 col-form-label form-control-sm">Strength:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_strength') }}" name="product_strength" id="product_strength" class="form-control">
                                            @error('product_strength')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row col-sm-4">
                                        <label for="product_batch_no" class="col-sm-3 col-form-label form-control-sm">Batch No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_batch_no') }}" name="product_batch_no" id="product_batch_no" class="form-control">
                                            @error('product_batch_no')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_box_size" class="col-sm-3 col-form-label form-control-sm">Box
                                                Size:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_box_size') }}" name="product_box_size" id="product_box_size" class="form-control">
                                            @error('product_box_size')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- new field starts --}}
                                    <div class="form-group row col-sm-4">
                                        <label for="manufature_name" class="col-sm-3 col-form-label form-control-sm">Manufacturer Name:</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" value="{{ old('manufature_name') }}" name="manufature_name" id="manufature_name" class="form-control" >
                                            @error('manufature_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- new field ends --}}

                                    <div class="form-group row col-sm-4">
                                        <label for="product_manuf_date" class="col-sm-3 col-form-label form-control-sm">Manufacture Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" value="{{ old('product_manuf_date') }}" name="product_manuf_date" id="product_manuf_date" class="form-control date">
                                            @error('product_manuf_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <label for="product_expiry_date" class="col-sm-3 col-form-label form-control-sm">Expiry Date:</label>
                                        <div class="col-sm-9">
                                            <input type="date" value="{{ old('product_expiry_date') }}" name="product_expiry_date" id="product_expiry_date" class="form-control date">
                                            @error('product_expiry_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_box_price" class="col-sm-3 col-form-label form-control-sm">Box Price:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_box_price') }}" name="product_box_price" id="product_box_price" class="form-control">
                                            @error('product_box_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <label for="selling_price" class="col-sm-3 col-form-label form-control-sm">Selling Price:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('selling_price') }}" id="selling_price" name="selling_price" class="form-control" readonly>
                                            @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_mrp" class="col-sm-3 col-form-label form-control-sm">MRP:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_mrp') }}" name="product_mrp" id="product_mrp" class="form-control">
                                            @error('product_mrp')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row col-sm-4">
                                        <label for="discount_price" class="col-sm-3 col-form-label form-control-sm">Discount Price:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('discount_price') }}" name="discount_price" id="discount_price" class="form-control">
                                            @error('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row col-sm-4">
                                        <label for="product_tags_en" class="col-sm-3 col-form-label form-control-sm" data-role="tagsinput">Tags:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('product_tags_en') }}" name="product_tags_en" id="product_tags_en" class="form-control">
                                            @error('product_tags_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <label for="product_side_effect" class="col-sm-3 col-form-label form-control-sm">Side Effect:</label>
                                        <div class="col-sm-9">
                                            <textarea name="product_side_effect" id="product_side_effect" class="form-control" placeholder="Enter Details">{{ old('product_side_effect') }}</textarea>
                                            {{-- <input type="text" value="{{ old('product_side_effect') }}" name="product_side_effect" class="form-control"> --}}
                                            @error('product_side_effect')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_4" name="status" value="1" {{old('status') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_4">Status:</label>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_1" name="show_frontend" value="1" {{old('show_frontend') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_1">Show on Website:</label>
                                        @error('show_frontend')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_2" name="new_arrival" value="1" {{old('new_arrival') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_2">New Arrival:</label>
                                        @error('new_arrival')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                      {{-- new foelds Start--}}
                                      <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_5" name="special_deal" value="1" {{old('special_deal') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_5">Special Deal:</label>
                                        @error('special_deal')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_6" name="top_rated" value="1" {{old('top_rated') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_6">Top Rated:</label>
                                        @error('top_rated')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_7" name="best_selling" value="1" {{old('best_selling') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_7">Best Selling:</label>
                                        @error('best_selling')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_8" name="hot_new" value="1" {{old('hot_new') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_8">Hot New:</label>
                                        @error('hot_new')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_9" name="featured_deal" value="1" {{old('featured_deal') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_9">Featured Deal:</label>
                                        @error('featured_deal')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row col-sm-4">
                                        <input type="checkbox" id="checkbox_10" name="recommended_prod" value="1" {{old('recommended_prod') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox_10">Recommended:</label>
                                        @error('recommended_prod')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group row col-sm-12">
                                        <label for="editor1" class="col-sm-3 col-form-label form-control-sm">Long
                                                Description:</label>

                                        <div class="col-sm-9">
                                            <textarea name="long_descp_en" id="editor1" rows="10" cols="80" class="form-control"  placeholder="Enter Details">{{ old('long_descp_en') }}</textarea>
                                            @error('long_descp_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-12">
                                        <label for="editor2" class="col-sm-3 col-form-label form-control-sm">
                                            Ingredients:</label>

                                        <div class="col-sm-9">
                                            <textarea name="product_salt" id="editor2" rows="10" cols="80" class="form-control"  placeholder="Enter Ingredient Salt">{{ old('product_salt') }}</textarea>
                                            @error('product_salt')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row col-sm-12">
                                        <label for="editor3" class="col-sm-3 col-form-label form-control-sm">
                                            Instructions:</label>

                                        <div class="col-sm-9">
                                            <textarea name="instructions" id="editor3" rows="10" cols="80" class="form-control"  placeholder="Enter Instructions">{{ old('instructions') }}</textarea>
                                            @error('instructions')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-4 col-sm-4">
                                        <div class="main-box clearfix">
                                            <img id="showImage" src="" alt="" class="profile-img img-responsive center-block" style="width: 100%" ;>
                                            <div class="form-group col-sm-4">
                                                <h5>Main Thumbnail: <span class="text-danger"></span></h5>

                                                <div class="controls">
                                                    <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumUrl(this)">
                                                    @error('product_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                                <small>Recommended size 400 * 400 px, size 1MB. Only accepts jpg, jpeg, webp image format.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="main-box clearfix">
                                            <img id="showImageOne" src="" alt="" class="profile-img img-responsive center-block" style="width: 100%" ;>
                                            <div class="form-group col-sm-12">
                                                <h5>Slider Thumbnail One: <span class="text-danger"></span></h5>

                                                <div class="controls">
                                                    <input type="file" name="slider_thumbnail_one" class="form-control" onChange="sliderThumOneUrl(this)">
                                                    @error('slider_thumbnail_one')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="sliderThmbOne">
                                                </div>
                                                <small>Recommended size 400 * 400 px, size 1MB. Only accepts jpg, jpeg, webp image format.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="main-box clearfix">
                                            <img id="showImageTwo" src="" alt="" class="profile-img img-responsive center-block" style="width: 100%" ;>
                                            <div class="form-group col-sm-12">
                                                <h5>Slider Thumbnail Two: <span class="text-danger"></span></h5>

                                                <div class="controls">
                                                    <input type="file" name="slider_thumbnail_two" class="form-control" onChange="sliderThumTwoUrl(this)">
                                                    @error('slider_thumbnail_two')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="sliderThmbTwo">
                                                </div>
                                                <small>Recommended size 400 * 400 px, size 1MB. Only accepts jpg, jpeg, webp image format.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="main-box clearfix">
                                            <img id="showImageThree" src="" alt="" class="profile-img img-responsive center-block" style="width: 100%" ;>
                                            <div class="form-group col-sm-12">
                                                <h5>Slider Thumbnail Three: <span class="text-danger"></span></h5>

                                                <div class="controls">
                                                    <input type="file" name="slider_thumbnail_three" class="form-control" onChange="sliderThumThreeUrl(this)">
                                                    @error('slider_thumbnail_three')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="sliderThmbThree">
                                                </div>
                                                <small>Recommended size 400 * 400 px, size 1MB. Only accepts jpg, jpeg, webp image format.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <input class="btn btn-danger save-profile" type="submit" name="" value="Save Product">
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
{{-- <script src="{{ asset('/backend/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    // $('.date').datepicker({
    //     dateFormat: 'mm-dd-yy'
    // });
    $(document).ready(function () {
        $('.date').datepicker({ dateFormat: 'mm-dd-yy' });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#discount_price').on('keyup', function() {
            var selling_price = 0;
            var product_mrp = $('#product_mrp').val();
            var discount_price = $('#discount_price').val();

            $("#discount_price").attr("max", product_mrp);

            selling_price = (product_mrp - discount_price);
            $('#selling_price').val(selling_price);
        });

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
        dd = '0' + dd
        }
        if (mm < 10) {
        mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;

        //console.log(today,dd,mm,yyyy);
        $("#product_manuf_date").attr("max", today);
        $("#product_expiry_date").attr("min", today);

        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/admin/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });



        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/admin/subsubcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subsubcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });


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

    function sliderThumOneUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#sliderThmbOne').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function sliderThumTwoUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#sliderThmbTwo').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    function sliderThumThreeUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#sliderThmbThree').attr('src', e.target.result).width(80).height(80);
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
