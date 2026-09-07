<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class CheckInReminder extends Notification
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
                    ->subject('Check-in Reminder')
                    ->line('This is a reminder about your upcoming check-in!')
                    ->line('Room: ' . $this->reservation->room->room_number)
                    ->line('Check-in Date: ' . $this->reservation->check_in_date->format('Y-m-d'))
                    ->line('Guest Name: ' . $this->reservation->guest->first_name . ' ' . $this->reservation->guest->last_name)
                    ->action('View Details', url('/reservations/' . $this->reservation->id))
                    ->line('We look forward to your arrival!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'guest_name' => $this->reservation->guest->first_name . ' ' . $this->reservation->guest->last_name,
            'room_number' => $this->reservation->room->room_number,
            'check_in_date' => $this->reservation->check_in_date,
        ];
    }
}
