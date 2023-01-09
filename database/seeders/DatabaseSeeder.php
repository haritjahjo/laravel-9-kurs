<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Team;

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

        \App\Models\User::factory()->create([
            'name' => 'Hari Tjahjo',
            'email' => 'hari@example.com',
            'password' => bcrypt(value:'password'),
        ]);
        
        \App\Models\User::factory(10)->create();


        Team::create([ 'user_id' => 1, 'name' => 'admin-team', 'personal_team' => '1', ]);        

        Property::factory(count: 10)->create([
//            'slider' => true,
        ]);

        Property::factory(count: 40)->create();
    }
}
