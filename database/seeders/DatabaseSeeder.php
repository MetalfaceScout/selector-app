<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test',
            'email' => 'dev@test.com',
            'password'=> bcrypt('password'),
        ]);

        \App\Models\Player::factory()->count(12)->create();
    }
}
