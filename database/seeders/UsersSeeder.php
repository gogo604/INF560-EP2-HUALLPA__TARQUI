<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Administrador',
                'email' => 'admin@turipotosi.test',
                'rol' => 'admin',
            ],
            [
                'name' => 'Guía 1',
                'email' => 'guia1@turipotosi.test',
                'rol' => 'guia',
            ],
            [
                'name' => 'Guía 2',
                'email' => 'guia2@turipotosi.test',
                'rol' => 'guia',
            ],
            [
                'name' => 'Turista 1',
                'email' => 'turista1@turipotosi.test',
                'rol' => 'turista',

            ],
            [
                'name' => 'Turista 2',
                'email' => 'turista2@turipotosi.test',
                'rol' => 'turista',

            ],

        ];

        foreach ($usuarios as $datos) {
            $usuario = User::firstOrCreate(
                ['email' => $datos['email']],
                [
                    'name' => $datos['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $usuario->syncRoles([$datos['rol']]);
        }
    }
}
