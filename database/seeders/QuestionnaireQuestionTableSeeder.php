<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questionnaire_questions')->insert([
            'id'            => 1,
            'question_text' => 'Въпросник въпрос',
            'answer_text'   => 'Отговор',
            'color'         => '#c98585',
        ]);
    }
}
