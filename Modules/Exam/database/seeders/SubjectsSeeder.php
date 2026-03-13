<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Exam\Models\Subject;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        $subjects = [
            [
                'category_id' => 2,
                'name' => 'Physics',
                'slug' => 'physics',
                'short_details' => '50 questions to answer all',
                'status' => 1,
                'is_popular' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'Chemistry',
                'slug' => 'chemistry',
                'short_details' => '40 questions to answer all Each question is to be answered within 45 seconds.',
                'status' => 1,
                'is_popular' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'English',
                'slug' => 'english',
                'short_details' => 'Answer all questions',
                'status' => 1,
                'is_popular' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'Mathematics',
                'slug' => 'mathematics',
                'short_details' => 'Answer all questions',
                'status' => 1,
                'is_popular' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'General Studies',
                'slug' => 'english-language',
                'short_details' => 'Use of English',
                'status' => 1,
                'is_popular' => 1,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate([
                'name' => $subject['name'],
                'slug' => $subject['slug'],
            ], [
                'category_id' => $subject['category_id'],
                'short_details' => $subject['short_details'],
                'status' => $subject['status'],
                'is_popular' => $subject['is_popular'],
            ]);
        }
    }
}
