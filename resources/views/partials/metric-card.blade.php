<div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-300">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $value }}</p>
            @if (isset($subtitle))
                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
            @if (isset($trend))
                <div class="flex items-center mt-2">
                    @if ($trend['positive'])
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 17l9.5-9.5M7 7h10v10"></path>
                        </svg>
                        <span class="text-sm text-green-600 font-medium">{{ $trend['value'] }}</span>
                    @else
                        <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17l-9.5-9.5M17 7H7v10"></path>
                        </svg>
                        <span class="text-sm text-red-600 font-medium">{{ $trend['value'] }}</span>
                    @endif
                    <span class="text-sm text-gray-500 ml-1">{{ $trend['label'] }}</span>
                </div>
            @endif
        </div>
        <div class="p-3 rounded-full {{ $bgColor }} ml-4">
            <div class="w-8 h-8 {{ $iconColor }}">
                {!! $icon !!}
            </div>
        </div>
    </div>
</div>
