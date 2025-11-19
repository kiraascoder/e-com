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
                <a href="{{ route('home') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200">
            @if (session('success'))
                <div class="mb-4 p-4 rounded-md bg-green-100 border border-green-300 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 rounded-md bg-red-100 border border-red-300 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-md bg-red-50 border border-red-200 text-red-800">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Contoh: Jalan berlubang di depan SDN 01">
                    @error('judul')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori & Tingkat Kerusakan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="kategori_fasilitas" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori Fasilitas
                        </label>
                        <select id="kategori_fasilitas" name="kategori_fasilitas" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                            <option value="">Pilih kategori</option>
                            @foreach (['jalan', 'trotoar', 'lampu_jalan', 'taman_kota', 'saluran_air', 'lainnya'] as $k)
                                <option value="{{ $k }}" @selected(old('kategori_fasilitas') === $k)>
                                    {{ Str::of($k)->replace('_', ' ')->headline() }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_fasilitas')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input tambahan jika pilih "lainnya" --}}
                    <div id="input_lainnya_wrapper" class="hidden">
                        <label for="kategori_lainnya" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori Lainnya
                        </label>
                        <input type="text" id="kategori_lainnya" name="kategori_lainnya"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                            value="{{ old('kategori_lainnya') }}">
                        @error('kategori_lainnya')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Jenis Kerusakan -->
                <div class="mb-6">
                    <label for="jenis_kerusakan" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Kerusakan (opsional)
                    </label>
                    <input type="text" id="jenis_kerusakan" name="jenis_kerusakan" value="{{ old('jenis_kerusakan') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Contoh: berlubang, retak, lampu mati, tersumbat">
                    @error('jenis_kerusakan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat & Wilayah -->
                <div class="mb-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="2" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Alamat lengkap atau patokan yang jelas">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Kecamatan (opsional)
                        </label>
                        <select id="kecamatan" name="kecamatan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                            <option value="">Pilih Kecamatan</option>
                            @foreach (['Bacukiki', 'Bacukiki Barat', 'Soreang', 'Ujung'] as $kcm)
                                <option value="{{ $kcm }}" @selected(old('kecamatan') === $kcm)>{{ $kcm }}
                                </option>
                            @endforeach
                        </select>
                        @error('kecamatan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-2">
                            Kelurahan (opsional)
                        </label>
                        <select id="kelurahan" name="kelurahan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500" disabled>
                            <option value="">Pilih Kelurahan</option>
                        </select>
                        @error('kelurahan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        {{-- Opsional: simpan kodepos otomatis jika ingin dipakai di backend --}}
                        <input type="hidden" id="kodepos" name="kodepos" value="">
                    </div>
                </div>


                <!-- Koordinat -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude
                            (opsional)</label>
                        <input type="number" step="any" id="latitude" name="latitude" value="{{ old('latitude') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                            placeholder="-4.012345">
                        @error('latitude')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude
                            (opsional)</label>
                        <input type="number" step="any" id="longitude" name="longitude"
                            value="{{ old('longitude') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                            placeholder="119.623456">
                        @error('longitude')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-6">
                    <button type="button" id="btn-auto-location"
                        class="px-3 py-2 text-sm border rounded-md hover:bg-gray-50">
                        Gunakan lokasi saya
                    </button>
                    <p class="text-xs text-gray-500 mt-2">Lokasi membantu petugas menemukan titik kerusakan lebih cepat.
                    </p>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Masalah</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                        placeholder="Jelaskan masalah secara detail, termasuk dampak yang ditimbulkan">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto Utama -->
                <div class="mb-6">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Pendukung
                        (utama)</label>
                    <input id="foto" name="foto" type="file" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG/WebP, ukuran maks 5 MB.</p>
                    @error('foto')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div id="foto-preview" class="mt-3"></div>
                </div>
                <!-- Data Pelapor & Anonim -->
                <div class="mb-6">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" id="is_anonim" name="is_anonim" value="1"
                            @checked(old('is_anonim')) class="rounded">
                        <span class="text-sm text-gray-700">Kirim sebagai anonim</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6" id="identitas-pelapor">
                    <div>
                        <label for="nama_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Nama
                            Pelapor</label>
                        <input type="text" id="nama_pelapor" name="nama_pelapor"
                            value="{{ old('nama_pelapor', auth()->check() ? auth()->user()->name : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                            placeholder="Nama lengkap Anda">
                        @error('nama_pelapor')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kontak_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Kontak Pelapor
                            (opsional)</label>
                        <input type="text" id="kontak_pelapor" name="kontak_pelapor"
                            value="{{ old('kontak_pelapor') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500"
                            placeholder="No HP atau email aktif">
                        @error('kontak_pelapor')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Bidang -->
                <div class="mb-6">
                    <label for="bidang_id" class="block text-sm font-medium text-gray-700 mb-2">Bidang Terkait</label>
                    <select id="bidang_id" name="bidang_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        <option value="">Pilih Bidang</option>
                        @foreach ($bidangs as $bidang)
                            <option value="{{ $bidang->id }}" @selected(old('bidang_id') == $bidang->id)>
                                {{ $bidang->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('bidang_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('home') }}"
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
        // Toggle anonim: jika anonim, kosongkan & disable nama/kontak
        const chkAnonim = document.getElementById('is_anonim');
        const namaPelapor = document.getElementById('nama_pelapor');
        const kontakPelapor = document.getElementById('kontak_pelapor');
        const identitasWrap = document.getElementById('identitas-pelapor');

        function applyAnonimState() {
            const isAnon = chkAnonim.checked;
            if (isAnon) {
                namaPelapor.value = '';
                kontakPelapor.value = '';
                namaPelapor.setAttribute('disabled', 'disabled');
                kontakPelapor.setAttribute('disabled', 'disabled');
                identitasWrap.classList.add('opacity-50');
            } else {
                namaPelapor.removeAttribute('disabled');
                kontakPelapor.removeAttribute('disabled');
                identitasWrap.classList.remove('opacity-50');
            }
        }
        chkAnonim.addEventListener('change', applyAnonimState);
        applyAnonimState();

        // Preview Foto Utama
        document.getElementById('foto').addEventListener('change', function(e) {
            const container = document.getElementById('foto-preview');
            container.innerHTML = '';
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'mt-2 max-w-xs h-32 object-cover rounded-lg border';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });

        // Ambil lokasi otomatis (opsional)
        document.getElementById('btn-auto-location').addEventListener('click', function() {
            if (!navigator.geolocation) {
                alert('Browser Anda tidak mendukung geolokasi.');
                return;
            }
            navigator.geolocation.getCurrentPosition(function(pos) {
                document.getElementById('latitude').value = pos.coords.latitude.toFixed(6);
                document.getElementById('longitude').value = pos.coords.longitude.toFixed(6);
            }, function(err) {
                alert('Gagal mendapatkan lokasi: ' + err.message);
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("kategori_fasilitas");
            const inputWrapper = document.getElementById("input_lainnya_wrapper");

            function toggleInput() {
                if (select.value === "lainnya") {
                    inputWrapper.classList.remove("hidden");
                } else {
                    inputWrapper.classList.add("hidden");
                }
            }

            // Jalankan saat halaman pertama kali dimuat
            toggleInput();

            // Jalankan ketika user mengubah pilihan
            select.addEventListener("change", toggleInput);
        });
        const WILAYAH = {
            "Bacukiki": [{
                    nama: "Lemoe",
                    kodepos: "91121"
                },
                {
                    nama: "Wattang Bacukiki",
                    kodepos: "91121"
                },
                {
                    nama: "Lompoe",
                    kodepos: "91125"
                },
            ],
            "Bacukiki Barat": [{
                    nama: "Bumi Harapan",
                    kodepos: "91121"
                },
                {
                    nama: "Kampung Baru",
                    kodepos: "91121"
                },
                {
                    nama: "Sumpang Minangae",
                    kodepos: "91121"
                },
                {
                    nama: "Cappagalung",
                    kodepos: "91122"
                },
                {
                    nama: "Lumpue",
                    kodepos: "91123"
                },
                {
                    nama: "Tiro Sompe",
                    kodepos: "91125"
                },
                {
                    nama: "Galung Maloang",
                    kodepos: "91126"
                },
            ],
            "Soreang": [{
                    nama: "Bukit Harapan",
                    kodepos: "91131"
                },
                {
                    nama: "Bukit Indah",
                    kodepos: "91131"
                },
                {
                    nama: "Kampung Pisang",
                    kodepos: "91131"
                },
                {
                    nama: "Ujung Baru",
                    kodepos: "91131"
                },
                {
                    nama: "Ujung Lare",
                    kodepos: "91131"
                },
                {
                    nama: "Wattang Soreang",
                    kodepos: "91132"
                },
                {
                    nama: "Lakessi",
                    kodepos: "91133"
                },
            ],
            "Ujung": [{
                    nama: "Labukkang",
                    kodepos: "91111"
                },
                {
                    nama: "Mallusetasi",
                    kodepos: "91111"
                },
                {
                    nama: "Lapadde",
                    kodepos: "91112"
                },
                {
                    nama: "Ujung Bulu",
                    kodepos: "91113"
                },
                {
                    nama: "Ujung Sabbang",
                    kodepos: "91114"
                },
            ],
        };

        // ====== Elemen ======
        const kecSelect = document.getElementById('kecamatan');
        const kelSelect = document.getElementById('kelurahan');
        const kodeposInput = document.getElementById('kodepos');

        // ====== Helper: isi opsi kelurahan berdasarkan kecamatan ======
        function populateKelurahan(kecamatan, oldKelurahan = '') {
            kelSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            if (!kecamatan || !WILAYAH[kecamatan]) {
                kelSelect.disabled = true;
                kodeposInput.value = '';
                return;
            }

            WILAYAH[kecamatan].forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.nama;
                opt.textContent = item.nama;
                opt.dataset.kodepos = item.kodepos;
                if (oldKelurahan && oldKelurahan === item.nama) {
                    opt.selected = true;
                    kodeposInput.value = item.kodepos;
                }
                kelSelect.appendChild(opt);
            });

            // Aktifkan select
            kelSelect.disabled = false;

            // Jika belum ada pilihan (tidak ada old kelurahan), kosongkan kodepos
            if (!oldKelurahan) {
                kodeposInput.value = '';
            }
        }

        // ====== Event: saat kecamatan berubah ======
        kecSelect.addEventListener('change', function() {
            populateKelurahan(this.value);
        });

        // ====== Event: saat kelurahan berubah, set kodepos tersembunyi (opsional) ======
        kelSelect.addEventListener('change', function() {
            const kodepos = this.selectedOptions[0]?.dataset?.kodepos || '';
            kodeposInput.value = kodepos;
        });

        // ====== Inisialisasi saat halaman dimuat (repopulate dari old()) ======
        document.addEventListener('DOMContentLoaded', function() {
            const oldKecamatan = @json(old('kecamatan'));
            const oldKelurahan = @json(old('kelurahan'));
            if (oldKecamatan) {
                populateKelurahan(oldKecamatan, oldKelurahan || '');
            }
        });
    </script>
@endpush
