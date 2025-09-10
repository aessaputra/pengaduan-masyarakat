<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/admin/img/logo.png') }}" alt="Logo" style="max-height: 45px;">
        </div>
        <div class="sidebar-brand-text mx-2">KKM 18</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin/admins*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.admins.index') }}">
            <i class="fas fa-fw fa-user-shield"></i>
            <span>Data Admin</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ request()->is('admin/resident*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.resident.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Masyarakat</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin/report-category*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.report-category.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Kategori</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin/report') || request()->is('admin/report/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.report.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Laporan</span></a>
    </li>


</ul>
