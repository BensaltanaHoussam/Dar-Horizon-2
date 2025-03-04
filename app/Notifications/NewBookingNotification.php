<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'tourist_name' => $this->booking->tourist->name,
            'listing_title' => $this->booking->listing->title,
            'check_in' => $this->booking->check_in,
            'check_out' => $this->booking->check_out,
            'total_price' => $this->booking->total_price,
        ];
    }
}