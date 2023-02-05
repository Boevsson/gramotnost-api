<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('generals')->insert([
            'id'              => 1,
            'logo_url'        => 'test',
            'logo_local_path' => 'test',
            'home_page_text'  => 'test',
            'email'           => 'test11@test.com',
            'phone'           => '0000000000',
            'address'         => 'test',
        ]);
    }
}
