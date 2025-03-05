<?php

namespace App\Notifications;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingPaymentConfirmation extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Payment Confirmation - DarHorizon')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your payment for booking #' . $this->booking->id . ' has been confirmed.')
            ->line('Booking Details:')
            ->line('Property: ' . $this->booking->listing->title)
            ->line('Check-in: ' . Carbon::parse($this->booking->check_in)->format('M d, Y'))
            ->line('Check-out: ' . Carbon::parse($this->booking->check_out)->format('M d, Y'))
            ->line('Total Amount: $' . number_format($this->booking->total_price, 2))
            ->line('Owner Contact Information:')
            ->line('Name: ' . $this->booking->listing->owner->name)
            ->line('Email: ' . $this->booking->listing->owner->email)
            ->line('Thank you for choosing DarHorizon!');
    }
}