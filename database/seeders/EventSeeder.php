<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Event::create([
            'title' => 'Sport B Hackathon',
            'type' => 'in_person',
            'start_datetime' => '2022-03-15 09:00:00',
            'end_datetime' => '2022-03-15 17:00:00',
            'location' => 'London, UK',
            'image' => 'asset/images/programs/002.jpg',
            'price' => 'Free',
            'description' => 'Join us for a day of hacking and fun!',
            'speakers' => json_encode([
                [
                    'name' => 'John Doe',
                    'title' => 'CEO, Eureka',
                    'img_url' => 'asset/images/Marv.png',
                ],
                [
                    'name' => 'Jane Doe',
                    'title' => 'CTO, Eureka',
                    'img_url' => 'asset/images/Marv.png',
                ],
                [
                    'name' => 'Jane Doe',
                    'title' => 'CTO, Eureka',
                    'img_url' => 'asset/images/Marv.png',
                ],
            ]),

            'sponsors' => json_encode([
                [
                    'name' => 'Eureka',
                    'logo_url' => 'asset/images/partners/img1.png',
                ],
                [
                    'name' => 'Tech Corp',
                    'logo_url' => 'asset/images/partners/img1.png',
                ],
            ]),

            'special_bonus' => 'Free swag for all attendees!',
            'status' => 'UPCOMING',
            'reg_link' => 'https://example.com/register',
        ]);


        Event::create([
            'title' => 'Sport B Hackathon',
            'type' => 'virtual',
            'start_datetime' => '2022-03-15 09:00:00',
            'end_datetime' => '2022-03-15 17:00:00',
            'location' => 'London, UK',
            'image' => 'asset/images/programs/politics.jpg',
            'price' => 'Free',
            'description' => 'Join us for a day of hacking and fun!',
            'speakers' => json_encode([
                [
                    'name' => 'John Doe',
                    'title' => 'CEO, Eureka',
                    'img_url' => 'asset/images/Marv.png',
                ],
                [
                    'name' => 'Jane Doe',
                    'title' => 'CTO, Eureka',
                    'img_url' => 'asset/images/Marv.png',
                ],
                [
                    'name' => 'Jane Doe',
                    'title' => 'CTO, Eureka',
                    'img_url' => 'asset/images/Marv.png',
                ],
            ]),
            'sponsors' => json_encode([
                [
                    'name' => 'Eureka',
                    'logo_url' => 'asset/images/partners/img1.png',
                ],
                [
                    'name' => 'Tech Corp',
                    'logo_url' => 'asset/images/partners/img1.png',
                ],
            ]),
            'special_bonus' => 'Free swag for all attendees!',
            'status' => 'PAST EVENT',
            'reg_link' => 'https://example.com/register',
          










        ]);
    }
}
