<?php

namespace Database\Factories;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'profession_id' => Profession::factory(),
        ];
    }
}
