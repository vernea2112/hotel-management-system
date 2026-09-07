<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guest;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        $guests = [
            [
                'first_name' => 'João',
                'last_name' => 'Silva',
                'email' => 'joao.silva@email.com',
                'phone' => '+55 11 98765-4321',
                'address' => 'Rua Principal, 123',
                'city' => 'São Paulo',
                'country' => 'Brazil',
                'document_id' => '12345678901',
                'document_type' => 'cpf',
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'email' => 'maria.santos@email.com',
                'phone' => '+55 21 99876-5432',
                'address' => 'Avenida Costeira, 456',
                'city' => 'Rio de Janeiro',
                'country' => 'Brazil',
                'document_id' => '10987654321',
                'document_type' => 'cpf',
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@email.com',
                'phone' => '+1 555-123-4567',
                'address' => '123 Main Street',
                'city' => 'New York',
                'country' => 'USA',
                'document_id' => 'AB123456',
                'document_type' => 'passport',
            ],
            [
                'first_name' => 'Emma',
                'last_name' => 'Johnson',
                'email' => 'emma.johnson@email.com',
                'phone' => '+44 20 1234 5678',
                'address' => '10 Oxford Street',
                'city' => 'London',
                'country' => 'UK',
                'document_id' => 'CD987654',
                'document_type' => 'passport',
            ],
        ];

        foreach ($guests as $guest) {
            Guest::create($guest);
        }
    }
}
