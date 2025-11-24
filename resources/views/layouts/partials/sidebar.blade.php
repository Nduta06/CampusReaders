<!--begin::Sidebar-->
<aside class="app-sidebar">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{ url('/admin/dashboard') }}" class="brand-link">
            <img
                src="{{ asset('AdminLTE/Images/logo.png') }}"
                alt="CampusReaders Logo"
                class="brand-image"
            />
            <span class="sidebar-brand-text">CampusReaders</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->
    
    <div class="sidebar-wrapper">
        <nav>
            <ul class="sidebar-menu" role="navigation" aria-label="Main navigation">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- User Management Section --}}
                <li class="nav-header">User Management</li>
                
                <li class="nav-item">
                    <a href="{{ url('admin/roles') }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-lock"></i>
                        <span>Roles</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>

                {{-- Library Management Section --}}
                <li class="nav-header">Library Management</li>
                
                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-book"></i>
                        <span>Books</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('reservations.index') }}" class="nav-link {{ request()->is('admin/reservations*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-check"></i>
                        <span>Reservations</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('borrowed-items.index') }}" class="nav-link {{ request()->is('admin/borrowed-items*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-arrow-left-right"></i>
                        <span>Borrowed Items</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('fines.index') }}" class="nav-link {{ request()->is('admin/fines*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cash-coin"></i>
                        <span>Fines</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('waitlists.index') }}" class="nav-link {{ request()->is('admin/waitlists*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-list-check"></i>
                        <span>Waitlists</span>
                    </a>
                </li>
                
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