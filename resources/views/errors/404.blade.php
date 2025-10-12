@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-6">
        <h1 class="text-6xl font-extrabold text-blue-600">404</h1>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">Halaman Tidak Ditemukan</h2>
        <p class="mt-2 text-gray-600 text-center max-w-md">
            Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.
        </p>
        <div class="mt-6">
            <a href="{{ url('/') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
