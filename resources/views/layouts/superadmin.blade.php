<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="{{ asset('icon.png') }}" type="image/x-icon" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/ionslider/ion.rangeSlider.min.js') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    @yield('css')
    <style>
        .badge-notif {
            position: relative;
            color: white;
        }

        .badge-notif[data-badge]:after {
            content: attr(data-badge);
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: .7em;
            background: #e53935;
            color: white;
            width: 18px;
            height: 18px;
            text-align: center;
            line-height: 18px;
            border-radius: 50%;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="/superadmin/home" class="logo">
                <span class="logo-mini"><b>SA</b></span>
                <span class="logo-lg"><b>Super Admin</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navigation</span>
                </a>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <img src="{{ asset('logo.jpeg') }}" alt="logo" width="100%">
                    <br>
                    <br>
                    <div class="pull-left image">
                        <img src="{{ asset('foto/' . Auth::user()->foto) }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('superadmin.index') }}">
                            <i class="fa fa-home"></i> <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.gudang') }}">
                            <i class="fa fa-building"></i> <span>Data Factory</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.admin') }}">
                            <i class="fa fa-users"></i> <span>Data Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.machine') }}">
                            <i class="fa fa-list"></i> <span>Data Machine</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.hose') }}">
                            <i class="fa fa-list-alt"></i> <span>Data Hose</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.history') }}">
                            <i class="fa fa-history"></i> <span>Data History</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin.profile') }}">
                            <i class="fa fa-wrench"></i> <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fa fa-sign-out"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                {{-- <b>Build By PT. SOLUSI CAHAYA TANGGUH</b> --}}
            </div>
            <strong>Copyright &copy; 2024 . Build By PT. SOLUSI CAHAYA TANGGUH</strong>
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    @yield('javascript')
</body>

</html>
