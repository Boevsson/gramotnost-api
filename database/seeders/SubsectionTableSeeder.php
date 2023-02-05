<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubsectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subsections')->insert([
            'id'    => 1,
            'name'          => 'Подсекция',
            'color'         => 'blue',
            'challenge_id'  => 1,
        ]);
    }
}
