{{-- resources/views/partials/flash.blade.php --}}
@php
    $map = [
        'success' => [
            'wrap' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
            'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
            'title' => 'Berhasil',
        ],
        'error' => [
            'wrap' => 'bg-red-50 border-red-200 text-red-800',
            'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M4.93 4.93l14.14 14.14"/></svg>',
            'title' => 'Terjadi Kesalahan',
        ],
        'warning' => [
            'wrap' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
            'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>',
            'title' => 'Peringatan',
        ],
        'info' => [
            'wrap' => 'bg-blue-50 border-blue-200 text-blue-800',
            'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01"/></svg>',
            'title' => 'Info',
        ],
    ];
@endphp

{{-- Validation errors (opsional) --}}
@if ($errors->any())
    <div x-data="{ show: true }" x-show="show"
         class="mb-4 border rounded-lg p-4 {{ $map['error']['wrap'] }}">
        <div class="flex items-start gap-3">
            <div class="mt-0.5">{!! $map['error']['icon'] !!}</div>
            <div class="flex-1">
                <div class="font-semibold">{{ $map['error']['title'] }}</div>
                <ul class="list-disc ms-5 mt-1 space-y-0.5">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="show=false" class="ms-3 opacity-70 hover:opacity-100">✕</button>
        </div>
    </div>
@endif

@foreach (['success','error','warning','info'] as $type)
    @if (session($type))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=>show=false, 3500)"
             class="mb-4 border rounded-lg p-4 {{ $map[$type]['wrap'] }}">
            <div class="flex items-start gap-3">
                <div class="mt-0.5">{!! $map[$type]['icon'] !!}</div>
                <div class="flex-1">
                    <div class="font-semibold">{{ $map[$type]['title'] }}</div>
                    <p class="mt-0.5">{{ session($type) }}</p>
                </div>
                <button @click="show=false" class="ms-3 opacity-70 hover:opacity-100">✕</button>
            </div>
        </div>
    @endif
@endforeach
