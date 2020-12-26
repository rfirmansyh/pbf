<nav class="navbar navbar-expand-lg main-navbar justify-content-between">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center">
            <div class="d-inline-block mr-3" style="width: 30px; height: 30px; overflow: hidden; border-radius: 50%">
                <img alt=" " src="{{ asset('img/users/2.jpg') }}" style="width: 100%; height: 100%; object-fit: cover">
            </div>
            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
            <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Logged in 5 min ago</div>
            <a href="features-profile.html" class="dropdown-item has-icon">
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