<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset ('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset ('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset ('lte/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset ('lte/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset ('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset ('lte/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset ('lte/plugins/summernote/summernote-bs4.min.css')}}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('lte/docs/assets/img/logo-klinik.png')}}" alt="klinikLogo" height="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                {{-- user profil --}}
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <!-- Ganti gambar dengan ikon profil kosong -->
                        <i class="fas fa-user-circle user-image" style="font-size: 1.5rem;"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <i class="fas fa-user-circle text-white" style="font-size: 4rem;"></i>
                            <p>
                                {{Auth::user()->name}}
                                <small>{{Auth::user()->role}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!-- Form untuk logout -->
                            <a href="{{ Auth::user()->role === 'admin' ? route('profil.admin') : (Auth::user()->role === 'dokter' ? route('profil.dokter') : route('profil.pasien')) }}" class="btn btn-default btn-flat">Profile</a>
                            {{-- <a href="{{ $role === 'admin' ? route('logout.admin') : ($role === 'dokter' ? route('logout.dokter') : route('logout.pasien')) }}" class="btn btn-default btn-flat float-right">Sign out</a> --}}
                            <form action="{{ Auth::user()->role === 'admin' ? route('logout.admin') : (Auth::user()->role === 'dokter' ? route('logout.dokter') : route('logout.pasien')) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-default btn-flat float-right">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('lte/docs/assets/img/logo-klinik.png')}}" alt="poliklinik Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Poklinik BK</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="nav-link">
                        <a href="{{route('dashboard')}}" class="d-block">
                            <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @if (Auth::user()->role == 'admin')
                        <li class="nav-header">PENGELOLAAN DATA</li>
                        <li class="nav-item">
                            <a href="{{route('index.admin')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i> <!-- Ikon untuk Administrator -->
                                <p>
                                    Administrator
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.dokter')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-md"></i> <!-- Ikon untuk Dokter -->
                                <p>
                                    Dokter
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.pasien')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-injured"></i> <!-- Ikon untuk Pasien -->
                                <p>
                                    Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.poli')}}" class="nav-link">
                                <i class="nav-icon fas fa-clinic-medical"></i> <!-- Ikon untuk Poli -->
                                <p>
                                    Poli
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.obat')}}" class="nav-link">
                                <i class="nav-icon fas fa-pills"></i> <!-- Ikon untuk Obat -->
                                <p>
                                    Obat
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'dokter')

                        <li class="nav-item">
                            <a href="{{route('index.jadwalperiksa')}}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i> <!-- Ikon untuk Jadwal -->
                                <p>
                                    Jadwal Periksa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.periksapasien')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-md"></i> <!-- Ikon untuk Memeriksa Pasien -->
                                <p>
                                    Memeriksa Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.riwayatpasien')}}" class="nav-link">
                                <i class="nav-icon fas fa-file-medical"></i> <!-- Ikon untuk Riwayat Pasien -->
                                <p>
                                    Riwayat Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.konsultasi.dokter')}}" class="nav-link">
                                <i class="nav-icon fas fa-file-medical"></i> <!-- Ikon untuk Riwayat Pasien -->
                                <p>
                                    Konsultasi Pasien
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'pasien')
                        <li class="nav-item">
                            <a href="{{route('index.daftarpoli')}}" class="nav-link">
                                <i class="nav-icon fas fa-clinic-medical"></i> <!-- Ikon untuk Poli -->
                                <p>
                                    Daftar Poli
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index.konsultasi.pasien')}}" class="nav-link">
                                <i class="nav-icon fas fa-clinic-medical"></i> <!-- Ikon untuk Poli -->
                                <p>
                                    Konsultasi
                                </p>
                            </a>
                        </li>
                        @endif

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->


        <footer class="main-footer">
            <strong>Copyright &copy; {{date('Y')}} <a href="#" target="_blank">POLIKLINIK BK</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset ('lte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset ('lte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset ('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset ('lte/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset ('lte/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset ('lte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset ('lte/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset ('lte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset ('lte/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset ('lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset ('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset ('lte/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset ('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset ('lte/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset ('lte/dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{asset ('lte/dist/js/pages/dashboard.js')}}"></script> --}}

    @yield('script')
</body>

</html>