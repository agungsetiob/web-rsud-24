        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fa fa-hospital-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hi {{ Auth::user()->username }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if (Auth::user()->role == 'admin')
            <li class="nav-item {{ (request()->is('user/dashboard')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('user/dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{ (request()->is('setting/*')) ? 'active bg-active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="javascript:void(0)">Web setting</a>
                        <a class="collapse-item" href="{{url('setting/profile')}}">Profile</a>
                        <a class="collapse-item" href="{{route('faqs.index')}}">FAQ</a>
                        <a class="collapse-item" href="javascript:void(0)">Menu</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ (request()->is('standar/pelayanan')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('standar/pelayanan')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Standar Pelayanan</span></a>
            </li>

            <li class="nav-item {{ (request()->is('upload-file')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('upload-file')}}">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Document</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ (request()->is('doctors')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('doctors')}}">
                    <i class="fas fa-fw fa-user-doctor"></i>
                    <span>Doctors</span></a>
            </li>

            <li class="nav-item {{ (request()->is('skm')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('skm')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>SKM</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ (request()->is('category')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('category')}}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Categories</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ (request()->is('messages')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('messages')}}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Messages</span></a>
            </li>

            <li class="nav-item {{ (request()->is('users')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('users')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item {{ (request()->is('our-services')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('our-services')}}">
                    <i class="fas fa-fw fa-hand-holding-medical"></i>
                    <span>Our Services</span></a>
            </li>

            <li class="nav-item {{ (request()->is('pengaduan/list')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('pengaduan/list')}}">
                    <i class="fas fa-fw fa-comment-alt"></i>
                    <span>Pengaduan Masyarakat</span></a>
            </li>

            <li class="nav-item {{ (request()->is('backup')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('backup')}}">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Backup</span></a>
            </li>
            @elseif (Auth::user()->role == 'user')
            <li class="nav-item active {{ (request()->is('dashboard')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{ (request()->is('posts/create')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('posts/create')}}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Article</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ (request()->is('standar/pelayanan')) ? 'active bg-active' : '' }}">
                <a class="nav-link" href="{{url('standar/pelayanan')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Standar Pelayanan</span></a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->