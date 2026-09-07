<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $guests = Guest::all();
        $rooms = Room::all();

        $reservations = [
            [
                'guest_id' => $guests[0]->id,
                'room_id' => $rooms[0]->id,
                'check_in_date' => Carbon::now()->format('Y-m-d'),
                'check_out_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'number_of_guests' => 1,
                'status' => 'checked_in',
                'total_price' => 300,
                'notes' => 'Guest prefers room away from noise',
            ],
            [
                'guest_id' => $guests[1]->id,
                'room_id' => $rooms[3]->id,
                'check_in_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'check_out_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'number_of_guests' => 2,
                'status' => 'confirmed',
                'total_price' => 750,
                'notes' => 'Needs early breakfast',
            ],
            [
                'guest_id' => $guests[2]->id,
                'room_id' => $rooms[6]->id,
                'check_in_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'check_out_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'number_of_guests' => 1,
                'status' => 'pending',
                'total_price' => 600,
                'notes' => 'Business trip',
            ],
            [
                'guest_id' => $guests[3]->id,
                'room_id' => $rooms[9]->id,
                'check_in_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'check_out_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'number_of_guests' => 2,
                'status' => 'checked_out',
                'total_price' => 450,
                'notes' => 'Previous guest',
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
