<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">  
  <base href="http://localhost/web-app/">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Motion Law LLC - App') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- csrf-token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('dist/img/favicon/favicon.ico') }}">
  <link rel="icon" href="{{ asset('dist/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
  <link rel="icon" href="{{ asset('dist/img/favicon/android-icon-192x192.png') }}" sizes="192x192" />
  <link rel="apple-touch-icon" href="{{ asset('dist/img/favicon/apple-icon-180x180.png') }}" />  
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/datatables.min.css"/>
  <style>
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover{
      background: #141035 !important;
      color:white;
    }
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
      background: #141035 !important;
    }
    .dropdown-item:active {
      background: none !important};
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Support</a>
      </li>
    </ul>

    <!-- SEARCH FORM 
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link border mr-2" data-toggle="dropdown" href="#" style="border-radius:20px;">
          <i class="far fa-bell"></i>
          <p style="display:contents;">What's new</p>
          <i class="fa fa-caret-down"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notification Bar</span>
          <div class="dropdown-divider"></div>
          <!--<a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>          
          <div class="dropdown-divider"></div>-->
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link border" data-toggle="dropdown" href="#" style="border-radius:20px;">
          <i class="fa fa-cog mr-2"></i>
          <p style="display:contents;">{{ Auth::user()->name }}</p>
          <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <span class="dropdown-item dropdown-header" style="text-align:left; cursor:pointer;">Settings</span>
          <span class="dropdown-item dropdown-header" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-align:left; cursor:pointer;"><a style="color:#6c757d;">Log Out</a></span>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link navbar-light py-0">
      <img src="{{ asset('dist/img/brand/Motion Law Vertical Logo.png') }}" alt="Motion Law LLc" width="45" class="brand-image-llc ml-2" />
      <span class="brand-text font-weight-light">
        <img src="{{ asset('dist/img/brand/Motionlaw-logogold_Plan de travail 1.png') }}" width="140" />
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info py-0">
          <a class="d-block mb-0">{{ Auth::user()->name }}</a>
          <small class="my-0 text-light">Admin</small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->          
          <li class="nav-item left-menu">
            <a href="{{ route('staff') }}" target="_self" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Staff
              </p>
            </a>
          </li>
          <li class="nav-item left-menu">
            <a href="{{ route('clients') }}" target="_self" class="nav-link">
              <i class="nav-icon fa fa-child"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item left-menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                Communication
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('communication/push') }}" target="_self" class="nav-link">
                  <i class="far fa fa-mobile nav-icon"></i>
                  <p>Push Notifications</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="{{ route('communication/mail') }}" target="_self" class="nav-link">
                  <i class="far fa fa-envelope-open nav-icon"></i>
                  <p>Mail Mesages</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="{{ route('communication/chat') }}" target="_self" class="nav-link">
                  <i class="far fa fa-comments nav-icon"></i>
                  <p>Chat</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item left-menu">
            <a href="{{ route('cases') }}" target="_self" class="nav-link">
              <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Cases
              </p>
            </a>
          </li>
          <!--<li class="nav-item left-menu">
            <a href="{{ route('blog') }}" target="_self" class="nav-link">
              <i class="nav-icon fa fa-quote-left"></i>
              <p>
                Blog
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
            </ul>
          </li>-->
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                {{ __('Logout') }}                
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <small><strong>Copyright &copy; @php echo date("Y"); @endphp <a href="https://www.motionlaw.com/" target="_blank">Motion Law LLC</a>.</strong>
    All rights reserved.</small>
  </footer>
  
</div>
<!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ URL::asset('dist/js/adminlte.js') }}"></script>
  <!--<script src="{{ URL::asset('js/app.js') }}"></script>-->    
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/datatables.min.js"></script>
</body>
</html>