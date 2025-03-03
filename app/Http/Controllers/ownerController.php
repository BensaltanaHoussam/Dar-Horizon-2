<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ownerController extends Controller
{
    public function ownerIndex(Request $request)
    {
       return view('owner.ownerDashboard');
    }

    public function myPosts()
    {
        $listings = Listing::where('owner_id', auth()->id())->get(); 

        return view('owner.myPost', compact('listings'));
    }



}
