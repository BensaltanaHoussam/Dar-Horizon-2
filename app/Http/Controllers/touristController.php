<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class touristController extends Controller
{
    public function touristIndex(Request $request)
    {

        $perPage = $request->input('per_page', default: 10);

        if (!in_array($perPage, [4, 10, 25])) {
            $perPage = 10;
        }

        $listings = Listing::paginate($perPage);
        return view('tourist.touristDashboard', compact('listings', 'perPage'));

    }

    public function touristSearch(Request $request)
    {
        $query = Listing::query();

        if ($request->has('country') && !empty($request->country)) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        if ($request->has('price') && !empty($request->price)) {
            $query->where('price', '<=', $request->price);
        }


        $perPage = $request->input('per_page', 10);
        $listings = $query->paginate($perPage);

        return view('tourist.touristDashboard', compact('listings','perPage'));
    }



}
