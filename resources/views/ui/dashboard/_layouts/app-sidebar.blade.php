<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">ABJA</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">AB<br>JA</a>
      </div>

      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        {{-- acitve --}}
        <li class="{{ Request::is('ui/dashboard/mitra') ? 'active' : '' }}">
          <a href="#" class="nav-link"><i class="fas fa-compass tx-16"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Budidaya</li>
        <li class="{{ Request::is('ui/dashboard/mitra/budidaya*') ? 'active' : '' }}">
          <a class="nav-link" href="blank.html"><i class="fas fa-map"></i> <span>Tempat Budidaya</span></a>
        </li>

        @if (Request::is('ui/dashboard/admin*'))
			<li class="menu-header">Membership</li>
			<li class=""><a class="nav-link" href="blank.html"><i class="fas fa-users-cog"></i> <span>Mitra</span></a></li>
			<li class=""><a class="nav-link" href="blank.html"><i class="fas fa-users"></i> <span>Administrator</span></a></li>
        @elseif (Request::is('ui/dashboard/mitra*'))
			<li class="menu-header">Internal</li>
			<li class=""><a class="nav-link" href="blank.html"><i class="fas fa-cogs"></i> <span>Produksi</span></a></li>
			<li class=""><a class="nav-link" href="blank.html"><i class="fas fa-users"></i> <span>Pekerja</span></a></li>
			<li class=""><a class="nav-link" href="blank.html"><i class="fas fa-money-bill-wave-alt"></i> <span>Keuangan</span></a></li>            
        @endif

        <li class="menu-header">Explore</li>
        <li class=""><a class="nav-link" href="blank.html"><i class="fas fa-newspaper"></i> <span>Berita Jamur</span></a></li>
        <li class=""><a class="nav-link" href="blank.html"><i class="fas fa-chart-bar"></i> <span>Harga Jamur</span></a></li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block">
          <i class="fas fa-question-circle"></i> Bantuan
        </a>
      </div>
    </aside>
</div>