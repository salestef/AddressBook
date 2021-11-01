<?php

namespace Database\Seeders;

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
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        $user = User::factory()->create([
            'first_name' => 'Contact',
            'last_name' => 'Contact',
            'email' => 'contact@contact.com',
            'password' => bcrypt('contact123'),
            'role' => 'contact'
        ]);


        $adminProfession = \App\Models\Profession::factory()->create(['name' => 'admin']);
        $userProfession = \App\Models\Profession::factory()->create(['name' => 'contact']);
        \App\Models\Profession::factory(10)->create();
        \App\Models\Country::factory(5)->create();
        \App\Models\City::factory(10)->create();
        \App\Models\Agency::factory(8)->create();
        User::factory(10)->create();
        \App\Models\UserProfession::factory()->create(
            [
                'user_id' => $admin,
                'profession_id' => $adminProfession
            ]);
        \App\Models\UserProfession::factory()->create(
            [
                'user_id' => $user,
                'profession_id' => $userProfession
            ]);
        \App\Models\UserProfession::factory(15)->create();
    }
}
