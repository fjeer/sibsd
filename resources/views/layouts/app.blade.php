<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Bank Sampah Digital - @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Anaheim:wght@400..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg shadow-sm navbar-custom fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="{{ asset('img/bsd-logo.png') }}" alt="">
                </a>
                @auth
                <div class="ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->profile->avatar ?? asset('img/pp wa kosong sad.jpg') }}" alt="Profile" class="profile-img rounded-circle" width="50" height="50">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                        My Profile
                                    </a>
                                    <a class="dropdown-item" href="">
                                        {{ Auth::user()->username ?? 'undefined user' }}
                                        <p class="text-body-secondary role">{{ Auth::user()->role }}</p>
                                    </a>

                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="container">
                <ul class="nav nav-pills flex-column mt-3">
                    <li class="nav-link"><a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active fw-bold' : '' }}" href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a></li>
                    <li class="nav-item mt-1 mb-1"><span class="text-muted text-uppercase fw-bold small">Data Master</span></li>

                    <li class="nav-item mb-2"><a class="nav-link {{ request()->routeIs('user.index') ? 'active fw-bold' : '' }}" href="{{ route('user.index') }}">
                    @if(auth()->user()->role === 'admin')
                        User Management
                    @elseif(auth()->user()->role === 'petugas')
                        Data Nasabah
                    @endif
                    </a></li>

                    <li class="nav-item mb-2"><a class="nav-link {{ request()->routeIs('sampah.index') ? 'active fw-bold' : '' }}" href="{{ route('sampah.index') }}">Data Sampah</a></li>

                    <li class="nav-item mt-2 mb-1"><span class="text-muted text-uppercase fw-bold small">Transaksi</span></li>

                    <li class="nav-item mb-2"><a class="nav-link {{ request()->routeIs('setor.create') ? 'active fw-bold' : '' }}" href="{{ route('setor.create') }}">Transaksi Setor Sampah</a></li>

                    <li class="nav-item mb-2"><a class="nav-link {{ request()->routeIs('setor.index') ? 'active fw-bold' : '' }}" href="{{ route('setor.index') }}">Riwayat Transaksi</a></li>

                    <li class="nav-item mt-2 mb-1"><span class="text-muted text-uppercase fw-bold small">Laporan</span></li>
                    
                    <li class="nav-item mb-2"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a></li>
                </ul>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="content pt-5 px-1">
            <div class="notifikasi">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <h4>Terjadi kesalahan</h4>
                    <hr>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>

</html>
