<?php

namespace Database\Factories;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tour;
use App\Models\User;

/**
 * @extends Factory<Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Reserva::class;

    public function definition(): array
    {
        return [
            'user_id' => User::whereIn('email', [
                'turista1@turipotosi.test',
                'turista2@turipotosi.test',
            ])->inRandomOrder()->value('id'),
            'tour_id' => Tour::inRandomOrder()->value('id'),
            'cantidad_personas'=>fake()->numberBetween(1,3),
            'estado' => fake()->randomElement([
                'pendiente',
                'confirmada',
                'cancelada',
            ]),

            'observacion' => fake()->optional()->sentence(),
        ];
    }
}
