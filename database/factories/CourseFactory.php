<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_name' => $this->faker->name(),
            'teacher_responsible' => $this->faker->name(),
            'start_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'date_completion' => $this->faker->dateTime($max = '31-12-2023', $timezone = null),
            'room_number' =>$this->faker->randomNumber(4),
        ];
    }
}
