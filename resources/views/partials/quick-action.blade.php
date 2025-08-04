@php
    $link = $link ?? '#';
@endphp


<a href="{{ $link }}"
    class="group bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition duration-300">
    <div class="flex items-center">
        <div class="p-3 rounded-full {{ $bgColor }} group-hover:{{ $hoverColor }} transition duration-300">
            <div class="w-6 h-6 {{ $iconColor }}">
                {!! $icon !!}
            </div>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition duration-300">
                {{ $title }}</h3>
            <p class="text-sm text-gray-600">{{ $description }}</p>
        </div>
        <div class="ml-auto">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>
</a>
