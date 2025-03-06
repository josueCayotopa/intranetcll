<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   
   public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@clinicalaluz.pe',
            'password' => Hash::make('password'),
            'telefono' => '987654321',
            'direccion' => 'Av. Principal 123',
            'nombre_completo' => 'Administrador Sistema',
        ]);
    }
}
