<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- Latest compiled and minified CSS -->
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
        <div class="d-flex">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 255px; height:auto; min-height: 93vh">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" wire:navigate class="nav-link {{ request()->routeIs('home') ? 'active' : ''}} text-white  d-flex align-items-center" aria-current="page">
                            <img src="{{ asset('imagges/Beranda.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Beranda 
                            <span  class="ms-5 fw-bold {{ request()->routeIs('home') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    {{-- @if(Auth::user()->peran=='admin') --}}
                    <li class="mb-2">
                        <a href="{{ route('user') }}" wire:navigate class="nav-link {{ request()->routeIs('user') ? 'active' : ''}} text-white d-flex align-items-center">
                            <img src="{{ asset('imagges/Petugas.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Petugas
                            <span  class="ms-5 fw-bold {{ request()->routeIs('user') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('produk') }}" wire:navigate class="nav-link {{ request()->routeIs('produk') ? 'active' : '' }} text-white d-flex align-items-center">
                            <img src="{{ asset('imagges/produk.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Produk
                            <span  class="ms-5 fw-bold {{ request()->routeIs('produk') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    {{-- @endif
                    @if(Auth::user()->peran=='kasir') --}}
                    <li class="mb-2">
                        <a href="{{ route('transaksi') }}" wire:navigate class="nav-link {{ request()->routeIs('transaksi') ? 'active' : '' }} text-white d-flex align-items-center">
                            <img src="{{ asset('imagges/Transaksi.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Transaksi
                            <span  class="ms-5 fw-bold {{ request()->routeIs('transaksi') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    {{-- @endif --}}
                    <li class="mb-2">
                        <a href="{{ route('laporan') }}" wire:navigate class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }} text-white d-flex align-items-center">
                            <img src="{{ asset('imagges/Laporan.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Laporan
                            <span  class="ms-5 fw-bold {{ request()->routeIs('laporan') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    {{-- @if(Auth::user()->peran=='kasir') --}}
                    <li>
                        <a href="{{ route('member') }}" wire:navigate class="nav-link {{ request()->routeIs('member') ? 'active' : '' }} text-white d-flex align-items-center" >
                            <img src="{{ asset('imagges/Member.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Member
                            <span  class="ms-5 fw-bold {{ request()->routeIs('member') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    {{-- @endif
                    @if(Auth::user()->peran=='admin') --}}
                    <li>
                        <a href="{{ route('riwayat') }}" wire:navigate class="nav-link {{ request()->routeIs('riwayat') ? 'active' : '' }} text-white d-flex align-items-center" >
                            <img src="{{ asset('imagges/Riwayat.svg') }}" alt="" class="me-2" style="width: 20px; height: auto;">
                            Riwayat
                            <span  class="ms-5 fw-bold {{ request()->routeIs('riwayat') ? 'text-white' : 'text-dark' }} "><</span>
                        </a>
                    </li>
                    {{-- @endif --}}
                </ul>
            </div>
            {{ $slot }} 
        </div>
    </div>
</body>
</html>
