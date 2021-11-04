<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\City;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Agency::factory(5)->create();
        City::factory(50)->create();
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'agency_id' => null
        ]);

        $user = User::factory()->create([
            'first_name' => 'Contact',
            'last_name' => 'Contact',
            'email' => 'contact@contact.com',
            'password' => bcrypt('contact123'),
            'role' => 'contact'
        ]);

        for($i=1; $i<=60; $i++) {
            $users = User::factory()->create(
                [
                    'role' => 'contact',
                    'agency_id' => Agency::inRandomOrder()->first()->id
                ]
            );
        }

        Profession::factory(40)->create();

        $professions = Profession::all();

        User::where('role','=','contact')->each(function ($user) use ($professions){
            $user->professions()->attach(
                  $professions->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
