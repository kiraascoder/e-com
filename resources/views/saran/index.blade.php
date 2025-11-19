@extends('layouts.app')

@section('title', 'Saran & Masukan')

@section('content')
    @include('partials.flash')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-24">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Saran & Masukan Masyarakat
                </h1>
                <p class="text-lg md:text-xl text-blue-100 mb-8">
                    Sampaikan saran, kritik, dan apresiasi Anda untuk meningkatkan kualitas pelayanan
                    Dinas Pekerjaan Umum.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                        Kembali ke Beranda
                    </a>

                    <a href="{{ route('warga.buat.laporan') }}"
                        class="border-2 border-white text-white hover:bg-white hover:text-blue-800 px-8 py-3 rounded-lg font-semibold transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                        Laporkan Masalah Infrastruktur
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Saran Section -->
    <section class="py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-start">
                <!-- Info -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Kami mendengar dan menghargai setiap masukan Anda
                    </h2>
                    <p class="text-gray-600 mb-6">
                        Saran dan masukan Anda sangat penting untuk membantu kami:
                    </p>

                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 mt-1">
                                <span
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 text-blue-600">
                                    1
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Meningkatkan kualitas pelayanan</h3>
                                <p class="text-gray-600 text-sm">
                                    Kami dapat mengevaluasi dan memperbaiki prosedur kerja berdasarkan masukan langsung dari
                                    masyarakat.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="flex-shrink-0 mt-1">
                                <span
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-green-100 text-green-600">
                                    2
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Memperbaiki sistem dan infrastruktur</h3>
                                <p class="text-gray-600 text-sm">
                                    Saran terkait sistem aplikasi, proses pelaporan, atau infrastruktur akan kami
                                    tindaklanjuti secara berkala.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="flex-shrink-0 mt-1">
                                <span
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-yellow-100 text-yellow-600">
                                    3
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Membangun pelayanan yang transparan</h3>
                                <p class="text-gray-600 text-sm">
                                    Dengan adanya kanal saran resmi, masyarakat dapat menyampaikan pendapatnya secara jelas
                                    dan terdokumentasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 p-4 rounded-xl bg-white shadow-sm border border-blue-100">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold text-gray-800">Catatan:</span> Anda dapat mengisi saran secara
                            anonim.
                            Namun, jika menginginkan tindak lanjut dari petugas, mohon sertakan kontak yang dapat dihubungi.
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <div>
                    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                            Formulir Saran & Masukan
                        </h3>

                        <form action="{{ route('saran.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Lengkap <span class="text-gray-400 text-xs">(opsional)</span>
                                    </label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    @error('nama')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nomor HP / Email <span class="text-gray-400 text-xs">(opsional)</span>
                                    </label>
                                    <input type="text" name="kontak" id="kontak" value="{{ old('kontak') }}"
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="Contoh: 0812xxxx / email@contoh.com">
                                    @error('kontak')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                                    Kategori Saran
                                </label>
                                <select name="kategori" id="kategori"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="pelayanan" {{ old('kategori') == 'pelayanan' ? 'selected' : '' }}>
                                        Pelayanan Petugas
                                    </option>
                                    <option value="infrastruktur"
                                        {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>
                                        Infrastruktur / Fisik
                                    </option>
                                    <option value="sistem" {{ old('kategori') == 'sistem' ? 'selected' : '' }}>
                                        Sistem Aplikasi / Website
                                    </option>
                                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('kategori')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                                    Judul Saran
                                </label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    placeholder="Ringkasan singkat saran Anda">
                                @error('judul')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="isi_saran" class="block text-sm font-medium text-gray-700 mb-1">
                                    Isi Saran / Masukan
                                </label>
                                <textarea name="isi_saran" id="isi_saran" rows="5"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    placeholder="Tuliskan saran, kritik, atau masukan Anda secara jelas dan sopan...">{{ old('isi_saran') }}</textarea>
                                @error('isi_saran')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <span class="block text-sm font-medium text-gray-700 mb-1">
                                    Tingkat Kepuasan Anda terhadap Pelayanan
                                </span>
                                <p class="text-xs text-gray-500 mb-2">
                                    1 = sangat tidak puas, 5 = sangat puas
                                </p>
                                <div class="flex items-center justify-between gap-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="flex-1">
                                            <input type="radio" name="kepuasan" value="{{ $i }}"
                                                class="peer sr-only" {{ old('kepuasan') == $i ? 'checked' : '' }}>
                                            <div
                                                class="flex flex-col items-center justify-center py-2 border rounded-lg text-xs cursor-pointer
                                                       text-gray-600 border-gray-300
                                                       peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-600">
                                                <span class="font-semibold">{{ $i }}</span>
                                                @if ($i == 1)
                                                    <span>Sangat<br>Tidak Puas</span>
                                                @elseif($i == 2)
                                                    <span>Tidak<br>Puas</span>
                                                @elseif($i == 3)
                                                    <span>Cukup</span>
                                                @elseif($i == 4)
                                                    <span>Puas</span>
                                                @else
                                                    <span>Sangat<br>Puas</span>
                                                @endif
                                            </div>
                                        </label>
                                    @endfor
                                </div>
                                @error('kepuasan')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-start gap-2">
                                <input id="follow_up" name="follow_up" type="checkbox" value="1"
                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    {{ old('follow_up') ? 'checked' : '' }}>
                                <label for="follow_up" class="text-sm text-gray-700">
                                    Saya bersedia dihubungi kembali oleh petugas terkait saran ini.
                                </label>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Kirim Saran
                                </button>
                            </div>
                        </form>
                    </div>

                    <p class="mt-4 text-xs text-gray-500 text-center">
                        Data saran akan direkap dan dijadikan bahan evaluasi berkala oleh Dinas Pekerjaan Umum.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp -->
    <div id="wa-button"
        class="fixed bottom-24 right-6 z-50 hidden opacity-0 scale-95 transform transition duration-200 ease-out">
        <a href="https://wa.me/6281141007777?text=Lapor%20Pak%20Wali" target="_blank" rel="noopener"
            class="flex items-center gap-2 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M20.52 3.48A11.76 11.76 0 0012 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.26-1.62A11.76 11.76 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22a9.83 9.83 0 01-5-1.35l-.36-.21-3.71.96.99-3.61-.23-.37A9.83 9.83 0 012 12C2 6.48 6.48 2 12 2c2.64 0 5.14 1.03 7.03 2.92A9.9 9.9 0 0122 12c0 5.52-4.48 10-10 10zm5.06-7.69c-.27-.13-1.61-.79-1.86-.88-.25-.09-.43-.13-.61.13-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.13-1.14-.42-2.17-1.33-.8-.71-1.33-1.59-1.48-1.86-.16-.27-.02-.42.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.13-.61-1.47-.83-2.02-.22-.52-.44-.45-.61-.46h-.52c-.18 0-.48.07-.73.34-.25.27-.95.93-.95 2.26s.97 2.63 1.1 2.81c.14.18 1.91 2.91 4.63 4.08.65.28 1.16.45 1.56.57.65.21 1.24.18 1.71.11.52-.08 1.61-.66 1.84-1.3.23-.64.23-1.19.16-1.3-.07-.11-.25-.18-.52-.3z" />
            </svg>
            <span class="hidden md:inline">Chat WA</span>
            <span class="sr-only">Buka WhatsApp</span>
        </a>
    </div>

    <!-- Toggle FAB -->
    <button id="toggle-wa" type="button" aria-expanded="false" aria-controls="wa-button"
        class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg z-50 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path id="toggle-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M16.65 9.35a7 7 0 11-9.9 9.9 7 7 0 019.9-9.9z" />
        </svg>
        <span class="sr-only">Tampilkan/sembunyikan tombol WhatsApp</span>
    </button>
@endsection

@push('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Mobile menu toggle (guard agar tidak error jika elemen tidak ada)
        (function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => menu.classList.toggle('hidden'));
            }
        })();

        // WhatsApp toggle logic
        (function() {
            const waButton = document.getElementById('wa-button');
            const toggleWa = document.getElementById('toggle-wa');
            const togglePath = document.getElementById('toggle-icon-path');

            if (!waButton || !toggleWa || !togglePath) return;

            let isShown = false;

            const showWA = () => {
                isShown = true;
                waButton.classList.remove('hidden', 'opacity-0', 'scale-95');
                waButton.classList.add('opacity-100', 'scale-100');
                toggleWa.setAttribute('aria-expanded', 'true');
                togglePath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            };

            const hideWA = () => {
                isShown = false;
                waButton.classList.add('opacity-0', 'scale-95');
                toggleWa.setAttribute('aria-expanded', 'false');
                togglePath.setAttribute('d',
                    'M21 21l-4.35-4.35M16.65 9.35a7 7 0 11-9.9 9.9 7 7 0 019.9-9.9z'
                );
                setTimeout(() => {
                    if (!isShown) waButton.classList.add('hidden');
                }, 180);
            };

            hideWA();

            toggleWa.addEventListener('click', () => {
                if (isShown) hideWA();
                else showWA();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && isShown) hideWA();
            });

            const media = window.matchMedia('(prefers-reduced-motion: reduce)');
            if (media.matches) {
                waButton.classList.remove('transition', 'duration-200');
            }
        })();
    </script>
@endpush
