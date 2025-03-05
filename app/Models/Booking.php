<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'booking_date' => 'datetime'
    ];


    // Define status constants
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CONFIRMED = 'confirmed';

    // Define payment status constants
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_CANCELLED = 'cancelled';

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

    public static function getAllowedStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ACCEPTED,
            self::STATUS_REJECTED,
            self::STATUS_CONFIRMED,
        ];
    }


    public static function getAllowedPaymentStatuses()
    {
        return [
            self::PAYMENT_PENDING,
            self::PAYMENT_PAID,
            self::PAYMENT_CANCELLED,
        ];
    }




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
