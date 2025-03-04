<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md mx-auto border border-gray-200">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Confirm Your Payment</h2>
                <p class="text-gray-600 mt-2">Please review your booking details before proceeding</p>
            </div>

            <!-- Booking Details Card -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Booking Details</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Check-in Date:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Check-out Date:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-800">Total Amount:</span>
                            <span class="text-lg font-bold text-blue-600">${{ number_format($booking->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="space-y-4">
                <form action="{{ route('paypal.create', ['booking' => $booking->id]) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200 ease-in-out flex items-center justify-center">
                        <img src="{{ asset('images/paypal-white.png') }}" alt="PayPal" class="h-5 mr-2">
                        Pay with PayPal
                    </button>
                </form>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">or</span>
                    </div>
                </div>

                <a href="{{ route('tourist.bookings') }}" 
                   class="block w-full text-center py-3 px-6 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition duration-200 ease-in-out">
                    Pay Later
                </a>
            </div>

            <!-- Security Notice -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <div class="flex items-center justify-center mb-2">
                    <svg class="h-4 w-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Secure Payment
                </div>
                <p>Your payment information is processed securely through PayPal.</p>
            </div>
        </div>
    </div>
</x-app-layout>