<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "birth" => $this->faker->date('Y-m-d'),
            "age" => $this->faker->numberBetween(18, 60),
            "phone_number" => $this->faker->phoneNumber(),
            "position" => "Admin",
            "email" => $this->faker->freeEmail(),
            "status" => "N",
            "password" => Hash::make("password")
        ];
    }
}
