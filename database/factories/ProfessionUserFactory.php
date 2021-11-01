<?php

namespace Database\Factories;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "profession_id" => Profession::factory(),
            "user_id" => User::factory()
        ];
    }
}
