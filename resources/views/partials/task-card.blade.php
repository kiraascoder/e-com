<div class="bg-white rounded-lg shadow border border-gray-200 p-6">
    <div class="flex items-start justify-between mb-4">
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-900">{{ $task['title'] }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ $task['description'] }}</p>
        </div>
        @php
            $priorityColors = [
                'high' => 'bg-red-100 text-red-800',
                'medium' => 'bg-yellow-100 text-yellow-800',
                'low' => 'bg-green-100 text-green-800',
            ];
            $statusColors = [
                'pending' => 'bg-gray-100 text-gray-800',
                'in_progress' => 'bg-blue-100 text-blue-800',
                'completed' => 'bg-green-100 text-green-800',
                'overdue' => 'bg-red-100 text-red-800',
            ];
        @endphp
        <div class="flex flex-col space-y-2 ml-4">
            <span
                class="px-2 py-1 text-xs font-medium rounded-full {{ $priorityColors[$task['priority']] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($task['priority']) }} Priority
            </span>
            <span
                class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$task['status']] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst(str_replace('_', ' ', $task['status'])) }}
            </span>
        </div>
    </div>

    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
        <div class="flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Deadline: {{ $task['deadline'] }}
        </div>
        @if (isset($task['team']))
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                {{ $task['team'] }}
            </div>
        @endif
    </div>

    @if (isset($task['progress']))
        <div class="mb-4">
            <div class="flex justify-between items-center mb-1">
                <span class="text-xs text-gray-600">Progress</span>
                <span class="text-xs text-gray-600">{{ $task['progress'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $task['progress'] }}%"></div>
            </div>
        </div>
    @endif

    <div class="flex space-x-2">
        <a href="{{ $task['detail_url'] ?? '#' }}"
            class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md transition duration-300">
            Detail
        </a>
        @if ($task['status'] !== 'completed')
            <a href="{{ $task['update_url'] ?? '#' }}"
                class="text-sm bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-md transition duration-300">
                Update
            </a>
        @endif
    </div>
</div>
