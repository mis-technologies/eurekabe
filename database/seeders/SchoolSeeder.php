<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\School;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [
            [
                'name'         => 'University of Lagos',
                'acronym'      => 'UNILAG',
                'city'         => 'Lagos',
                'state'        => 'Lagos',
                'type'         => 'public',
                'year'         => '1962',
                'rank'         => '1',
                'about'        => 'A leading federal university situated in Lagos, Nigeria.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1562774053-701939374585?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'University of Ibadan',
                'acronym'      => 'UI',
                'city'         => 'Ibadan',
                'state'        => 'Oyo',
                'type'         => 'public',
                'year'         => '1948',
                'rank'         => '2',
                'about'        => 'Nigeria\'s first university, founded in 1948.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Obafemi Awolowo University',
                'acronym'      => 'OAU',
                'city'         => 'Ile-Ife',
                'state'        => 'Osun',
                'type'         => 'public',
                'year'         => '1962',
                'rank'         => '3',
                'about'        => 'Premier university in south-western Nigeria.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'University of Nigeria',
                'acronym'      => 'UNN',
                'city'         => 'Nsukka',
                'state'        => 'Enugu',
                'type'         => 'public',
                'year'         => '1960',
                'rank'         => '4',
                'about'        => 'First fully indigenous university in Nigeria.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1592280771190-3e2e4d571952?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Ahmadu Bello University',
                'acronym'      => 'ABU',
                'city'         => 'Zaria',
                'state'        => 'Kaduna',
                'type'         => 'public',
                'year'         => '1962',
                'rank'         => '5',
                'about'        => 'One of the largest universities in sub-Saharan Africa.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'University of Benin',
                'acronym'      => 'UNIBEN',
                'city'         => 'Benin City',
                'state'        => 'Edo',
                'type'         => 'public',
                'year'         => '1970',
                'rank'         => '6',
                'about'        => 'A federal university in Benin City, Edo State.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Lagos State University',
                'acronym'      => 'LASU',
                'city'         => 'Ojo',
                'state'        => 'Lagos',
                'type'         => 'public',
                'year'         => '1983',
                'rank'         => '7',
                'about'        => 'A state university owned by the Lagos State Government.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1519452635265-7b1fbfd1e4e0?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Covenant University',
                'acronym'      => 'CU',
                'city'         => 'Ota',
                'state'        => 'Ogun',
                'type'         => 'private',
                'year'         => '2002',
                'rank'         => '8',
                'about'        => 'A leading private university in Nigeria.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1592280771190-3e2e4d571952?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1519452635265-7b1fbfd1e4e0?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Federal University of Technology Akure',
                'acronym'      => 'FUTA',
                'city'         => 'Akure',
                'state'        => 'Ondo',
                'type'         => 'public',
                'year'         => '1981',
                'rank'         => '9',
                'about'        => 'A federal university of technology in Akure, Ondo State.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Nnamdi Azikiwe University',
                'acronym'      => 'UNIZIK',
                'city'         => 'Awka',
                'state'        => 'Anambra',
                'type'         => 'public',
                'year'         => '1991',
                'rank'         => '10',
                'about'        => 'A federal university in Awka, Anambra State.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Rivers State University',
                'acronym'      => 'RSU',
                'city'         => 'Port Harcourt',
                'state'        => 'Rivers',
                'type'         => 'public',
                'year'         => '1980',
                'rank'         => '11',
                'about'        => 'A state-owned university in Port Harcourt.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&h=400&fit=crop&q=80',
            ],
            [
                'name'         => 'Bayero University Kano',
                'acronym'      => 'BUK',
                'city'         => 'Kano',
                'state'        => 'Kano',
                'type'         => 'public',
                'year'         => '1975',
                'rank'         => '12',
                'about'        => 'A federal university located in Kano State.',
                'is_active'    => '1',
                'logo'         => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=200&h=200&fit=crop&q=80',
                'cover_image'  => 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?w=800&h=400&fit=crop&q=80',
            ],
        ];

        foreach ($schools as $data) {
            $school = School::where('acronym', $data['acronym'])->first();

            if ($school) {
                // Update logo/cover even if school already exists
                $school->update([
                    'logo'        => $data['logo'],
                    'cover_image' => $data['cover_image'],
                ]);
            } else {
                School::create($data);
            }
        }

        $this->command->info('Schools seeded: ' . count($schools));
    }
}
