<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
            'name' => "Administrator",
            'slug' => 'administrator',
            'description' => 'manage administration privileges',
        ]);
        DB::table('roles')->insert([
            'name' => "Moderator",
            'slug' => 'moderator',
            'description' => 'manage moderator privileges',
        ]);
        DB::table('roles')->insert([
            'name' => "Guest",
            'slug' => 'guest',
            'description' => 'manage guest privileges',
        ]);
    }
}
