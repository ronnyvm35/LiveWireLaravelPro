<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); 
        DB::table('users')->insert(
            ['name' => 'admin', 'email' => 'admin@test.com', 'role' => 'admin', 'password' => Hash::make('password')]
        );
        DB::table('users')->insert( 
            ['name' => 'user', 'email' => 'user@test.com', 'role' => 'user', 'password' => Hash::make('password')]
        );
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 
    }
}
