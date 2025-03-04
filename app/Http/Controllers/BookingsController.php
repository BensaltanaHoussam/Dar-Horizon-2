<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with(['listing'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tourist.bookings', compact('bookings'));
    }

    public function getAvailableDates($listingId)
    {

        $bookings = Booking::where('listing_id', $listingId)
            ->where('check_out', '>=', now())
            ->get();

        $unavailableDates = [];
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->check_in);
            $end = Carbon::parse($booking->check_out);

            while ($start <= $end) {
                $unavailableDates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        return response()->json(['unavailableDates' => $unavailableDates]);
    }





    public function storeBooking(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);



        $booking = new Booking();
        $booking->tourist_id = auth()->id();
        $booking->listing_id = $request->listing_id;
        $booking->booking_date = now(); // Add this line
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->total_price = $this->calculatePrice($request->listing_id, $request->check_in, $request->check_out);
        $booking->save();

        return redirect()->back()->with('success', 'Booking successfully created!');
    }

    private function calculatePrice($listingId, $checkIn, $checkOut)
    {
        return 100.00;
    }



    public function ownerBookings()
    {
        $listings = Listing::where('owner_id', auth()->id())->with('bookings.tourist')->get();

        return view('owner.bookings', compact('listings'));
    }



    public function acceptBooking(Booking $booking)
    {

        if ($booking->listing->owner_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Booking accepted successfully');
    }


    public function rejectBooking(Booking $booking)
    {

        if ($booking->listing->owner_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Booking rejected successfully');
    }







}
