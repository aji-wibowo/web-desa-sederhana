<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($title) ? $title : config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- datatables -->
    <link rel="stylesheet" href="{{ url('/') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    {{-- sweet alert css --}}
    <link rel="stylesheet" href="{{ url('/') }}/css/sweetalert2.min.css">

    <!-- jQuery -->
    <script src="{{ url('/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Datatable -->
    <script src="{{ url('/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    {{-- sweet alert js --}}
    <script src="{{ url('/') }}/js/sweetalert2.all.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        {{-- Menu General --}}
                        <div class="dropdown">
                            <button class="btn nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profil
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('tentang') }}">Tentang Desa</a>
                                <a class="dropdown-item" href="{{ route('struktur_organisasi') }}">Struktur Desa</a>
                                <a class="dropdown-item" href="{{ route('rukun_warga_user') }}">Daftar Rukun
                                    Warga</a>
                            </div>
                        </div>
                        @if (Auth::user())
                            <div class="dropdown">
                                <button class="btn nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Layanan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('layanan_ktp') }}">Pembuatan KTP</a>
                                    <a class="dropdown-item" href="{{ route('layanan_kk') }}">Pembuatan Kartu
                                        Keluarga</a>
                                    <a class="dropdown-item" href="{{ route('layanan_surat_pindah') }}">Pembuatan
                                        Surat Pindah Datang WNI</a>
                                </div>
                            </div>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hubungi_kami') }}">Hubungi Kami</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('myaccount_user') }}">
                                        {{ __('profil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 content">
            @yield('content')
        </main>

        <div class="container-fluid footer shadow-sm">
            <div class="row">
                <div class="col-md-4 layout-footer">
                    <h5>Kantor Kepala Desa Situsari</h5>
                    <p>Jl. Kampung Karet RT/RW. 02/01 Cileungsi, Bogor, Indonesia, 16820</p>
                    <p>Phone: 0211234567</p>
                    <p>Email: desasitusari@gmail.com</p>
                </div>
                <div class="col-md-4 layout-footer">
                    <h5>Main Menu</h5>
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('myaccount_user') }}">Profile</a>
                        </li>
                        <li>
                            <a href="#">Layanan</a>
                            <ul>
                                <li>
                                    <a href="{{ route('layanan_ktp') }}">KTP</a>
                                </li>
                                <li>
                                    <a href="{{ route('layanan_kk') }}">KK</a>
                                </li>
                                <li>
                                    <a href="{{ route('layanan_surat_pindah') }}">Surat Pindah</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('hubungi_kami') }}">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 layout-footer">
                    <h5>Media Sosial</h5>
                    <ul>
                        <li>
                            <a href="#">Facebook</a>
                        </li>
                        <li>
                            <a href="#">Twitter</a>
                        </li>
                        <li>
                            <a href="#">Instagram</a>
                        </li>
                        <li>
                            <a href="#">Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var sMessage = '{{ Session::has('sweetAlertMessage') }}';
            if (sMessage == '1') {
                Swal.fire({
                    icon: '{{ Session::has('sweetAlertMessage') ? Session::get('sweetAlertMessage')['icon'] : '' }}',
                    title: '{{ Session::has('sweetAlertMessage') ? Session::get('sweetAlertMessage')['title'] : '' }}',
                    text: '{{ Session::has('sweetAlertMessage') ? Session::get('sweetAlertMessage')['text'] : '' }}'
                })
            }
        });

    </script>

</body>

</html>
