@extends('layouts.app')

@section('title', '403 - Forbidden')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-6">
        <h1 class="text-6xl font-extrabold text-yellow-500">403</h1>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">Akses Ditolak</h2>
        <p class="mt-2 text-gray-600 text-center max-w-md">
            Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>
        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Kembali
            </a>
        </div>
    </div>
@endsection
