<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/dashboard.css?v=1.5.0" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <div class="logo" id="logo">
        <a href="" class="simple-text text-center">
          EMS
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav" id="nav">
          <li class="">
            <a href="/dashboard">
            <i class="fas fa-box-open"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li>
            <a href="/profile">
            <i class="fas fa-user-cog"></i>
              <p>Profile</p>
            </a>
          </li>
          <li>
            <a href="/table">
            <i class="fas fa-table"></i>
              <p>Table</p>
            </a>
          </li>
          <li>
            <a href="/chart">
            <i class="far fa-chart-bar"></i>
              <p>Chart</p>
            </a>
          </li>
          <li>
            <a href="/add">
            <i class="fas fa-plus"></i>
              <p>Add</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      @yield('nav')
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="{{ url('/') }}">
              @if (Request::is('chart'))
              Dashboard / Chart
              @elseif(Request::is('table'))
              Dashboard / Table
              @elseif(Request::is('profile'))
              Dashboard / Profile
              @elseif(Request::is('add'))
              Dashboard / Add
              @else
              Dashboard
              @endif
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/profile">Profile</a>
                  <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      @yield('header')
      <div class="panel-header panel-header-sm">
      </div>
      @yield('content')


      <script src="/assets/js/core/jquery.min.js"></script>
      <script src="/assets/js/core/popper.min.js"></script>
      <script src="/assets/js/core/bootstrap.min.js"></script>
      <script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
      <script src="/assets/js/plugins/chartjs.min.js"></script>
      <script src="/assets/js/plugins/bootstrap-notify.js"></script>
      <script src="/assets/js/dashboard.min.js?v=1.5.0" type="text/javascript"></script>
      <script src="/assets/demo/demo.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        $(document).ready(function () {
          demo.initDashboardPageCharts();

        });
      </script>
      @yield('script')
</body>

</html>