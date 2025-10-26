{{-- resources/views/offline.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mode Offline — Dinas PU</title>

    {{-- Tailwind (gunakan yang sudah dibundle via Vite di layout utama jika ada) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="robots" content="noindex, nofollow">
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Logo placeholder -->
                <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur flex items-center justify-center">
                    <!-- Heroicon: Wrench -->
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317a4.5 4.5 0 006.364 6.364l3.536 3.536a2.121 2.121 0 11-3 3l-3.536-3.536a4.5 4.5 0 11-3.364-9.728z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold leading-tight">Dinas Pekerjaan Umum</h1>
                    <p class="text-blue-100 text-sm">Aplikasi Layanan & Pengaduan</p>
                </div>
            </div>

            <span class="inline-flex items-center gap-2 text-sm bg-white/10 px-3 py-1.5 rounded-lg">
                <span class="relative flex h-2.5 w-2.5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-300 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-yellow-400"></span>
                </span>
                Mode Offline
            </span>
        </div>
    </div>

    <!-- Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <!-- Heroicon: Cloud Off -->
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18M7 16a4 4 0 010-8c.338 0 .667.041.985.12A6 6 0 0119 11h1a3 3 0 010 6H9m-2 0h12" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">Koneksi terputus</h2>
                        <p class="mt-2 text-gray-600">
                            Anda sedang offline. Beberapa fitur tidak tersedia. Data yang sudah tersimpan di perangkat
                            tetap bisa dibuka.
                        </p>

                        <!-- Tindakan cepat -->
                        <div class="mt-6 flex flex-wrap gap-3">
                            <button id="btn-retry"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                                <!-- Heroicon: Arrow Path -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v6h6M20 20v-6h-6M20 8a8 8 0 10-7.446 7.955M4 16a8 8 0 007.446-7.955" />
                                </svg>
                                Coba Sambungkan
                            </button>

                            <a href="{{ url('/') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                <!-- Heroicon: Home -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v7m-6 0h12a2 2 0 002-2v-5a2 2 0 00-.586-1.414l-7-7a2 2 0 00-2.828 0l-7 7A2 2 0 002 12v5a2 2 0 002 2z" />
                                </svg>
                                Kembali ke Beranda
                            </a>

                            {{-- Opsional: link ke halaman cached yang penting --}}
                            <a href="{{ route('laporan.index', [], false) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-gray-200 text-gray-800 hover:bg-gray-50">
                                <!-- Heroicon: Clipboard List -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5h6M9 7h6m-9 4h12M9 15h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                </svg>
                                Daftar Laporan
                            </a>
                        </div>

                        <!-- Info sinkronisasi -->
                        <div class="mt-8 grid sm:grid-cols-3 gap-4">
                            <div class="p-4 rounded-xl border border-gray-200">
                                <p class="text-xs uppercase tracking-wide text-gray-500">Status</p>
                                <p class="mt-1 font-medium text-gray-900">Offline</p>
                            </div>
                            <div class="p-4 rounded-xl border border-gray-200">
                                <p class="text-xs uppercase tracking-wide text-gray-500">Terakhir sinkron</p>
                                <p id="last-sync" class="mt-1 font-medium text-gray-900">—</p>
                            </div>
                            <div class="p-4 rounded-xl border border-gray-200">
                                <p class="text-xs uppercase tracking-wide text-gray-500">Cache lokal</p>
                                <p id="cache-usage" class="mt-1 font-medium text-gray-900">Memuat…</p>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mt-6 bg-blue-50 border border-blue-200 text-blue-900 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <!-- Heroicon: Information Circle -->
                                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                </svg>
                                <p class="text-sm">
                                    Beberapa halaman dan aset mungkin tersedia berkat cache PWA. Saat koneksi kembali,
                                    halaman ini akan mencoba memuat ulang otomatis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="mt-10 border-t border-gray-200 pt-6 text-sm text-gray-500 flex items-center justify-between">
                    <span>© {{ now()->year }} Dinas Pekerjaan Umum — Kota Parepare</span>
                    <span id="reconnect-status" class="hidden text-emerald-700">Koneksi kembali! Memuat ulang…</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Tampilkan waktu sinkron terakhir jika Anda menyimpannya di localStorage pada saat sukses submit/fetch
        (function() {
            const lastSync = localStorage.getItem('pu:last_sync_at');
            document.getElementById('last-sync').textContent = lastSync || 'Belum ada';

            // Perkiraan pemakaian storage (tidak semua browser mendukung)
            if (navigator.storage && navigator.storage.estimate) {
                navigator.storage.estimate().then(({
                    usage,
                    quota
                }) => {
                    if (usage && quota) {
                        const percent = Math.round((usage / quota) * 100);
                        document.getElementById('cache-usage').textContent =
                            `${(usage/1024/1024).toFixed(1)} MB dari ${(quota/1024/1024).toFixed(1)} MB (${percent}%)`;
                    } else {
                        document.getElementById('cache-usage').textContent = '—';
                    }
                }).catch(() => {
                    document.getElementById('cache-usage').textContent = '—';
                });
            } else {
                document.getElementById('cache-usage').textContent = '—';
            }
        })();

        // Tombol "Coba Sambungkan"
        document.getElementById('btn-retry').addEventListener('click', () => {
            window.location.reload();
        });

        // Auto-reconnect: ping kecil tiap 3 detik; saat online, reload
        (function autoReconnect() {
            const indicator = document.getElementById('reconnect-status');
            const tryPing = async () => {
                if (!navigator.onLine) return; // masih offline
                try {
                    // ping lightweight; sesuaikan jika punya route khusus, mis. /healthz
                    const res = await fetch('/', {
                        method: 'HEAD',
                        cache: 'no-store'
                    });
                    if (res.ok) {
                        indicator.classList.remove('hidden');
                        setTimeout(() => window.location.reload(), 800);
                    }
                } catch (_) {
                    /* tetap diam */ }
            };
            setInterval(tryPing, 3000);
        })();
    </script>
</body>

</html>
