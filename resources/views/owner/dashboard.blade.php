@extends('layouts.app')

@section('header', 'Dashboard Owner')

@section('content')
<div class="mb-8">
    <h3 class="text-2xl font-bold text-gray-800">Selamat Datang, Owner</h3>
    <p class="text-gray-600 mt-2">Kelola dan pantau bisnis laundry Anda</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Total Pendapatan</h3>
            <div class="p-2 bg-purple-50 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-800">Rp 0</h2>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Total Pesanan</h3>
            <div class="p-2 bg-pink-50 rounded-lg">
                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-800">0</h2>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Bulan Ini</h3>
            <div class="p-2 bg-green-50 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-800">Rp 0</h2>
    </div>
</div>

<div class="mt-8">
    <a href="{{ route('owner.laporan') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors shadow-md">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Lihat Laporan Lengkap
    </a>
</div>
@endsection
