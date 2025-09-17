<div class="bg-gradient-to-r {{ $bgGradient ?? 'from-blue-600 to-blue-800' }} text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">

            <!-- Left: Greeting & Role -->
            <div>
                <div class="flex items-center mb-3">
                    <div class="p-2 bg-white/20 rounded-lg mr-3 flex items-center justify-center">
                        {!! $roleIcon ?? '' !!}
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                            {{ $greeting ?? 'Selamat Datang' }}
                        </h1>
                        <p class="text-sm opacity-90">
                            {{ $roleTitle ?? 'Pengguna Sistem' }}
                        </p>
                    </div>
                </div>
                @if (!empty($description))
                    <p class="mt-1 text-blue-100 text-sm md:text-base">
                        {{ $description }}
                    </p>
                @endif
            </div>

            <!-- Right: Date & Badge -->
            <div class="mt-4 md:mt-0 text-right">
                <div class="flex items-center justify-start md:justify-end text-blue-100">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-medium">{{ now()->translatedFormat('d F Y') }}</span>
                </div>

                @if (!empty($badgeText))
                    <div class="mt-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">
                            {{ $badgeText }}
                        </span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
