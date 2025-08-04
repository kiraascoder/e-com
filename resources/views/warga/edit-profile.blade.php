@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Edit Profile</h1>
                    <p class="mt-1 text-blue-100">Perbarui informasi pribadi Anda</p>
                </div>
                <a href="{{ route('warga.dashboard') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Profile Picture Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="text-center">
                        <div class="relative inline-block">
                            <img class="w-32 h-32 rounded-full object-cover border-4 border-blue-100"
                                src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama ?? 'User') . '&color=7c3aed&background=ede9fe' }}"
                                alt="Profile Picture">
                            <button
                                class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-whitee p-2 rounded-full  transition duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">{{ Auth::user()->nama ?? 'Nama User' }}</h3>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email ?? 'email@example.com' }}</p>

                        <div class="mt-6">
                            <input type="file" id="avatar" name="avatar" class="sr-only" accept="image/*">
                            <label for="avatar"
                                class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-300">
                                Ganti Foto
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Account Stats -->
                <div class="mt-6 bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Statistik Akun</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Laporan</span>
                            <span class="font-medium">12</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Laporan Selesai</span>
                            <span class="font-medium text-green-600">8</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Bergabung Sejak</span>
                            <span class="font-medium">Jan 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">Informasi Pribadi</h3>

                            <!-- Nama Lengkap -->
                            <div class="mb-6">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="nama" name="nama"
                                    value="{{ old('nama', Auth::user()->nama ?? 'John Doe') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Email -->
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email ?? 'john@example.com') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="mb-6">
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                    Telepon</label>
                                <input type="tel" id="telepon" name="telepon"
                                    value="{{ old('telepon', Auth::user()->telepon ?? '081234567890') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="081234567890">
                            </div>

                            <!-- Alamat -->
                            <div class="mb-6">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea id="alamat" name="alamat" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat', Auth::user()->alamat ?? 'Jl. Contoh No. 123, Kota') }}</textarea>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                        Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir ?? '1990-01-01') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                                        Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L"
                                            {{ old('jenis_kelamin', Auth::user()->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ old('jenis_kelamin', Auth::user()->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="border-t border-gray-200 p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">Ubah Password</h3>
                            <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah password</p>

                            <div class="space-y-4">
                                <div>
                                    <label for="current_password"
                                        class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                        Baru</label>
                                    <input type="password" id="password" name="password"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="border-t border-gray-200 p-6">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('warga.dashboard') }}"
                                    class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-300">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview avatar yang diupload
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Validasi password confirmation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;

            if (password !== confirmation && confirmation !== '') {
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
@endpush
