<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            'id'                => 1,
            'text'              => 'Тест отговор',
            'correct_answer'    => 'правилен отговор',
            'position'          => 1,
            'is_correct_answer' => true,
            'question_id'       => 1,
        ]);
    }


}
