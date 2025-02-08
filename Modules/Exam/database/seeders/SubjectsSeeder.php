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
       $subjects = array (
        0 => 
        array (
          'id' => 1,
          'category_id' => 2,
          'name' => 'Physics1',
          'slug' => 'physics',
          'short_details' => '50 questions to answer all',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-02-08 20:30:40',
          'updated_at' => '2023-11-09 01:04:04',
        ),
        1 => 
        array (
          'id' => 2,
          'category_id' => 1,
          'name' => 'Chemistry1',
          'slug' => 'chemistry',
          'short_details' => '40 questions to answer all
      Each question is to be answer with in 45 seconds.',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-02-15 00:14:19',
          'updated_at' => '2023-11-08 06:29:11',
        ),
        2 => 
        array (
          'id' => 3,
          'category_id' => 1,
          'name' => 'English',
          'slug' => 'english',
          'short_details' => 'Answer all questions',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-02-15 01:27:34',
          'updated_at' => '2023-02-15 01:27:34',
        ),
        3 => 
        array (
          'id' => 4,
          'category_id' => 1,
          'name' => 'MAT 121',
          'slug' => 'mat-121',
          'short_details' => 'MAT121 PAST QUESTIONS AND ANSWERS',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-05-10 06:55:37',
          'updated_at' => '2023-05-10 06:55:37',
        ),
        4 => 
        array (
          'id' => 5,
          'category_id' => 1,
          'name' => 'CHM 111',
          'slug' => 'chm-111',
          'short_details' => 'General Knowledge',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-05-10 07:17:48',
          'updated_at' => '2023-05-10 07:17:48',
        ),
        5 => 
        array (
          'id' => 6,
          'category_id' => 1,
          'name' => 'Mathematics',
          'slug' => 'mathematics',
          'short_details' => 'Answer all questions',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-05-11 17:08:34',
          'updated_at' => '2023-05-11 23:44:14',
        ),
        6 => 
        array (
          'id' => 7,
          'category_id' => 1,
          'name' => 'Nigeria people and culture',
          'slug' => 'nigeria-people-and-culture',
          'short_details' => 'Answer all questions',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-06-03 20:47:51',
          'updated_at' => '2023-06-03 20:47:51',
        ),
        7 => 
        array (
          'id' => 8,
          'category_id' => 4,
          'name' => 'Test subject',
          'slug' => 'test-subject',
          'short_details' => 'Testing available course',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-09-21 14:35:16',
          'updated_at' => '2023-09-21 14:35:16',
        ),
        8 => 
        array (
          'id' => 9,
          'category_id' => 1,
          'name' => 'Chemistry',
          'slug' => 'chemistry',
          'short_details' => 'Inclusive Organic Chemistry',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-11-08 06:29:37',
          'updated_at' => '2023-11-11 12:53:24',
        ),
        9 => 
        array (
          'id' => 10,
          'category_id' => 1,
          'name' => 'Physics',
          'slug' => 'physics',
          'short_details' => 'General Knowledge on  Physics',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-11-09 05:31:27',
          'updated_at' => '2023-11-11 12:53:07',
        ),
        10 => 
        array (
          'id' => 11,
          'category_id' => 1,
          'name' => 'General Studies',
          'slug' => 'english-language',
          'short_details' => 'Use of English',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-11-10 15:14:15',
          'updated_at' => '2023-11-11 12:52:06',
        ),
        11 => 
        array (
          'id' => 12,
          'category_id' => 1,
          'name' => 'General Mathematics',
          'slug' => 'general-mathematics',
          'short_details' => 'Answer all questions as each question carries equal mark',
          'status' => 1,
          'is_popular' => 1,
          'created_at' => '2023-11-11 00:56:05',
          'updated_at' => '2023-11-11 12:52:47',
        ),
      );


      foreach ($subjects as $subject ) {
        Subject::updateOrCreate([
          'name' => $subject['name'],
          'slug' => $subject['slug'],
        ], [
            'category_id' => $subject['category_id'],
            'name' => $subject['name'],
            'slug' => $subject['slug'],
            'short_details' => $subject['short_details'],
            'status' => $subject['status'],
            'is_popular' => $subject['is_popular'],
        ]);
      }
    }
}
