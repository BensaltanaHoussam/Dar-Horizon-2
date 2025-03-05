<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function adminIndex(Request $request)
    {

        $stats = [
            'total_users' => User::count(),
            'active_listings' => Listing::count(),
        ];

        $listings = Listing::latest()->paginate(10);

        return view('admin.adminDashboard', compact('stats', 'listings'));
    }

    public function adminStatistiques(Request $request)
    {

        $stats = [
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
        ];

     
        $bookings = Booking::with(['listing', 'tourist'])
            ->latest()
            ->paginate(10);

        return view('admin.bookingsStats', compact('stats',  'bookings'));
    }



    public function deleteListing(Listing $listing)
    {


        $listing->delete();

        return redirect()->back()->with('success', 'Listing deleted successfully');
    }
}



