<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Common\Models\Category;
use Modules\Common\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        // ── Academic discipline categories ────────────────────────────
        $disciplines = [
            'Sciences'                => 'sciences',
            'Engineering & Technology'=> 'engineering-technology',
            'Medicine & Health'       => 'medicine-health',
            'Social Sciences'         => 'social-sciences',
            'Commerce & Business'     => 'commerce-business',
            'Languages'               => 'languages',
            'Law'                     => 'law',
            'Education'               => 'education',
            'General'                 => 'general',
        ];

        $categoryIds = [];
        foreach ($disciplines as $name => $slug) {
            $cat = Category::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'status' => 1]
            );
            $categoryIds[$slug] = $cat->id;
        }

        // ── Subjects keyed by [name => discipline_slug] ───────────────
        $popular = [
            'Mathematics', 'English Language', 'Physics', 'Chemistry',
            'Biology', 'Economics', 'Accounting', 'Computer Science', 'Use of English',
        ];

        $subjects = [
            // Sciences
            'Mathematics'              => 'sciences',
            'Further Mathematics'      => 'sciences',
            'Physics'                  => 'sciences',
            'Chemistry'                => 'sciences',
            'Biology'                  => 'sciences',
            'Agricultural Science'     => 'sciences',
            'Statistics'               => 'sciences',

            // Engineering & Technology
            'Computer Science'         => 'engineering-technology',
            'Electrical Engineering'   => 'engineering-technology',
            'Mechanical Engineering'   => 'engineering-technology',
            'Civil Engineering'        => 'engineering-technology',
            'Chemical Engineering'     => 'engineering-technology',
            'Software Engineering'     => 'engineering-technology',

            // Medicine & Health
            'Anatomy'                  => 'medicine-health',
            'Physiology'               => 'medicine-health',
            'Biochemistry'             => 'medicine-health',
            'Pharmacology'             => 'medicine-health',
            'Nursing Science'          => 'medicine-health',
            'Medical Laboratory Science' => 'medicine-health',

            // Social Sciences
            'Economics'                => 'social-sciences',
            'Government / Politics'    => 'social-sciences',
            'History'                  => 'social-sciences',
            'Geography'                => 'social-sciences',
            'Sociology'                => 'social-sciences',
            'Psychology'               => 'social-sciences',
            'Philosophy'               => 'social-sciences',

            // Commerce & Business
            'Accounting'               => 'commerce-business',
            'Commerce'                 => 'commerce-business',
            'Business Administration'  => 'commerce-business',
            'Marketing'                => 'commerce-business',
            'Banking and Finance'      => 'commerce-business',
            'Entrepreneurship'         => 'commerce-business',

            // Languages
            'English Language'         => 'languages',
            'Literature in English'    => 'languages',
            'Yoruba'                   => 'languages',
            'Igbo'                     => 'languages',
            'Hausa'                    => 'languages',
            'French'                   => 'languages',
            'Mass Communication'       => 'languages',

            // Law
            'Law'                      => 'law',
            'Constitutional Law'       => 'law',
            'Commercial Law'           => 'law',

            // Education
            'Education'                => 'education',
            'Educational Psychology'   => 'education',
            'Curriculum Studies'       => 'education',

            // General
            'Use of English'           => 'general',
            'General Studies'          => 'general',
        ];

        $count = 0;
        foreach ($subjects as $name => $disciplineSlug) {
            Subject::firstOrCreate(
                ['name' => $name],
                [
                    'category_id'  => $categoryIds[$disciplineSlug],
                    'slug'         => Str::slug($name),
                    'short_details' => $name . ' examination questions and study materials.',
                    'status'       => 1,
                    'is_popular'   => in_array($name, $popular) ? 1 : 0,
                ]
            );
            $count++;
        }

        $this->command->info("Subjects seeded: {$count}");
    }
}
