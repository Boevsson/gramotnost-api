<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_files')->insert([
            'id'             => 1,
            'file_id'        => 1,
            'page_id'        => 1,
            'file_title'     => 'test',
            'file_text'      => 'test',
            'file_image_url' => 'test',
        ]);
    }
}
