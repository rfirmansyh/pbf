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
				<li class="{{ Request::is('dashboard/admin') ? 'active' : '' }}">
					<a href="{{ route('dashboard.admin.index') }}" class="nav-link">
						<i class="fas fa-compass tx-16"></i><span>Dashboard</span>
					</a>
				</li>
				<li class="{{ Request::is('dashboard/admin/profile*') ? 'active' : '' }}">
					<a href="{{ route('dashboard.admin.profile.index') }}" class="nav-link">
						<i class="fas fa-user"></i><span>Profile</span>
					</a>
				</li>
					
				<li class="menu-header">Menu</li>
				<li class="{{ Request::is('dashboard/admin/peminjamans*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.admin.peminjamans.index') }}">
						<i class="fas fa-newspaper"></i> <span>Peminjaman</span>
					</a>
				</li>
				<li class="{{ Request::is('dashboard/admin/pengembalians*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.admin.pengembalians.index') }}">
						<i class="fas fa-shopping-basket"></i> <span>Pengembalian</span>
					</a>
				</li>
				<li class="{{ Request::is('dashboard/admin/users*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.admin.users.index') }}">
						<i class="fas fa-users"></i> <span>Data Anggota</span>
					</a>
				</li>

				<li class="menu-header">Explore</li>
				<li class="{{ Request::is('dashboard/admin/books*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.admin.books.index') }}"><i class="fas fa-book"></i> <span>Daftar Buku</span></a>
				</li>
				<li class="{{ Request::is('dashboard/admin/raks*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.admin.raks.index') }}"><i class="fas fa-th-list"></i> <span>Daftar Rak</span></a>
				</li>
			@else
				<li class="menu-header">Dashboard</li>
				<li class="{{ Request::is('dashboard/member') ? 'active' : '' }}">
					<a href="{{ route('dashboard.member.index') }}" class="nav-link">
						<i class="fas fa-compass tx-16"></i><span>Dashboard</span>
					</a>
				</li>
				<li class="{{ Request::is('dashboard/member/profile*') ? 'active' : '' }}">
					<a href="{{ route('dashboard.member.profile.index') }}" class="nav-link">
						<i class="fas fa-user"></i><span>Profile</span>
					</a>
				</li>

				<li class="menu-header">Menu</li>
				<li class="{{ Request::is('dashboard/member/peminjamans*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.member.peminjamans.index') }}">
						<i class="fas fa-newspaper"></i> <span>Peminjaman Saya</span>
					</a>
				</li>

				<li class="menu-header">Explore</li>
				<li class="{{ Request::is('dashboard/member/books*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard.member.books.index') }}"><i class="fas fa-book"></i> <span>Daftar Buku</span></a>
				</li>
			@endif

      </ul>

    </aside>
</div>