<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'active' => $this->faker->numberBetween(0, 1),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'address' => $this->faker->optional()->address(),
            'notes' => $this->faker->optional()->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'country_id' => $this->faker->numberBetween(1,37),
        ];
    }
}
