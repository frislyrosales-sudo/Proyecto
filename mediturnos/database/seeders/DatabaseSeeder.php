<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario Administrador principal
        User::updateOrCreate(
            ['email' => 'admin@mediturnos.com'],
            [
                'name' => 'Administrador MediTurnos',
                'password' => Hash::make('admin123'),
                'rol' => 'admin',
            ]
        );
    }
}