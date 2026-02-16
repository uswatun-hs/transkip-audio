<header class="pc-header">
    <div class="header-wrapper d-flex justify-content-between align-items-center">

        <!-- LEFT SIDE -->
        <div class="d-flex align-items-center">

            <!-- Sidebar Toggle -->
            <a href="#" class="pc-head-link head-link-secondary me-3" id="sidebar-hide">
                <i class="ti ti-menu-2"></i>
            </a>

            <!-- Search -->
            <form class="header-search d-none d-md-flex">
                <i data-feather="search" class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search here..." />
            </form>

        </div>

        <!-- RIGHT SIDE -->
        <div class="d-flex align-items-center gap-3">

            <!-- Notification -->
            <div class="dropdown">
                <a class="pc-head-link head-link-secondary" data-bs-toggle="dropdown">
                    <i class="ti ti-bell"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <div class="dropdown-header">
                        <h6 class="mb-0">Notifications</h6>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="px-3 py-2 text-muted text-center">
                        Tidak ada notifikasi
                    </div>
                </div>
            </div>

            <!-- Profile -->
            <div class="dropdown">
                <a class="pc-head-link head-link-primary" data-bs-toggle="dropdown">

                    <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" class="user-avtar" alt="user" />

                </a>

                <div class="dropdown-menu dropdown-menu-end">

                    <div class="dropdown-header text-center">
                        <strong>{{ auth()->user()->name ?? 'Guest' }}</strong>
                        <br>
                        <small class="text-muted">
                            {{ auth()->user()->role ?? '-' }}
                        </small>
                    </div>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="ti ti-settings me-2"></i>
                        Account Settings
                    </a>

                    <a href="/logout" class="dropdown-item text-danger">
                        <i class="ti ti-logout me-2"></i>
                        Logout
                    </a>

                </div>
            </div>

        </div>
    </div>
</header>
