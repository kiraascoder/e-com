{{-- resources/views/components/pwa-install-button.blade.php --}}
@props([
    'label' => 'Install Aplikasi',
])

<button id="btn-install-pwa" type="button"
    class="hidden inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600">
    {{-- Icon: Download --}}
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
    </svg>
    <span>{{ $label }}</span>
</button>

{{-- iOS hint (ditampilkan hanya di iOS, via JS) --}}
<button id="btn-ios-instructions" type="button"
    class="hidden inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
    {{-- Icon: Share --}}
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            d="M4 12v7a1 1 0 001 1h14a1 1 0 001-1v-7M16 6l-4-4m0 0L8 6m4-4v14" />
    </svg>
    <span>Install via “Share → Add to Home Screen”</span>
</button>
