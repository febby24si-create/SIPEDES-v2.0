<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-center">
      <a href="{{ url('/') }}" class="text-nowrap logo-img" style="text-decoration: none;">
        <h3 style="font-weight: 800; color: #2A3547; letter-spacing: 2px; margin: 0; text-transform: uppercase;">
          SIPEDES
        </h3>
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
          <span class="hide-menu">HOME</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
          <span class="hide-menu">SISTEM</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.perangkat_desa.index') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:users-group-rounded-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Perangkat Desa</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.lembaga.index') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:buildings-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Lembaga Desa</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.rw.index') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:map-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Data RW</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.rt.index') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:map-point-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Data RT</span>
          </a>
        </li>

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
          <span class="hide-menu">MASTER DATA</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.user.index') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:users-group-rounded-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Manajemen User</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.warga.index') }}" aria-expanded="false">
            <span>
              <iconify-icon icon="solar:user-rounded-bold-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Data Warga</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>