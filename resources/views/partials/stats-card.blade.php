@php
    $colorClasses = [
        'blue' => 'bg-blue-500 text-blue-600 border-blue-200',
        'green' => 'bg-green-500 text-green-600 border-green-200',
        'yellow' => 'bg-yellow-500 text-yellow-600 border-yellow-200',
        'red' => 'bg-red-500 text-red-600 border-red-200',
        'purple' => 'bg-purple-500 text-purple-600 border-purple-200',
    ];
@endphp

<div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-600 mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900">{{ $value }}</p>
            @if (isset($trend))
                <p class="text-sm {{ $trend['positive'] ? 'text-green-600' : 'text-red-600' }} mt-1">
                    {{ $trend['value'] }} {{ $trend['label'] }}
                </p>
            @endif
        </div>
        <div class="p-3 rounded-full {{ explode(' ', $colorClasses[$color])[0] }} bg-opacity-20">
            <div class="w-8 h-8 {{ explode(' ', $colorClasses[$color])[1] }}">
                {!! $icon !!}
            </div>
        </div>
    </div>
</div>
