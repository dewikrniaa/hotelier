<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-2">
                HOTELIER
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Beranda -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-view-dashboard"></i>
                <div>Beranda</div>
            </a>
        </li>

        <!-- Informasi Kamar -->
        <li class="menu-item {{ request()->routeIs('kamar.*') ? 'active' : '' }}">
            <a href="{{ route('kamar.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-variant"></i>
                <div>Informasi Kamar</div>
            </a>
        </li>

        <!-- Check In -->
        <li class="menu-item {{ request()->routeIs('checkin.*') ? 'active' : '' }}">
            <a href="{{ route('checkin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-clock-in"></i>
                <div>Check In</div>
            </a>
        </li>

        <!-- Laporan -->
        <li class="menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <a href="{{ route('laporan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div>Laporan</div>
            </a>
        </li>

        <!-- Pelanggan -->
        <li class="menu-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
            <a href="{{ route('pelanggan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account"></i>
                <div>Pelanggan</div>
            </a>
        </li>

    </ul>
</aside>