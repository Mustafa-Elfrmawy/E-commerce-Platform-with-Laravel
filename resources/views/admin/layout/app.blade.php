<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
  >
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin-asset/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Dropzone -->
  <link rel="stylesheet" href="{{ asset('admin-asset/plugins/dropzone/min/dropzone.min.css') }}">
  <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('admin-asset/plugins/summernote/summernote.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin-asset/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-asset/css/custom.css') }}">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    #content_load {
      display: none;
    }
    #loader_load {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60px;
      height: 60px;
      border: 6px solid #f3f3f3;
      border-top: 6px solid #007bff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      z-index: 9999;
      background: transparent;
    }
    @keyframes spin {
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">

  <!-- Loader -->
  <div id="loader_load"></div>

  <!-- Content wrapper (hidden until load) -->
  <div id="content_load">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="pushmenu"
              href="#"
              role="button"
            >
              <i class="fas fa-bars"></i>
            </a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Fullscreen -->
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="fullscreen"
              href="#"
              role="button"
            >
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <!-- User dropdown -->
          <li class="nav-item dropdown">
            <a
              class="nav-link p-0 pr-3"
              data-toggle="dropdown"
              href="#"
            >
              <img
                src="{{ asset('admin-asset/img/avatar5.png') }}"
                class="img-circle elevation-2"
                width="40"
                height="40"
                alt="User Avatar"
              >
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
              <h4 class="h4 mb-0"><strong>Mohit Singh</strong></h4>
              <div class="mb-3">example@example.com</div>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-user-cog mr-2"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-lock mr-2"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
              </form>
            </div>
          </li>
        </ul>
      </nav>

      @yield('content')

      <footer class="main-footer">
        <strong>
          Copyright &copy; 2014-2022 AmazingShop.
        </strong>
        All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->
  </div>

  <!-- Scripts -->
  <script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin-asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin-asset/plugins/dropzone/min/dropzone.min.js') }}"></script>
  <script src="{{ asset('admin-asset/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('admin-asset/js/demo.js') }}"></script>
  <script src="{{ asset('admin-asset/plugins/summernote/summernote.min.js') }}"></script>

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
      $(".summernote").summernote({ height: 250 });
    });

    window.addEventListener('load', function() {
      document.getElementById('loader_load').style.display = 'none';
      document.getElementById('content_load').style.display = 'block';
    });
  </script>

  @yield('custom-js')
</body>
</html>
