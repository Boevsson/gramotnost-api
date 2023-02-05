<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'id'    => 1,
            'title' => 'Тест страница',
            'text'  => 'test',
            'slug'  => 'test-stranica',
        ]);
    }
}
