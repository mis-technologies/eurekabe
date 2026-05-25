<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = \Modules\Common\Models\School::pluck('id')->toArray();
        if (empty($schools)) {
            // Create a default school if none exists
            $school = \Modules\Common\Models\School::create([
                'name' => 'Default School',
                'acronym' => 'DS',
            ]);
            $schools[] = $school->id;
        }

        $faker = \Faker\Factory::create();
        $password = bcrypt('password');

        for ($i = 1; $i <= 50; $i++) {
            $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
            $word = str_replace('-', '_', $f->format($i));
            
            \App\Models\User::updateOrCreate(
                ['email' => "student_{$word}@eurekaedu.academy"],
                [
                    'firstname' => $faker->firstName,
                    'lastname'  => $faker->lastName,
                    'username'  => "student_{$word}",
                    'role'      => 'student',
                    'school_id' => $faker->randomElement($schools),
                    'password'  => $password,
                ]
            );
        }
    }
}
