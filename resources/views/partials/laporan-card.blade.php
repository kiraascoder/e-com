<div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">{{ $laporan['judul'] }}</h3>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'diterima' => 'bg-blue-100 text-blue-800',
                    'selesai' => 'bg-green-100 text-green-800',
                    'ditolak' => 'bg-red-100 text-red-800',
                ];
                $statusText = [
                    'pending' => 'Menunggu',
                    'diterima' => 'Selesai',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                ];
            @endphp
            <span
                class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$laporan['status_verifikasi']] ?? 'bg-gray-100 text-gray-800' }}">
                {{ $statusText[$laporan['status_verifikasi']] ?? 'Unknown' }}
            </span>
        </div>

        <p class="text-gray-600 mb-4">{{ Str::limit($laporan['deskripsi'], 100) }}</p>

        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                {{ $laporan['created_at'] }}
            </div>
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                {{ $laporan->bidang->nama ?? 'Belum ditentukan' }}
            </div>
        </div>

        <div class="mt-4 flex space-x-2">
            <a href="{{ route('warga.laporan.show', $laporan['id']) }}"
                class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md transition duration-300">
                Detail
            </a>            
        </div>
    </div>
</div>
