<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tour::class;

    public function definition(): array
    {
        $titulo = fake()->randomElement([
            'Recorrido por el Cerro Rico',
            'Visita al Salar de Uyuni',
            'Ruta de las Lagunas',
            'Tour por el Centro Histórico',
            'Experiencia en las Minas de Potosí',
            'Ruta Gastronómica Potosina',
            'Aventura en las Montañas',
            'Visita a las Iglesias Coloniales',
            'Exploriación de Paisajes Andinos',
            'Recorridos por Museos',
            'Caminata por la Naturaleza',
            'Aventura en la Cordillera',
        ]);

        return [
            'categoria_id'=> Categoria::inRandomOrder()->value('id'),
            'guia_id' => User::whereIn('email', [
                'guia1@turipotosi.test',
                'guia2@turipotosi.test',
            ])-> inRandomOrder()->value('id'),

            'titulo' => $titulo,
            'slug' => Str::slug($titulo) . '-' . fake()->unique->numberBetween(100, 9999),
            'descripcion' => fake()->paragraph(3),
            'precio' => fake()->randomFloat(2,50,500),
            'duracion_horas' => fake()->numberBetween(2,12),
            'cupo_maximo' => fake()->numberBetween(10, 25),
            'fecha_salida' => fake()->dateTimeBetween('+1 week', '+3 months'),
            'imagen' => null,
            'activo' => true,
        ];
    }
}
