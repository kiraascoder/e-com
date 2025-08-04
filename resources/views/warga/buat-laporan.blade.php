@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Buat Laporan Baru</h1>
                    <p class="mt-1 text-blue-100">Laporkan masalah infrastruktur di sekitar Anda</p>
                </div>
                <a href="{{ route('warga.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200">
            <form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" id="judul" name="judul" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Contoh: Jalan berlubang di depan SDN 01">
                </div>

                <!-- Alamat -->
                <div class="mb-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="2" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Alamat lengkap atau patokan yang jelas"></textarea>
                </div>
                
                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Masalah</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Jelaskan masalah secara detail, termasuk dampak yang ditimbulkan"></textarea>
                </div>

                <!-- Foto -->
                <div class="mb-6">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Pendukung</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="mt-4">
                            <label for="foto" class="cursor-pointer">
                                <span class="mt-2 block text-sm font-medium text-gray-900">Upload foto</span>
                                <span class="mt-1 block text-sm text-gray-500">PNG, JPG hingga 2MB</span>
                            </label>
                            <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Nama Pelapor -->
                <div class="mb-6">
                    <label for="nama_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelapor</label>
                    <input type="text" id="nama_pelapor" name="nama_pelapor" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Nama lengkap Anda">
                </div>

                <!-- Kontak Pelapor -->
                <div class="mb-6">
                    <label for="kontak_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Kontak Pelapor</label>
                    <input type="text" id="kontak_pelapor" name="kontak_pelapor" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="No HP atau email aktif">
                </div>

                <!-- Bidang -->
                <div class="mb-6">
                    <label for="bidang_id" class="block text-sm font-medium text-gray-700 mb-2">Bidang Terkait</label>
                    <select id="bidang_id" name="bidang_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        <option value="">Pilih Bidang</option>
                        @foreach ($bidangs as $bidang)
                            <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Laporan -->
                <div class="mb-6">
                    <label for="tanggal_laporan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                        Laporan</label>
                    <input type="date" id="tanggal_laporan" name="tanggal_laporan" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                </div>

                <!-- Submit -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('warga.dashboard') }}"
                        class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-300">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview foto
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'mt-4 max-w-xs h-32 object-cover rounded-lg border';

                    const container = document.querySelector('.border-dashed');
                    const existingPreview = container.querySelector('img');
                    if (existingPreview) existingPreview.remove();
                    container.appendChild(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
