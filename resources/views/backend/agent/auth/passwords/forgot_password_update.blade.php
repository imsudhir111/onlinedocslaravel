<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')

<body class="hold-transition sidebar-mini layout-fixed">
 
    
   
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="forgot_password_process_change"  action="{{ route('admin.password_update') }}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="service">New Password</label>
                                        <input type="text" name="password" class="form-control" id="password"
                                            placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="service">Confirm Password</label>
                                        <input type="text" name="password_confirmation" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password">
                                           
                                    </div>
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                               
                                     
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        <!-- /.content -->
    
  
  <!-- /.content-wrapper -->
  @yield('script')
</body>
</html>

