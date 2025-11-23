


<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <style>
        .sidebar-brand {
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 1.5rem 0 1rem 0;
        }
        .sidebar-brand .brand-link {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
        }
    .sidebar-menu {
      list-style: none;
      padding-left: 0;
      margin: 0;
    }
    .sidebar-menu .nav-link {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
      padding: 0.5rem 1rem;
      color: #e0e0e0;
      background: transparent;
      border-radius: 6px;
      transition: background 0.15s, color 0.15s;
      text-decoration: none;
    }
    .sidebar-menu .nav-link .nav-icon {
      font-size: 1.25rem;
      margin-right: 0.5rem;
      min-width: 1.5em;
      text-align: center;
      transition: color 0.15s;
    }
    .sidebar-menu .nav-link span {
      margin: 0;
      display: inline;
      transition: color 0.15s;
    }
    .sidebar-menu .nav-link:hover,
    .sidebar-menu .nav-link.active {
      background: #f5e9d7;
      color: #5a4a3a;
    }
    .sidebar-menu .nav-link:hover .nav-icon,
    .sidebar-menu .nav-link.active .nav-icon {
      color: #b97a56;
    }
    .sidebar-menu .nav-link:hover span,
    .sidebar-menu .nav-link.active span {
      color: #5a4a3a;
    }
  </style>
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <img
        src="{{ asset('AdminLTE/Images/logo.png') }}"
        alt="CampusReaders Logo"
        class="brand-image opacity-75 shadow"
        style="max-height: 48px; width: auto; display: block; margin: 0 auto;"
      />
    </a>
  </div>
  <!--end::Sidebar Brand-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="sidebar-menu" role="navigation" aria-label="Main navigation">
        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <span>Dashboard</span>
          </a>
          <p></p>
        </li>
        <li class="nav-header">User Management</li>
        {{-- Roles --}}
        <li class="nav-item">
          <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-shield-lock"></i>
            <span>Roles</span>
          </a>
        </li>
        {{-- Users --}}
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-people"></i>
            <span>Users</span>
          </a>
          <p></p>
        </li>
        <li class="nav-header">Library Management</li>
        {{-- Books --}}
        <li class="nav-item">
          <a href="{{ route('books.index') }}" class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-book"></i>
            <span>Books</span>
          </a>
        </li>
        {{-- Categories --}}
        <li class="nav-item">
          <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-tags"></i>
            <span>Categories</span>
          </a>
        </li>
        {{-- Reservations --}}
        <li class="nav-item">
          <a href="{{ route('reservations.index') }}" class="nav-link {{ request()->is('admin/reservations*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar-check"></i>
            <span>Reservations</span>
          </a>
        </li>
        {{-- Borrowed Items --}}
        <li class="nav-item">
          <a href="{{ route('borrowed-items.index') }}" class="nav-link {{ request()->is('admin/borrowed-items*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-arrow-left-right"></i>
            <span>Borrowed Items</span>
          </a>
        </li>
        {{-- Fines --}}
        <li class="nav-item">
          <a href="{{ route('fines.index') }}" class="nav-link {{ request()->is('admin/fines*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-cash"></i>
            <span>Fines</span>
          </a>
        </li>
        {{-- Waitlists --}}
        <li class="nav-item">
          <a href="{{ route('waitlists.index') }}" class="nav-link {{ request()->is('admin/waitlists*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-list-check"></i>
            <span>Waitlists</span>
          </a>
        </li>
        {{-- Messaging Logs --}}
        <li class="nav-item">
          <a href="{{ route('messaging-logs.index') }}" class="nav-link {{ request()->is('admin/messaging-logs*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-chat-dots"></i>
            <span>Messaging Logs</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar-->
