<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'tourist_id',
        'listing_id',
        'booking_date',
        'check_in',
        'check_out',
        'total_price',
        'payment_status',
        'status'
    ];




    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourist()
    {
        return $this->belongsTo(User::class, 'tourist_id');
    }



}
