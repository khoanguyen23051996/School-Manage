<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="" class="nav-link">Home</a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="{{ route('chat') }}" class="dropdown-item">
        <div class="dropdown-divider"></div>
        <a href="{{ route('chat') }}" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
    </li>
</ul>
</nav>
<!-- /.navbar -->