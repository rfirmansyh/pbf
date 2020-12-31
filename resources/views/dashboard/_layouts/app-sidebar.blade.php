<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Perpus ID</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">P.<br>ID</a>
      </div>

      <ul class="sidebar-menu">
        
        @if (Request::is('dashboard/admin*'))
          <li class="menu-header">Dashboard</li>
			<li class="{{ Request::is('dashboard/'.Auth::user()->role->slug) ? 'active' : '' }}">
				<a href="{{ route('dashboard.'.Auth::user()->role->slug.'.index') }}" class="nav-link">
					<i class="fas fa-compass tx-16"></i><span>Dashboard</span>
				</a>
			</li>
          	<li class="{{ Request::is('dashboard/'.Auth::user()->role->slug.'/profile*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.'.Auth::user()->role->slug.'.profile.index') }}" class="nav-link">
					<i class="fas fa-user"></i><span>Profile</span>
				</a>
			</li>
			  
			<li class="menu-header">Menu</li>
			<li class="{{ Request::is('dashboard/'.Auth::user()->role->slug.'/peminjamans*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('dashboard.'.Auth::user()->role->slug.'.peminjamans.index') }}">
					<i class="fas fa-newspaper"></i> <span>Peminjaman</span>
				</a>
			</li>
			<li class="{{ Request::is('dashboard/'.Auth::user()->role->slug.'/pengembalians*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('dashboard.'.Auth::user()->role->slug.'.pengembalians.index') }}">
					<i class="fas fa-shopping-basket"></i> <span>Pengembalian</span>
				</a>
			</li>
			<li class="{{ Request::is('dashboard/'.Auth::user()->role->slug.'/users*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('dashboard.'.Auth::user()->role->slug.'.users.index') }}">
					<i class="fas fa-users"></i> <span>Data Anggota</span>
				</a>
			</li>

          <li class="menu-header">Explore</li>
          <li class="{{ Request::is('dashboard/'.Auth::user()->role->slug.'/books*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.'.Auth::user()->role->slug.'.books.index') }}"><i class="fas fa-book"></i> <span>Daftar Buku</span></a>
          </li>
          <li class="{{ Request::is('dashboard/'.Auth::user()->role->slug.'/raks*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.'.Auth::user()->role->slug.'.raks.index') }}"><i class="fas fa-th-list"></i> <span>Daftar Rak</span></a>
          </li>
        @else
            
        @endif

      </ul>

    </aside>
</div>