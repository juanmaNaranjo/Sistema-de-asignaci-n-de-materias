<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'day' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']),
            'hour' => $this->faker->randomElement(['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00']),
            'subject_id' => $this->faker->numberBetween(1, 10),
            'teacher_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
