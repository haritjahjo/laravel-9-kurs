<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Property;
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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Hari Tjahjo',
            'email' => 'hari@example.com',
            'password' => bcrypt(value:'password'),
        ]);

        Property::factory(count: 10)->create([
//            'slider' => true,
        ]);

        Property::factory(count: 40)->create();
    }
}
