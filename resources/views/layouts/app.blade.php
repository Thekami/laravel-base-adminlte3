<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @yield('title')
  <title>AdminLTE 3 | Dashboard 2</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
 
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    @include('layouts.nav')

    <!-- Main Sidebar Container -->
    @include('layouts.sidenav')

    <div class="content-wrapper">
      @yield('content')    
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    
    @include('layouts.footer')
    
  </div>


  <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/dist/js/adminlte.js') }}"></script>

  <script src="{{ url('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ url('assets/plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ url('assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ url('assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

  <script src="{{ url('assets/plugins/chart.js/Chart.min.js') }}"></script>


  <script src="{{ url('assets/dist/js/demo.js') }}"></script>
  <script src="{{ url('assets/dist/js/pages/dashboard2.js') }}"></script>

  @yield('scripts')

</body>
</html>
