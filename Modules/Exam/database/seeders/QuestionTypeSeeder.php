<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Exam\Models\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionTypes = [
            ['name' => 'Multiple Choice', 'description' => 'Questions with multiple choices'],
            ['name' => 'Short Answer', 'description' => 'Short text answer questions'],
            ['name' => 'Essay', 'description' => 'Detailed answer questions'],
            ['name' => 'True/False', 'description' => 'True or False questions'],
        ];

        foreach ($questionTypes as $type) {
            QuestionType::create($type);
        }
    }
}
