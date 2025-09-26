@if (session('success') || session('error') || session('warning') || session('info'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6"
    >
        @if (session('success'))
            <div class="flex items-center justify-between rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
                <span class="font-medium">{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900">
                    ✕
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center justify-between rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3 shadow">
                <span class="font-medium">{{ session('error') }}</span>
                <button @click="show = false" class="ml-4 text-red-700 hover:text-red-900">
                    ✕
                </button>
            </div>
        @endif

        @if (session('warning'))
            <div class="flex items-center justify-between rounded-lg bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 shadow">
                <span class="font-medium">{{ session('warning') }}</span>
                <button @click="show = false" class="ml-4 text-yellow-700 hover:text-yellow-900">
                    ✕
                </button>
            </div>
        @endif

        @if (session('info'))
            <div class="flex items-center justify-between rounded-lg bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 shadow">
                <span class="font-medium">{{ session('info') }}</span>
                <button @click="show = false" class="ml-4 text-blue-700 hover:text-blue-900">
                    ✕
                </button>
            </div>
        @endif
    </div>
@endif
