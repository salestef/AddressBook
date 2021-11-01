<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'city_id' => City::factory(),
            'email' => $this->faker->unique()->safeEmail(),
            'web' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber()
        ];
    }
}
