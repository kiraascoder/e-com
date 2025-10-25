@extends('layouts.app')

@section('title', '500 - Kesalahan Server')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-6">
        <h1 class="text-6xl font-extrabold text-red-700">500</h1>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">Kesalahan Server</h2>
        <p class="mt-2 text-gray-600 text-center max-w-md">
            Terjadi kesalahan pada server. Silakan coba beberapa saat lagi.
        </p>
        <div class="mt-6 flex gap-3">
            <a href="{{ url()->previous() }}" class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow">
                Kembali
            </a>
            <a href="{{ url('/') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Beranda
            </a>
        </div>
    </div>
@endsection
