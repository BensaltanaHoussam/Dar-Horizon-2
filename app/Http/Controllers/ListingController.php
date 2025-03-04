<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ListingController extends Controller
{




    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'available_from' => 'required|date',
            'available_until' => 'required|date',
            'country' => 'required|in:Portugal,Morocco,Spain',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['country'] = trim($validatedData['country']);

        Listing::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'location' => $validatedData['location'],
            'price' => $validatedData['price'],
            'available_from' => $validatedData['available_from'],
            'available_until' => $validatedData['available_until'],
            'country' => $validatedData['country'],
            'image' => $validatedData['image'] ?? null,
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('owner.posts')->with('success', 'Listing created successfully!');

    }


    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->route('owner.posts')->with('success', 'Listing deleted successfully');
    }


    public function edit(Listing $listing)
    {
        $listing->available_from = Carbon::parse($listing->available_from);
        $listing->available_until = Carbon::parse($listing->available_until);
        return view('owner.listings.edit', compact('listing'));
    }


    public function update(Request $request, Listing $listing)
    {



        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'available_from' => 'required|date',
            'available_until' => 'required|date',
            'country' => 'required|in:Portugal,Morocco,Spain',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);



        if ($request->hasFile('image')) {

            if ($listing->image) {
                Storage::delete('public/' . $listing->image);
            }


            $imagePath = $request->file('image')->store('listings', 'public');
            $validatedData['image'] = $imagePath;
        }

        $listing->update($validatedData);
        return redirect()->route('owner.posts')->with('success', 'Listing updated successfully!');
    }




    public function show($id)
    {
        $listing = Listing::findOrFail($id);

        $availableFrom = $listing->available_from->toDateString();
        $availableUntil = $listing->available_until->toDateString();

        return view('listing.show', compact('listing', 'availableFrom', 'availableUntil'));
    }
}
