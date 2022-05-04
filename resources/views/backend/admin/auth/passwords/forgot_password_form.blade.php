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
                                <h3 class="card-title">Forgot Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="forgot_password_process_change"  action="{{ route('admin.reset_mail') }}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="service">Enter Email</label>
                                        <input type="text" name="forgot_password_email" class="form-control" id="forgot_password_email"
                                            placeholder="Service Name">
                                        @error('forgot_password_email')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        @if('message')
                                        {{session('message')}}
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                   
                                     
                                </div>
                                <!-- /.card-body -->
                                 
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

