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
                                    <!-- Booking Details -->
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="text-sm text-gray-600">
                                            <p>Check-in: {{ date('M d, Y', strtotime($booking->check_in)) }}</p>
                                            <p>Check-out: {{ date('M d, Y', strtotime($booking->check_out)) }}</p>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm text-gray-600">Total: ${{ number_format($booking->total_price, 2) }}</span>
                                    </div>

                                    <!-- Booking Status -->
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="px-2 py-1 text-sm {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} rounded-full">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>

                                    <!-- Payment Status -->
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        <span class="px-2 py-1 text-sm {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} rounded-full">
                                            {{ ucfirst($booking->payment_status) }}
                                        </span>
                                    </div>
                                </div>

                                @if($booking->payment_status === 'pending' && $booking->status !== 'rejected')
                                    <div class="mt-6">
                                        <form action="{{ route('paypal.create', ['booking' => $booking->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-black hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 ease-in-out flex items-center justify-center">
                                                <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M20.067 8.478c.492.88.556 2.014.3 3.327-.74 3.806-3.276 5.12-6.514 5.12h-.5a.805.805 0 0 0-.794.68l-.04.22-.63 4.876-.03.17a.804.804 0 0 1-.794.68h-2.52a.483.483 0 0 1-.477-.558l.922-5.832V17.1c.157-.98 1.05-1.705 2.647-1.705h.467c3.237 0 5.774-1.314 6.514-5.12.257-1.313.193-2.447-.3-3.327" />
                                                </svg>
                                                Pay Now with PayPal
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>