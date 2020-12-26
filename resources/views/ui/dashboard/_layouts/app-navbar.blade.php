<nav class="navbar navbar-expand-lg main-navbar justify-content-between">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('img/users/2.jpg') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, Jhon Doe</div></a>
            <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ url('ui/dashboard/member/profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            </div>
        </li>
    </ul>
</nav>