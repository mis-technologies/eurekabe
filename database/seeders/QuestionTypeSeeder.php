<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['id' => 1, 'name' => 'MCQ',     'description' => 'Multiple Choice Question'],
            ['id' => 2, 'name' => 'Written',  'description' => 'Written / free-text answer'],
        ];

        foreach ($types as $type) {
            QuestionType::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}
