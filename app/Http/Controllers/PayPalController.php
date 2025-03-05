<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function createPayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success', ['booking' => $booking->id]),
                "cancel_url" => route('paypal.cancel', ['booking' => $booking->id]),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($booking->total_price, 2, '.', '')
                    ],
                    "description" => "Booking for listing: " . $booking->listing->title
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->back()->with('error', 'Something went wrong with PayPal payment.');
    }

    public function success(Request $request, $bookingId)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $booking = Booking::find($bookingId);
            $booking->payment_status = Booking::PAYMENT_PAID;
            $booking->status = Booking::STATUS_CONFIRMED;
            $booking->save();

            return redirect()->route('tourist.bookings')
                ->with('success', 'Payment completed successfully!');
        }

        return redirect()->route('tourist.bookings')
                ->with('error', 'Payment failed. Please try again.');
    }

    public function cancel(Request $request, $bookingId)
    {
        $booking = Booking::find($bookingId);
        $booking->payment_status = Booking::PAYMENT_CANCELLED;
        $booking->save();

        return redirect()->route('tourist.bookings')
                ->with('error', 'Payment cancelled.');
    }
}