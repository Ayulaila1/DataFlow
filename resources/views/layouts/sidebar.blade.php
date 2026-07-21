<aside class="left-sidebar">
    <div>
        <!-- Logo -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Logo">
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-6"></i>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear"
                        class="nav-small-cap-icon fs-4">
                    </iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>

                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}"
                        aria-expanded="false">

                        <i class="ti ti-atom"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- Riwayat Upload -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('history.*') ? 'active' : '' }}"
                        href="{{ route('history.index') }}"
                        aria-expanded="false">

                        <i class="ti ti-history"></i>
                        <span class="hide-menu">Riwayat Upload</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>