@extends('backend.admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{$media_press_released_post_byid[0]->id}}Update Media/Press Release</h3>
                            </div>
                            <!-- /.card-header -->
             


                            <form role="form" id="bog_Form" action="{{ route('media-press-release.update',$media_press_released_post_byid[0]->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="name">Caption</label>
                                        <input type="text" name="caption" class="form-control" id="caption"
                                            placeholder="Media/Press Release caption" value="{{$media_press_released_post_byid[0]->caption}}">
                                        @error('caption')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" id="press_release_description" name="description" placeholder="Description" value=""> 
                                        {{$media_press_released_post_byid[0]->description}}
                                        
                                        </textarea>

                                        @error('description')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

                                 
                                    <div class="form-group">
                                        <label for="photo">Small Icon</label><br>
                                        <img id="preview_image_photo" class="profile-user-img img-fluid"  src="{{url('upload/press-media-release/image/'.$media_press_released_post_byid[0]->image)}}" style="margin:0 auto;" max-height="200" max-width="200"> 
                                        <input type="file" class="form-control p-1" id="image" 
                                        name="image"
                                        onchange="document.getElementById('preview_image_photo').src = window.URL.createObjectURL(this.files[0])"
                                        placeholder="Small Icon" onchange="readURL(this)">
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="row">
                                            @foreach ($media_press_list as $list)
                                                <div class="form-group col-3">
                                                        <label for="media press" class="">{{$list->name}}</label>
                                                        <input type="checkbox" value="{{$list->id}}" name="media_press[]"> 
                                                        <input type="text" class="form-control" value="" name="media_press_release_url[]">
                                                </div>
                                            @endforeach
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="created_by">Assign Media/Press</label>
                                            <button type="button" class="btn btn-primary btn-sm m-1" id="{{$media_press_released_post_byid[0]->id}}" onclick="filter_media_press_by_media_press_release_id(this)" 
                                        data-toggle="modal" data-target="#add_media_press" data-whatever="@fat">Add Media/Press</button>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_by">Created By</label>
                                       <select  class="form-control p-1" name="created_by" id="created_by">
                                       <option value="Admin">Admin</option>
                                    </select>
                                        @error('created_by')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                   
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                       <!-- add media press form start -->
                       <div class="card-body">
                       
                        <div class="modal fade" id="add_media_press" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <!-- <div class="modal-header">
                                <h4 class="modal-title">Change Password</h4>
                              </div> -->
                              <div class="card-header" style=" float:inherit !important;"="">
                                  <h3 class="card-title">Add <small>New Press/Media</small></h3>
                              </div>
                              <ul class="ul__ m-3" id="assigned_media_press_list"></ul>
                            <div class="modal-body">
                               
                                <form  id="assign_media_release_form" >
                                    @csrf
                                 
                                  <div class="form-group">
                                    <label for="p_address">Media/Press*</label>
                                    <select class="form-control" name="media_press" id="media_press_list">
                                    
                                    </select>
                                    
                                      @error('media_press')
                                    {{-- <span class="text-danger" role="alert"> --}}
                                        {{ $message }}
                                    {{-- </span> --}}
                                  @enderror
                                  </div>
                               
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Url</label>
                                  <input type="text" name="url" class="form-control" id="url" placeholder="Enter Url">
                                  @error('url')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                  @enderror
                              </div>
                                    <input type="hidden" name="media_press_release_id" id="media_press_release_id" value="">
                               </div>
                              <div class="modal-footer">
                              <button type="submit" id="" class="save_assigned_media_press btn btn-primary" onclicks="save_assigned_media_press(this)" >Save</button>
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                        
                            </div>
                            
                          </div>
                        </div>
                        </div>
                        <!-- end update contact form -->
                        
                                    </div>
                                    <!-- /.card -->
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                              </div>
                              <!-- /.container-fluid -->
                          </section>
                          <!-- /.content -->
                            <script>
                         
                          
                          </script>  
                      </div>

                    <!-- add media press modalform end -->
        <!-- /.content -->
    </div>
@endsection
@section('script')
@endsection
