<?php

namespace Database\Seeders;

use App\Models\PostImage;
use Illuminate\Database\Seeder;

class PostImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::factory()
                ->count(500)
                ->create();
    }
}
