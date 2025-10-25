@extends('layouts.app')

@section('title', '401 - Unauthorized')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-6">
        <h1 class="text-6xl font-extrabold text-red-600">401</h1>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">Tidak Memiliki Izin</h2>
        <p class="mt-2 text-gray-600 text-center max-w-md">
            Anda harus login atau tidak memiliki akses ke halaman ini.
        </p>
        <div class="mt-6">
            <a href="{{ url('/') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
