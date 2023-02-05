<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'    => 1,
            'name' => 'admin',
            'email' => 'svh@gbg.bg',
            'password' => bcrypt('uxWf2VTA6ZCHKXy8'),
        ]);
    }
}
