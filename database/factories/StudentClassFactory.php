<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class StudentClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'student_id' => $this->faker->numberBetween(1, 10),
            's_class_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
