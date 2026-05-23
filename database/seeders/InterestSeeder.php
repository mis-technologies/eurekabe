<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\Interest;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        $interests = [
            'Mathematics',
            'Science',
            'Technology',
            'Engineering',
            'Medicine',
            'Law',
            'Business',
            'Economics',
            'Languages',
            'Social Sciences',
            'History',
            'Education',
            'Agriculture',
            'Arts',
            'JAMB',
            'WAEC',
            'NECO',
            'Post-UTME',
        ];

        foreach ($interests as $name) {
            Interest::firstOrCreate(['name' => $name]);
        }

        $this->command->info('Interests seeded: ' . count($interests));
    }
}
