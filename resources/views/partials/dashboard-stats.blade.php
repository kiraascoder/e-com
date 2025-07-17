<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
        <div class="p-3 rounded-full {{ $bgColor }} {{ $textColor }}">
            {!! $icon !!}
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
            @if (isset($subtitle))
                <p class="text-sm text-gray-500">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</div>
