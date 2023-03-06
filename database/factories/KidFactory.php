<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class KidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'second_first_name' => $this->faker->name(),
            'first_surname' => $this->faker->name(),
            'second_surname' => $this->faker->name(),
            'identification_number' =>$this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'gender' =>$this->faker->randomElement(['masculino','femenino']),
            'date_of_birth' =>$this->faker->dateTime($max = '31-12-2018', $timezone = null),
            'course_id' =>rand(1, 11),
        ];
    }
}
