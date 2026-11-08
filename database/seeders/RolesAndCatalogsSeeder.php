<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Servicio;
use Spatie\Permission\Models\Role;

class RolesAndCatalogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // roles del sistema
        $roles = ['admin', 'guia', 'turista'];

        foreach ($roles as $rol) {
            Role::firstOrCreate([
                'name' => $rol,
                'guard_name' => 'web',
            ]);
        }

        //Crear categorias
        $categorias =[
            [
                'nombre' => 'Histórico-cultural',
                'slug' => 'historico-cultural',
                'descripcion' => 'Recorridos por lugares históricos y culturales de Potosí.',
            ],
            [
                'nombre' => 'Minero',
                'slug' => 'minero',
                'descripcion' => 'Experiencias relacionadas con la historia minera.',
            ],
            [
                'nombre' => 'Naturaleza',
                'slug' => 'naturaleza',
                'descripcion' => 'Recorridos por paisajes y espacios naturales.',
            ],
            [
                'nombre' => 'Gastronómico',
                'slug' => 'gastronomico',
                'descripcion' => 'Experiencias para conocer la gastronomía local.',
            ],
            [
                'nombre' => 'Aventura',
                'slug' => 'aventura',
                'descripcion' => 'Activididades turísticas de aventura.'
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['slug' => $categoria['slug']],
                $categoria
            );
        }

        // Crear Servicios
        $servicios = [
            'Transporte',
            'Almuerzo',
            'Entradas Incluidas',
            'Guía bílingue',
            'Seguro',
            'Equipo de protección',
        ];

        foreach ($servicios as $servicio) {
            Servicio::firstOrCreate([
                'nombre' => $servicio,
            ]);
        }


    }
}
