<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert([
            'id'   => 1,
            'name' => 'checkbox',
        ]);

        DB::table('question_types')->insert([
            'id'   => 2,
            'name' => 'Drag and drop',
        ]);

        DB::table('question_types')->insert([
            'id'   => 3,
            'name' => 'Попълни празните места',
        ]);

        DB::table('question_types')->insert([
            'id'   => 4,
            'name' => 'Свържи правилните',
        ]);
    }
}
