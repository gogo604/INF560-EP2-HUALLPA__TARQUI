<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\Servicio;

class ToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear tours
        Tour::factory(12)->create()->each(function ($tour) {
            //seleccionar servicios aleatorios
            $servicios = Servicio::inRandomOrder()
                ->limit(fake()->numberBetween(2, 4))
                ->pluck('id');

            //asignar los servicios al tour
            $tour->servicios()->attach($servicios);
        });
    }
}
