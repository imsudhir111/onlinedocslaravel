<nav class="navbar">
  <ul class="nav navbar-nav">
      <li class="nav-item active" >
          <a class="nav-link"  href="{{url('doctor/dashboard')}}"> Home </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{url('doctor/myappointment')}}"> My Appointments </a>
      </li>
      <li class="nav-item all-appoint">
          <a class="nav-link" href="{{url('doctor/all-appointment')}}"> All Appointments </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('doctor/zoom-meeting-setting')}}">Zoom Meeting Setting</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{url('doctor/change-password')}}"> Change Password  </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('doctor.logout') }}"> Log out </a>
      </li>
  </ul>
</nav>