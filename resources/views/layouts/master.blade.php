<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Pannel </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
      <!-- Navbar Search -->


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">AdminPannel By Lavish</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Lavish Chouhan</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
@role('admin')
            <li class="nav-item">
                <a href="{{ url('users') }}" class="nav-link">
                    User Table
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link">
                    Role
                </a>

            </li>
@endrole
            <li class="nav-item">
                <a href="{{ url('invoice') }}" class="nav-link">
                    Invoice
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('plans') }}" class="nav-link">
                    Plans
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('dash') }}" class="nav-link">
                    configuration for Email
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('email') }}" class="nav-link">
                    Send MAIL
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('event') }}" class="nav-link">
                    Event Listner demo
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('sender') }}" class="nav-link">
                    Pusher Sender
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('counter') }}" target="_blank" class="nav-link">
                    Pusher Receiver
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('stripeinput') }}" class="nav-link">
                    Stripe Config Insert
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('test') }}" class="nav-link">
                    Component Test
                </a>
            </li>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   @yield('content')


  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer fixed-bottom">
  <a href='#top'>Go To The Top</a>
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="#">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $("a[href='#top']").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});
// Right Click Block
// $(document).bind("contextmenu",function(e){
//   return false;
//     });
</script>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
