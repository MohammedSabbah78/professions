<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Professions | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <style>



  </style>
  @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('cms.dashboard')}}" class="nav-link">Home</a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-8">


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel  mt-3 pb-3 mb-3 d-flex info">
          <div class="image">
            <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-5" alt="User Image">
          </div>
          <div class="info">
            <a class="d-block">
              {{auth()->user()->name}}
            </a>
          </div>

        </div>

        <div class="info user-panel mt-3 pb-6 mb-6 d-flex">
          <a class="d-block" style="color: white"></a>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @hasrole('Super-Admin')
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Starter Pages
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('cms.dashboard')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Main Page</p>
                  </a>
                </li>
              </ul>
            </li>
            @endhasrole


            @canany(['Create-Admin', 'Read-Admins', 'Create-User','Read-Users'])
            {{-- HR --}}
            <li class="nav-header">Human Resources</li>
            @canany(['Create-User','Read-Users'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Users
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Read-Users')
                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan

                @can('Create-User')
                <li class="nav-item">
                  <a href="{{route('users.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany
            @canany(['Create-Admin', 'Read-Admins'])

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Admins
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Read-Admins')
                <li class="nav-item">
                  <a href="{{route('admins.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan

                @can('Create-Admin')
                <li class="nav-item">
                  <a href="{{route('admins.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany
            @endcanany


            @canany(['Create-Category', 'Read-Categories',
            'Create-SubCategory','Read-SubCategories','Read-FavoriteProfessions','Create-Profession','Read-Professions'])
            {{--Content Management --}}
            <li class="nav-header">Content Management</li>

            @canany(['Create-Category', 'Read-Categories'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Categories
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Read-Categories')
                <li class="nav-item">
                  <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan

                @can('Create-Category')
                <li class="nav-item">
                  <a href="{{route('categories.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany
            @canany(['Create-SubCategory','Read-SubCategories'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Sub-Categories
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Read-SubCategories')
                <li class="nav-item">
                  <a href="{{route('subCategories.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan
                @can('Create-SubCategory')
                <li class="nav-item">
                  <a href="{{route('subCategories.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan


              </ul>
            </li>
            @endcanany
            @canany(['Read-FavoriteProfessions','Create-Profession','Read-Professions'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Professions
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Read-Professions')
                <li class="nav-item">
                  <a href="{{route('professions.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan

                @can('Create-Profession')
                <li class="nav-item">
                  <a href="{{route('professions.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan
                @can('Read-FavoriteProfessions')
                <li class="nav-item">
                  <a href="{{route('favoriteProfessions.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Favorite</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany

            @endcanany
            @canany(['Create-Role', 'Read-Roles', 'Create-Permissions','Read-Permissions'])
            {{--Roles And Permissions --}}
            <li class="nav-header">Roles And Permissions</li>

            @canany(['Create-Role', 'Read-Roles'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Role
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                @can('Read-Roles')
                <li class="nav-item">
                  <a href="{{route('roles.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan
                @can('Create-Role')
                <li class="nav-item">
                  <a href="{{route('roles.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany


            @canany(['Create-Permissions','Read-Permissions'])
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Permissions
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Read-Permissions')
                <li class="nav-item">
                  <a href="{{route('permissions.index')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Index</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany

            @endcanany

            {{--Settings --}}
            <li class="nav-header">Settings</li>
            <li class="nav-item">
              <a href="{{route('auth.change-password')}}" class="nav-link">

                <i class="nav-icon far fa-circle text-info"></i>
                <p class="text">Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('auth.logout')}}" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Logout</p>
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('page_name')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">@yield('main_page')</a></li>
                <li class="breadcrumb-item active">@yield('small_page_name')</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @yield('main-content')
    </div>
    <!-- /.content-wrapper -->

    <aside class="control-sidebar control-sidebar-dark" style="display: block;">
      <!-- Control sidebar content goes here -->
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{Storage::url(auth()->user()->image)}}"
            alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

        <p class="text-muted text-center">{{auth()->user()->email}}</p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>mobile</b> <a class="float-right">{{auth()->user()->mobile}}</a>
          </li>

        </ul>

        <a href="{{route('auth.change-password')}}" class="btn btn-danger btn-block"><b>Change Password</b></a>
      </div>
    </aside>
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2022 <a href="#"> Professions Management</a>.</strong> All rights
      reserved <a href="#">Mohammed Sabbah</a>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @yield('scripts')
</body>

</html>