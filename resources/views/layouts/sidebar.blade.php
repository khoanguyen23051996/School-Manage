<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="javascript:;" class="brand-link">
    <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">School Manage</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ route('admin.admin') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Admin</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.teacher') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Teacher</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.student') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Student</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.parent') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Parent</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.class') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Class</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.subject') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                            <i class="nav-icon fa fa-book"></i>
                            <p>Subject</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.assign_subject') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                            <i class="nav-icon fa fa-tasks"></i>
                            <p>Assign Subject</p>
                        </a> 
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Change Password</p>
                        </a> 
                    </li>
                
                @elseif (Auth::user()->role == 2)
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('teacher.change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Change Password</p>
                        </a> 
                    </li>
                
                @elseif (Auth::user()->role == 3)
                    <li class="nav-item">
                        <a href="{{ route('student.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('student.change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Change Password</p>
                        </a> 
                    </li>

                   
                
                @elseif (Auth::user()->role == 4)
                    <li class="nav-item">
                        <a href="{{ route('parent.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('parent.change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Change Password</p>
                        </a> 
                    </li>
                
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Log out</p>
                    </a> 
                </li>
            </ul>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>