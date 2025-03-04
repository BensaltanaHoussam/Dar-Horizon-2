<x-app-layout>
    <div class="min-h-screen bg-gray-50 px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">My Bookings</h2>

            @if($bookings->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">You haven't made any bookings yet.</p>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($bookings as $booking)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ $booking->listing->title }}</h3>
                                
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="text-sm text-gray-600">
                                            <p>Check-in: {{ date('M d, Y', strtotime($booking->check_in)) }}</p>
                                            <p>Check-out: {{ date('M d, Y', strtotime($booking->check_out)) }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm text-gray-600">Total: ${{ number_format($booking->total_price, 2) }}</span>
                                    </div>

                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="px-2 py-1 text-sm {{ $booking->status === 'accepted' ? 'bg-green-100 text-green-800' : ($booking->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} rounded-full">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>

                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        <span class="px-2 py-1 text-sm {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} rounded-full">
                                            {{ ucfirst($booking->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>