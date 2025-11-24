<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "AUSAA'S LAUNDRY") }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-purple-900 text-white flex flex-col">
            <div class="p-6 flex items-center justify-center border-b border-purple-800">
                <h1 class="text-2xl font-bold tracking-wider">AUSAA'S <span class="text-pink-400">LAUNDRY</span></h1>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                @if(session('role') === 'owner')
                    <a href="{{ route('owner.dashboard') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('owner.dashboard') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('pembayaran.index') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('pembayaran.*') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Pembayaran
                    </a>
                    <a href="{{ route('owner.laporan') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('owner.laporan') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('pesanan.index') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('pesanan.*') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Data Pesanan
                    </a>
                    <a href="{{ route('cucian.index') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('cucian.*') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Status Cucian
                    </a>
                    <a href="{{ route('penyimpanan.index') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('penyimpanan.*') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Lokasi Penyimpanan
                    </a>
                    <a href="{{ route('pembayaran.index') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('pembayaran.*') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Pembayaran
                    </a>
                    <a href="{{ route('laporan') }}" class="flex items-center px-4 py-3 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors {{ request()->routeIs('laporan') ? 'bg-purple-800 text-pink-300' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan
                    </a>
                @endif
            </nav>

            <div class="p-4 border-t border-purple-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-100 hover:bg-purple-800 hover:text-pink-300 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-8 py-4">
                    <h2 class="text-xl font-semibold text-purple-900">
                        @yield('header')
                    </h2>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" class="w-64 py-2 pl-10 pr-4 bg-gray-100 border-none rounded-full focus:ring-2 focus:ring-purple-500 focus:bg-white transition-colors" placeholder="Search...">
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold">
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-gray-700 font-medium">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
