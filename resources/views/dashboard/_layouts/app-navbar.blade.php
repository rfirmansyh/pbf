<nav class="navbar navbar-expand-lg main-navbar justify-content-between">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center">
            <div class="d-inline-block mr-3" style="width: 30px; height: 30px; overflow: hidden; border-radius: 50%">
                @if (\Auth::user()->email === 'admintest@gmail.com')
                    <img src="{{ asset('img/users/imam.png') }}" alt=" " style="width: 100%; height: 100%; object-fit: cover">
                @else
                    @if (\Auth::user()->photo)
                        <img src="{{ asset('storage/'.\Auth::user()->photo) }}" alt=" " style="width: 100%; height: 100%; object-fit: cover">
                    @else
                        <img src="{{ asset('img/users/default.png') }}" alt=" " style="width: 100%; height: 100%; object-fit: cover">
                    @endif
                @endif
            </div>
            <div class="d-sm-none d-lg-inline-block">Hi, {{ \Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Opsi</div>
            
            <a href="{{ route('dashboard.'.\Auth::user()->role->slug.'.profile.index') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Lihat Profile
            </a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item has-icon text-danger d-flex align-items-center">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
            </div>
        </li>
    </ul>
</nav>