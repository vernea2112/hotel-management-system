<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['room_number' => '101', 'room_type' => 'single', 'capacity' => 1, 'price_per_night' => 100, 'status' => 'available', 'description' => 'Cozy single room with city view'],
            ['room_number' => '102', 'room_type' => 'double', 'capacity' => 2, 'price_per_night' => 150, 'status' => 'available', 'description' => 'Comfortable double room'],
            ['room_number' => '103', 'room_type' => 'double', 'capacity' => 2, 'price_per_night' => 160, 'status' => 'occupied', 'description' => 'Double room with balcony'],
            ['room_number' => '104', 'room_type' => 'suite', 'capacity' => 4, 'price_per_night' => 250, 'status' => 'available', 'description' => 'Spacious suite with living area'],
            ['room_number' => '201', 'room_type' => 'single', 'capacity' => 1, 'price_per_night' => 100, 'status' => 'reserved', 'description' => 'Single room on second floor'],
            ['room_number' => '202', 'room_type' => 'double', 'capacity' => 2, 'price_per_night' => 150, 'status' => 'available', 'description' => 'Standard double room'],
            ['room_number' => '203', 'room_type' => 'deluxe', 'capacity' => 3, 'price_per_night' => 300, 'status' => 'available', 'description' => 'Luxury deluxe room with premium amenities'],
            ['room_number' => '204', 'room_type' => 'suite', 'capacity' => 4, 'price_per_night' => 280, 'status' => 'occupied', 'description' => 'Presidential suite'],
            ['room_number' => '301', 'room_type' => 'single', 'capacity' => 1, 'price_per_night' => 100, 'status' => 'maintenance', 'description' => 'Single room under maintenance'],
            ['room_number' => '302', 'room_type' => 'double', 'capacity' => 2, 'price_per_night' => 150, 'status' => 'available', 'description' => 'Double room on third floor'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
