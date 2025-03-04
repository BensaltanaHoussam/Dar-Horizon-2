@props(['notifications'])

<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative p-2 text-white hover:text-gray-200 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute -top-1 -right-1 bg-white text-black rounded-full w-5 h-5 text-xs flex items-center justify-center">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" 
        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-100">
        @forelse($notifications as $notification)
            <div class="px-4 py-3 hover:bg-gray-50 {{ $notification->read_at ? 'opacity-75' : '' }}">
                <p class="text-sm font-medium text-gray-900">
                    New booking from {{ $notification->data['tourist_name'] }}
                </p>
                <div class="mt-1 text-xs text-gray-500">
                    <p>Property: {{ $notification->data['listing_title'] }}</p>
                    <p>Check-in: {{ \Carbon\Carbon::parse($notification->data['check_in'])->format('M d, Y') }}</p>
                    <p>Check-out: {{ \Carbon\Carbon::parse($notification->data['check_out'])->format('M d, Y') }}</p>
                    <p class="mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <div class="px-4 py-3 text-sm text-gray-500">
                No notifications
            </div>
        @endforelse
    </div>
</div>