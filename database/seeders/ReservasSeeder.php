<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\User;
use App\Models\Reserva;

class ReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los dos turistas
        $turistas = User::whereIn('email', [
            'turista1@turipotosi.test',
            'turista2@turipotosi.test',
        ])->get();

        // Obtener todos los tours
        $tours = Tour::all();

        //comprobar si existen los datos para generar reservas
        if ($turistas->isEmpty() || $tours->isEmpty()) {
            throw new \RuntimeException(
                'No existen turistas o tours para generar las reservas.'
            );
        }

        // Generar 20 reservas
        for ($i= 0; $i < 20; $i++) {
            // buscar tours con cupos disponibles
            $toursDisponibles = $tours->filter(function ($tour) {
                return $tour->cuposDisponibles() >=1;
            });
            if ($toursDisponibles -> isEmpty()) {
                throw new \RuntimeException(
                    'No hay suficientes cupos para generar las reservas.'
                );
            }

            // Eligir un tour y un turista aleatoriamente
            $tour = $toursDisponibles->random();
            $turista = $turistas->random();

            //calcular la cantidad maxima de personas permitida
            $cantidadMaxima = min(3, $tour->cuposDisponibles());

            // crear reserva
            Reserva::factory()->create([
                'user_id' => $turista->id,
                'tour_id' => $tour->id,
                'cantidad_personas' => fake()->numberBetween(
                    1,
                    $cantidadMaxima
                ),
                'estado' => fake()->randomElement([
                    'pendiente',
                    'confirmada',
                    'cancelada',
                ]),
            ]);
        }

    }
}
