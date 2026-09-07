<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class ReservationConfirmed extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Your reservation has been confirmed!')
                    ->line('Room: ' . $this->reservation->room->room_number)
                    ->line('Check-in: ' . $this->reservation->check_in_date)
                    ->line('Check-out: ' . $this->reservation->check_out_date)
                    ->line('Total Price: $' . number_format($this->reservation->total_price, 2))
                    ->action('View Reservation', url('/reservations/' . $this->reservation->id))
                    ->line('Thank you for booking with us!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'room_number' => $this->reservation->room->room_number,
            'check_in_date' => $this->reservation->check_in_date,
            'check_out_date' => $this->reservation->check_out_date,
            'total_price' => $this->reservation->total_price,
        ];
    }
}
