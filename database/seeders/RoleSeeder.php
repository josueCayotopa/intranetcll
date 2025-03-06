<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles para el área de Recursos Humanos
        $roles = [
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador del sistema con acceso completo'
            ],
            [
                'nombre' => 'gerente_rh',
                'descripcion' => 'Gerente de Recursos Humanos con acceso a todas las funciones de RH'
            ],
            [
                'nombre' => 'analista_rh',
                'descripcion' => 'Analista de Recursos Humanos con acceso limitado'
            ],
            [
                'nombre' => 'asistente_rh',
                'descripcion' => 'Asistente de Recursos Humanos con acceso básico'
            ],
            [
                'nombre' => 'empleado',
                'descripcion' => 'Empleado regular con acceso solo a su información'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
