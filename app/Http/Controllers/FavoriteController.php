<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with('listing')->get()->pluck('listing');

        return view('tourist.favorites', compact('favorites'));
    }
    public function store($listingId)
    {
        $user = auth()->user();
        if ($user->role !== 'tourist') {
            return redirect()->back()->with('error', 'You are not authorized to add favorites.');
        }

        $user->favorites()->create([
            'listing_id' => $listingId
        ]);

        return redirect()->route('tourist.favorites')->with('success', 'Listing added to favorites!');
    }
    public function destroy($listingId)
    {
        $user = auth()->user();
        $user->favorites()->where('listing_id', $listingId)->delete();

        return redirect()->route('tourist.favorites')->with('success', 'Listing removed from favorites.');
    }
}
