<?php

namespace Modules\Common\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Common\Models\School;

class SchoolDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools = [
            [
                'name' => 'University of Lagos',
                'about' => 'A public research university located in Lagos, Nigeria.',
                'acronym' => 'UNILAG',
                'year' => 1962,
                'city' => 'Lagos',
                'state' => 'Lagos',
                'type' => 'Public',
                'rank' => 1,
                'logo' => 'https://example.com/unilag-logo.png',
                'cover_image' => 'https://example.com/unilag-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'Obafemi Awolowo University',
                'about' => 'A federal government-owned university located in Ile-Ife, Osun State, Nigeria.',
                'acronym' => 'OAU',
                'year' => 1961,
                'city' => 'Ile-Ife',
                'state' => 'Osun',
                'type' => 'Public',
                'rank' => 2,
                'logo' => 'https://example.com/oau-logo.png',
                'cover_image' => 'https://example.com/oau-cover.png',
                'is_active' => true,
            ],
            // Add more schools below
            [
                'name' => 'Ahmadu Bello University',
                'about' => 'A federal government research university located in Zaria, Kaduna State, Nigeria.',
                'acronym' => 'ABU',
                'year' => 1962,
                'city' => 'Zaria',
                'state' => 'Kaduna',
                'type' => 'Public',
                'rank' => 3,
                'logo' => 'https://example.com/abu-logo.png',
                'cover_image' => 'https://example.com/abu-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'University of Ibadan',
                'about' => 'The oldest degree-awarding institution in Nigeria, located in Ibadan, Oyo State.',
                'acronym' => 'UI',
                'year' => 1948,
                'city' => 'Ibadan',
                'state' => 'Oyo',
                'type' => 'Public',
                'rank' => 4,
                'logo' => 'https://example.com/ui-logo.png',
                'cover_image' => 'https://example.com/ui-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'University of Nigeria, Nsukka',
                'about' => 'A federal university located in Nsukka, Enugu State, Nigeria.',
                'acronym' => 'UNN',
                'year' => 1960,
                'city' => 'Nsukka',
                'state' => 'Enugu',
                'type' => 'Public',
                'rank' => 5,
                'logo' => 'https://example.com/unn-logo.png',
                'cover_image' => 'https://example.com/unn-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'Covenant University',
                'about' => 'A private Christian university located in Ota, Ogun State, Nigeria.',
                'acronym' => 'CU',
                'year' => 2002,
                'city' => 'Ota',
                'state' => 'Ogun',
                'type' => 'Private',
                'rank' => 6,
                'logo' => 'https://example.com/cu-logo.png',
                'cover_image' => 'https://example.com/cu-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'Lagos State University',
                'about' => 'A state university located in Ojo, Lagos State, Nigeria.',
                'acronym' => 'LASU',
                'year' => 1983,
                'city' => 'Ojo',
                'state' => 'Lagos',
                'type' => 'Public',
                'rank' => 7,
                'logo' => 'https://example.com/lasu-logo.png',
                'cover_image' => 'https://example.com/lasu-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'University of Ilorin',
                'about' => 'A federal government university located in Ilorin, Kwara State, Nigeria.',
                'acronym' => 'UNILORIN',
                'year' => 1975,
                'city' => 'Ilorin',
                'state' => 'Kwara',
                'type' => 'Public',
                'rank' => 8,
                'logo' => 'https://example.com/unilorin-logo.png',
                'cover_image' => 'https://example.com/unilorin-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'Federal University of Technology, Minna',
                'about' => 'A federal university located in Minna, Niger State, Nigeria.',
                'acronym' => 'FUTMINNA',
                'year' => 1983,
                'city' => 'Minna',
                'state' => 'Niger',
                'type' => 'Public',
                'rank' => 9,
                'logo' => 'https://example.com/futminna-logo.png',
                'cover_image' => 'https://example.com/futminna-cover.png',
                'is_active' => true,
            ],
            [
                'name' => 'Nnamdi Azikiwe University',
                'about' => 'A federal university located in Awka, Anambra State, Nigeria.',
                'acronym' => 'UNIZIK',
                'year' => 1991,
                'city' => 'Awka',
                'state' => 'Anambra',
                'type' => 'Public',
                'rank' => 10,
                'logo' => 'https://example.com/unizik-logo.png',
                'cover_image' => 'https://example.com/unizik-cover.png',
                'is_active' => true,
            ],
            // Continue adding more real Nigerian schools here
        ];

        foreach ($schools as $school) {
            $school = School::create($school);

            if($user = User::where('email', 'advocate@eureka.live')->first()){
                $school->users()->attach($user->id, ['role' => 'advocate']);
            }

        }
    }
}