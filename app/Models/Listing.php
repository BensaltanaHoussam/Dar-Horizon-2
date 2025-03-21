<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'location',
        'price',
        'available_from',
        'available_until',
        'country',
        'image',
        'owner_id',
    ];


    protected $dates = [
        'available_from',
        'available_until',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'listing_id');
    }


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}
