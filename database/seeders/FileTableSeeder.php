<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            'id'    => 1,
            'name'       => 'test name updated',
            'local_path' => '/storage/public/O0K1v28Qo0Va2jj1xnlcMsDSVpGbYEDeOnuIGpus.pdf',
            'url'        => 'http://127.0.0.1:8000/storage/O0K1v28Qo0Va2jj1xnlcMsDSVpGbYEDeOnuIGpus.pdf',
        ]);
    }
}
