<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-icon-hover" href="javascript:void(0)">
          <i class="ti ti-bell-ringing"></i>
          <div class="notification bg-primary rounded-circle"></div>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="d-flex align-items-center">
              <!-- Avatar User -->
              @php
                  $user = Auth::user();
                  $avatarUrl = $user->avatar_url ?? 'https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF';
                  $userName = $user->name ?? 'User';
                  $userRole = $user->role ?? 'guest';
                  $roleDisplay = $user->role_display ?? 'Guest';
              @endphp
              <img src="{{ $avatarUrl }}" 
                   alt="{{ $userName }}" 
                   width="35" 
                   height="35" 
                   class="rounded-circle border border-white">
              <!-- Nama User -->
              <span class="ms-2 text-dark fw-medium d-none d-md-inline">
                {{ $userName }}
              </span>

              <span class="badge bg-{{ $userRole == 'admin' ? 'danger' : 'info' }} ms-2 d-none d-md-inline">
                {{ $roleDisplay }}
              </span>

            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up user-dropdown"
              aria-labelledby="drop2">
          <div class="message-body">
              <!-- Info User -->
              <div class="px-3 py-2 mb-2 border-bottom">
                <p class="mb-0 fw-bold">{{ $userName }}</p>
                <small class="text-muted">{{ $user->email ?? 'No email' }}</small>
                <div class="mt-1">
                  <span class="badge bg-{{ $userRole == 'admin' ? 'danger' : 'info' }}">
                    {{ $roleDisplay }}
                  </span>
                </div>
              </div>
              
              <!-- Menu Items -->
              <a href="{{ route('profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0">My Profile</p>
              </a>
              
              <!-- Logout Form -->
              <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                @csrf
                <button type="submit" class="btn btn-outline-primary w-100 mt-2 d-block">
                  <i class="ti ti-logout"></i> Logout
                </button>
              </form>
            </div>
          </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endauth
      </ul>
    </div>
  </nav>
</header>