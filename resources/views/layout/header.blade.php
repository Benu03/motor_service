<body class="hold-transition sidebar-mini layout-fixed pace-primary">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('lobby') }}" target="_blank" class="nav-link">
            <i class="fa fa-home"></i> Lobby
          </a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link text-info" data-toggle="dropdown" href="#" aria-expanded="true">
            <i class="fas fa-bell mr-3"></i>
            {{-- @if ($count_notif > 0)
            <span class="badge navbar-badge">{{ $count_notif }}</span>
            @endif --}}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right text-primary">
            <span class="dropdown-item dropdown-header">Notifications</span>
            <div class="dropdown-divider"></div>
            <!-- Add notification content here -->
          </div>
        </li>

        <!-- Profile Link -->
        <li class="nav-item ml-2">
          <a class="nav-link text-success" href="{{ route('profile') }}">
            <i class="fa fa-lock"></i>
          </a>
        </li>

        <!-- Logout Link -->
        <li class="nav-item ml-2">
          <a class="nav-link text-danger" href="{{ route('logout') }}">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->


