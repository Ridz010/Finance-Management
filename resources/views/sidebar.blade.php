<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">SpendSmart</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menu
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i>
                    Halaman Utama
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('pemasukan') }}" class="sidebar-link">
                    <i class="fa-solid fa-file-lines pe-2"></i>
                    Pemasukan
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('pengeluaran') }}" class="sidebar-link">
                    <i class="fa-solid fa-file-lines pe-2"></i>
                    Pengeluaran
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('catatan') }}" class="sidebar-link">
                    <i class="fa fa-sticky-note pe-2" aria-hidden="true"></i>
                    Catatan
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                    aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                    Auth
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('change-password-form') }}" class="sidebar-link">Ganti Password</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('logout') }}" class="sidebar-link">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>