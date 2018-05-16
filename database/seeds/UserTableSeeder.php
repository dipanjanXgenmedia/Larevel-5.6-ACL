<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Administrator",
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => "Moderator",
            'email' => 'moderator@email.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => "Guest",
            'email' => 'guest@email.com',
            'password' => bcrypt('password'),
        ]);
    }
}
