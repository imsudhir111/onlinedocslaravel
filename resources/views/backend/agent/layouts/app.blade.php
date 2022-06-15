<!DOCTYPE html>
<html lang="en">
    @include('backend.agent.layouts.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('/backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  @include('backend.agent.layouts.header_menu')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.agent.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  <!-- /.content-wrapper -->
  @include('backend.agent.layouts.footer')
  @yield('script')
</body>
</html>

