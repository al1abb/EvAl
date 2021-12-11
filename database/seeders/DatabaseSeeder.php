<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            AgencySeeder::class,
            // AdminSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            PostImageSeeder::class,
            FlagSeeder::class,
            LaratrustSeeder::class,
        ]);
    }
}
