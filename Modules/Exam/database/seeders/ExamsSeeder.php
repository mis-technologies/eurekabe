<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Exam\Models\Exam;

class ExamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $exams = [
            [
                'subject_id' => 1,
                'title' => 'General Knowledge on Physics',
                'instruction' => 'Answer all question as each question carries equal mark',
                'start_date' => '2023-11-11',
                'end_date' => '2023-11-12',
                'negative_marking' => 0,
                'reduce_mark' => null,
                'pass_percentage' => 70,
                'duration' => 20,
                'totalmark' => 15,
                'value' => 2,
                'exam_fee' => null,
                'random_question' => 1,
                'option_suffle' => 1,
                'image' => '654ddaed918ab1699601133.jpeg',
                'question_type' => 1,
                'school_id' => 1,
                'status' => 0,
            ],

            [
                'subject_id' => 2,
                'title' => 'Chemistry',
                'instruction' => 'Answer all questions as each question carries equal mark',
                'start_date' => '2023-11-11',
                'end_date' => '2023-11-12',
                'negative_marking' => 0,
                'reduce_mark' => null,
                'pass_percentage' => 70,
                'duration' => 20,
                'totalmark' => 15,
                'value' => 2,
                'exam_fee' => null,
                'random_question' => 1,
                'option_suffle' => 1,
                'image' => '654ded6aafb441699605866.jpg',
                'question_type' => 1,
                'school_id' => 5,
                'status' => 0,
            ],

            [
                'subject_id' => 3,
                'title' => 'Use of English',
                'instruction' => 'Answer all questions as each questions carries equal marks',
                'start_date' => '2023-11-11',
                'end_date' => '2023-11-13',
                'negative_marking' => 0,
                'reduce_mark' => null,
                'pass_percentage' => 70,
                'duration' => 10,
                'totalmark' => 15,
                'value' => 2,
                'exam_fee' => null,
                'random_question' => 1,
                'option_suffle' => 1,
                'image' => '654dfeeea07531699610350.jpg',
                'question_type' => 1,
                'school_id' => 5,
                'status' => 0,
            ],

            [
                'subject_id' => 4,
                'title' => 'Mathematics',
                'instruction' => 'Answer all questions&nbsp;',
                'start_date' => '2023-11-11',
                'end_date' => '2023-11-12',
                'negative_marking' => 0,
                'reduce_mark' => null,
                'pass_percentage' => 70,
                'duration' => 15,
                'totalmark' => 15,
                'value' => 2,
                'exam_fee' => null,
                'random_question' => 1,
                'option_suffle' => 1,
                'image' => null,
                'question_type' => 1,
                'school_id' => 7,
                'status' => 0
            ],

            
            [
                'subject_id' => 5,
                'title' => 'General Knowledge',
                'instruction' => '50 question to answer all',
                'start_date' => '2023-02-18',
                'end_date' => '2023-03-04',
                'negative_marking' => 0,
                'reduce_mark' => null,
                'pass_percentage' => 50,
                'duration' => 45,
                'totalmark' => 55,
                'value' => 2,
                'exam_fee' => null,
                'random_question' => 1,
                'option_suffle' => 1,
                'image' => '63eab7add5df31676326829.jpeg',
                'question_type' => 1,
                'school_id' => 1,
                'status' => 0,
            ],

        ];

        foreach ($exams as $exam) {
            Exam::updateOrCreate([
                'title' => $exam['title'],
            ], $exam);
        }
    }
}
