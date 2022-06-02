<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        // DB::table('users')->insert([
        //     'agency_id' => null,
        //     'avatar' => 0,
        //     'name' => 'Ali (Admin)',
        //     'email' => 'ali@admin.com',
        //     'password' => bcrypt('11111111'),
        //     'role' => 'administrator',
        //     'email_is_verified' => false,
        //     'phone_number' => '1-234-567-890',
        // ]);

        $admin = User::create([
            'agency_id' => null,
            'avatar' => 0,
            'name' => 'Ali (Admin)',
            'email' => 'ali@admin.com',
            'password' => bcrypt('11111111'),
            'role' => 'administrator',
            'email_is_verified' => false,
            'phone_number' => '1-234-567-890',
        ]);

        $admin->attachRole('administrator');
        $admin->save();

        // Moderator
        $moderator = User::create([
            'agency_id' => null,
            'avatar' => 0,
            'name' => 'Ali (Moderator)',
            'email' => 'ali@moderator.com',
            'password' => bcrypt('11111111'),
            'role' => 'moderator',
            'email_is_verified' => false,
            'phone_number' => '1-234-567-890',
        ]);

        $moderator->attachRole('moderator');
        $moderator->save();

        // User
        $user = User::create([
            'agency_id' => null,
            'avatar' => 0,
            'name' => 'Ali',
            'email' => 'ali@user.com',
            'password' => bcrypt('11111111'),
            'role' => 'user',
            'email_is_verified' => false,
            'phone_number' => '1-234-567-890',
        ]);

        $user->attachRole('user');
        $user->save();
    }
}
