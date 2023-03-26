<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title') | Sistem Informasi Menara Telekomunikasi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2-bootstrap4.min.css') }}">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/fh-3.3.2/r-2.4.1/sl-1.6.2/datatables.min.css" />
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
    <!-- Custom theme style -->
    <link rel="stylesheet" href="{{ asset('/dist/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Sweetalert2 -->
    @include('sweetalert::alert')

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item d-lg-none">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link">@yield('page_title')</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('do-logout') }}" role="button" title="Logout" id="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-green elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{ asset('dist/img/Logo_Kota_Yogyakarta_small.png') }}" alt="SIMentel Logo" class="brand-image img-circle">
                <span class="brand-text text-white">SIMentel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column justify-content-center">
                    <div class="image text-center">
                        <img src="{{ Auth::getUser()->url_photo ? asset(Auth::getUser()->url_photo) : asset('/dist/img/avatar.png') }}" class="img-circle" alt="Avatar">
                    </div>
                    <div class="info text-center">
                        <a href="#" class="d-block text-white">{{ Auth::getUser()->user }}</a>
                    </div>
                </div>
                <!-- /.Sidebar user -->

                <!-- Sidebar Menu -->
                @include('_template.sidebar-menu-main')
                <!-- /.sidebar menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid pt-3">

                    <!-- Page content -->
                    @yield('content')

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            Dinas Komunikasi Informatika dan Persandian &copy; 2023 Pemerintah Kota Yogyakarta
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert 2 -->
    <script src="{{ asset('/vendor/sweetalert/sweetalert.all.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/fh-3.3.2/r-2.4.1/sl-1.6.2/datatables.min.js"></script>
    <!-- OverlayScrollbars -->
    <script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Custom Alert -->
    <script src="{{ asset('/dist/js/custom-alert.js') }}"></script>

    @stack('scripts')

    <!-- Custom Script -->
    <script>
        let dt_dom =
            "<'row justify-content-between'" +
            "<'col-auto text-sm'l>" +
            "<'col-auto'B>" +
            "<'col-auto text-sm'f>" +
            ">" +
            "<'row dt-table'" +
            "<'col-md-12'tr>" +
            ">" +
            "<'row justify-content-between'" +
            "<'col-auto text-sm'i>" +
            "<'text-right col-auto paging-custom'p>" +
            ">"
        let dt_button = [{
                text: '<i class="fas fa-plus mr-1 fas-custom"></i> Tambah',
                className: 'btn btn-primary btn-sm'
            },
            {
                text: 'Orange',
                className: 'btn btn-primary btn-sm'
            },
            {
                text: 'Green',
                className: 'btn btn-primary btn-sm'
            }
        ]
        let dt_index = {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            createdCell: cell => $(cell).addClass('text-right pr-2')
        }
        let dt_action = {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }

        $('#forms').on('submit', function(e) {
            $('input.required').each(function(i, obj) {
                if (!$(this).val()) {
                    e.preventDefault()
                    $(this).addClass('is-invalid')
                } else {
                    $(this).removeClass('is-invalid')
                }
            })
        })

        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
</body>

</html>