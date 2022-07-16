<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Tapro (Task Progress)</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/demo.min.css') }}" rel="stylesheet" />
    <!-- Pus Dist -->
    <link href="{{ asset('assets/pus_dist/css/style.css') }}" rel="stylesheet" />
    <!-- Toast -->
    <link rel="stylesheet" href="{{ asset('assets/pus_dist/lib/jquery-toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pus_dist/lib/sweetalert/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- ....... -->
</head>

<body class="layout-fluid theme-light">
    <div class="page">
        @if(!isset($nav) || $nav == true)
        <header class="navbar navbar-expand-md navbar-light d-print-none mx-3 my-2 rounded-10">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3 d-flex d-md-none">
                    <a href=".">
                        <img src="{{ asset('assets/dist/img/logo/logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                            <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                            </svg>
                            <span class="badge bg-red" id="notificationBeat" style="display: none;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card rounded-20">
                            <div class="card rounded-20">
                                <div class="card-header d-flex justify-content-between cursor-pointer">
                                    <h3 class="card-title">Last updates</h3>
                                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="Bersihkan Notifikasi">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clear-all" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 6h12"></path>
                                            <path d="M6 12h12"></path>
                                            <path d="M4 18h12"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="list-group list-group-flush list-group-hoverable" id="bell-notification-list">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col text-truncate text-center">
                                                <span class="text-muted d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-ringing" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                                        <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727"></path>
                                                        <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727"></path>
                                                    </svg>
                                                    <span class="ms-2">
                                                        Belum ada notifikasi
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm">{{ substr(Auth::user()->name, 0, 2) }}</span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <!-- <a href="#" class="dropdown-item">Set status</a> -->
                            <a href="#" class="dropdown-item">Profile &amp; account</a>
                            <!-- <a href="#" class="dropdown-item">Feedback</a> -->
                            <div class="dropdown-divider"></div>
                            <!-- <a href="#" class="dropdown-item">Settings</a> -->
                            <a href="#" class="dropdown-item" onclick="logout_app()">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav strong">
                            <li class="nav-item @if(isset($page->nav_code) && $page->nav_code == 0) active @endif">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Beranda
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item @if(isset($page->nav_code) && $page->nav_code == 1) active @endif">
                                <a class="nav-link" href="{{ route('ruang_kerja') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Ruang Kerja
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        @endif
        <!-- Subnab jika ada -->
        @yield('subnav')
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                @yield('header')
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none d-none d-md-block">
                <div class="container-xl">
                    <div class="row text-center align-items-center">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; Pusproject
                                    Created By @Ujun Junaedi
                                </li>
                                <li class="list-inline-item">
                                    <a href="./changelog.html" class="link-secondary" rel="noopener">
                                        v0.0.1-1.0.0
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <x-modal.logout />
    @yield('modal')
    <!-- Libs JS -->
    <script src="{{ asset('assets/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world.js') }}"></script>
    <script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world-merc.js') }}"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('assets/dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/dist/libs/litepicker/dist/litepicker.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.min.js') }}"></script>
    <!-- ............. -->
    <!-- Hiiden Custome -->
    <script src="{{ asset('assets/pus_dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/pus_dist/lib/jquery-number-format/number-format.js') }}"></script>
    <!-- Toast and sweetalert -->
    <script src="{{ asset('assets/pus_dist/lib/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('assets/pus_dist/lib/sweetalert/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Custome Js -->
    <script src="{{ asset('assets/pus_dist/js/script.js') }}"></script>

    <script>
        let auth_user = <?= json_encode(Illuminate\Support\Facades\Auth::user()) ?>;
        let user_id = auth_user.id;
        let url = "<?= url('') ?>";
        let token = "<?= Illuminate\Support\Facades\Session::token() ?>";
    </script>
    @yield('script')
    @stack('script')
    <!-- Notif -->
    @if(session('success'))
    <script>
        notif('<?= session('success') ?>', 'info');
    </script>
    @endif

    @if(session('failed'))
    <script>
        notif('<?= session('failed') ?>', 'error');
    </script>
    @endif
</body>

</html>