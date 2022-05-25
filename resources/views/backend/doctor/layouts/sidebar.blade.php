
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     
   <div class="user-panel-1 mt-3 pb-3 mb-3 d-flex">
        <a  href="{{url('doctor/dashboard')}}" class="image">
            <img style="height:auto; max-width:40%;" class="text-center" src="https://www.compendiousmedworks.com/assets/img/logo/cmw-logo.png" alt="">
        </a>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('doctor.dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                My Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profile.index') }}" class="nav-link">
                  <i class="fas fa-user" aria-hidden="true"></i>&nbsp;
                  <p>My Profile</p>
                </a>
              </li>
            </ul>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('doctor.logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form-ad').submit();">
              &nbsp; <i class='fas fa-sign-out-alt' style='font-size:18px'></i> Log Out
                <form id="logout-form-ad" action="{{ route('doctor.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
          </li>
        </ul>
      </nav>

     
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

