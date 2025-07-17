<div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300 group">
    <div class="text-center">
        <div
            class="mx-auto w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-200 transition duration-300">
            <div class="w-8 h-8 text-blue-600">
                {!! $icon !!}
            </div>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $title }}</h3>
        <p class="text-gray-600 mb-4">{{ $description }}</p>
        <a href=""
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-300">
            Selengkapnya
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>
