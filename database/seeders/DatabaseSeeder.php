<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(ChallengeTableSeeder::class);
        $this->call(SubsectionTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(QuestionTypeTableSeeder::class);
        $this->call(QuestionnaireQuestionTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
        $this->call(FileTableSeeder::class);
        $this->call(GeneralTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(PageFilesTableSeeder::class);
    }
}
