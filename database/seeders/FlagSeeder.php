<?php

namespace Database\Seeders;

use App\Models\Flag;
use Illuminate\Database\Seeder;

class FlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Flag::factory()
                ->count(5)
                ->create();
    }
}
