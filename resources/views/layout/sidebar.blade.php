<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/logo1.jpg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Todo-CRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('employees*') || request()->is('create-employee') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <p>
                            Employees
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('employees') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Employees
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create-employee') }}" class="nav-link {{ request()->is('create-employee') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Employees
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{ request()->is('project*') || request()->is('create-project') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-project-diagram"></i>
                        <p>
                            Project
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('project') }}" class="nav-link {{ request()->is('project*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Project
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create-project') }}" class="nav-link {{ request()->is('create-project') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Employees
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('module*') || request()->is('create-module') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-pie"></i>
                        <p>
                            Module
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('module') }}" class="nav-link {{ request()->is('module*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Module
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create-module') }}" class="nav-link {{ request()->is('create-module') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Module
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('sub-module*') || request()->is('create-sub-module') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-pie"></i>
                        <p>
                           Sub Module
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sub-module') }}" class="nav-link {{ request()->is('sub-module*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                   Sub Module
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create-sub-module') }}" class="nav-link {{ request()->is('create-sub-module') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Sub Module
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('task*') || request()->is('create-task') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <p>
                           Task
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('task') }}" class="nav-link {{ request()->is('task*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                   Task
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create-task') }}" class="nav-link {{ request()->is('create-task') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Create Task
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
