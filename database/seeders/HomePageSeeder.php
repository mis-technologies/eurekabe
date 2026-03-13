<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomePage;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomePage::updateOrCreate(
            ['id' => 1], // Assuming you want to check by id, you can change this to any unique field
            [
                'herosection' => json_encode([
                    'title' => 'Empower Education: Become an Advocate for Your School Today!',
                    'desc' => 'Lead the way in creating dynamic learning experiences and hosting impactful events. Join us in shaping a brighter future for education!',
                    'img_url' => [
                        'img1' => 'asset/images/hero/model6.png',
                        'img2' => 'asset/images/hero/model4.png',
                        'img3' => 'asset/images/hero/model7.png',
                        'img4' => 'asset/images/hero/model3.png',
                        'img5' => 'asset/images/hero/model2.png',
                        'img6' => 'asset/images/hero/model1.png',
                        'img7' => 'asset/images/hero/model5.png',
                        'img8' => 'asset/images/hero/model8.png',
                    ],
                    'community_url' => 'https://chat.whatsapp.com/K9wtsP5rWam1FecyTLRhpA',
                ]),


                'pathnersection' => json_encode([
                    'title' => 'More than 50+ schools trust Eureka',
                        'schools' => [
                            [
                                'school_name' => 'Greenwood High School',
                                'img_url' => 'asset/images/partners/img1.png',
                            ],
                            [
                                'school_name' => 'Springfield Academy',
                                'img_url' => 'asset/images/partners/img2.png',
                            ],
                            [
                                'school_name' => 'Riverside College',
                                'img_url' => 'asset/images/partners/img3.png',
                            ],
                            [
                                'school_name' => 'Hilltop International',
                                'img_url' => 'asset/images/partners/img4.png',
                            ],
                        ],
                 
                ]),


                'whoarewe' => json_encode([
                    'title' => 'Who We Are',
                    'desc' => ' Join us: Embrace the power of Advocacy ',
                    'img_url' => 'asset/images/low-angle-multiracial-college-students%20BW%201.png',
                    'content' => 'Discover the benefits of becoming an Advocate, from gaining
                                  leadership experience to shaping the direction 
                                  of education in your school.',
                    'points' => [
                        'Leadership experience',
                        'Diversity advocacy',
                        'Community building',
                        'Impactful contributions',
                        'Communication skills',
                        'Influence expansion',
                    ],
                    'community_url' => 'https://chat.whatsapp.com/K9wtsP5rWam1FecyTLRhpA',
                ]),
                'socialsection' => json_encode([
                    'facebook' => [
                        'img_url' => 'asset/images/socials/mingcute_facebook-line_d.png',
                        'follower_count' => '50K+',
                    ],
                    'telegram' => [
                        'img_url' => 'asset/images/socials/telegram_d.png',
                        'follower_count' => '2K+',
                    ],
                    'whatsapp' => [
                        'img_url' => 'asset/images/socials/ic_baseline-whatsapp_d.png',
                        'follower_count' => '1M+',
                    ],
                    'instagram' => [
                        'img_url' => 'asset/images/socials/mdi_instagram_d.png',
                        'follower_count' => '1K+',
                    ],
                    'twitter' => [
                        'img_url' => 'asset/images/socials/mingcute_twitter-line_d.png',
                        'follower_count' => '3K+',
                    ],
                ]),
                'whatweoffer' => json_encode([
                    'title' => 'What we offer',
                    'sub_title' => 'Our Programs',
                    'desc' => 'Lead curriculum, events, support, and community engagement. Shape educations future with us!',
                    'advocacy_url' => '/requestForm',
                    'services' => [
                        'service1' => [
                            'img_url' => 'asset/images/icons/clarity_note-line.png',
                            'title' => 'Curriculum Development',
                            'desc' => ' Shape engaging learning experiences by designing curriculum and
                                        promoting innovative teaching methods..',
                        ],
                        'service2' => [
                            'img_url' => 'asset/images/icons/carbon_license-third-party (1).png',
                            'title' => 'Event Organization & Management',
                            'desc' => ' Lead in planning and executing school events, fostering a vibrant
                                          and inclusive community.',
                        ],
                        'service3' => [
                            'img_url' => 'asset/images/icons/la_chalkboard-teacher.png',
                            'title' => 'Student Support & Mentoring',
                            'desc' => 'Provide guidance and encouragement to students, helping them navigate challenges and reach their potential.',
                        ],
                        'service4' => [
                            'img_url' => 'asset/images/icons/Vector (3).png',
                            'title' => 'Community Engagement & Advocacy',
                            'desc' => 'Advocate for student needs and collaborate with stakeholders to create a supportive educational environment.',
                        ],
                    ],
                ]),
                'teamsection' => json_encode([
                    'members' => [
                        [
                            'name' => 'Ejeh M. Micheal',
                            'position' => 'CEO & Co-founder',
                            'desc' => 'Ejeh is a visionary leader with a passion for education.',
                            'img_url' => 'asset/images/team/team1.png',
                        ],
                        [
                            'name' => 'Oche Solomon ',
                            'position' => 'COO & Co-founder',
                            'desc' => 'Oche Solomon is a tech expert with a focus on innovation.',
                            'img_url' => 'asset/images/team/team2.png',
                        ],
                        [
                            'name' => 'Aaron Aniebiet',
                            'position' => 'CTO & Co-founder',
                            'desc' => 'Aaron is a tech expert with a focus on innovation.',
                            'img_url' => 'asset/images/team/team3.png',
                        ],
                        [
                            'name' => 'Richard John',
                            'position' => 'CFO & Co-founder',
                            'desc' => 'Richard is a tech expert with a focus on innovation.',
                            'img_url' => 'asset/images/Richard-removebg-preview.png',
                        ],
                    ],
                ]),
                'downloadsection' => json_encode([
                    'play_store' => [
                        'img_url' => 'asset/images/playStore.png',
                        'link' => 'https://playstore.com',
                    ],
                    'apple_store' => [
                        'img_url' => 'asset/images/appStore.png',
                        'link' => 'https://appstore.com',
                    ],
                ]),
                'engagementsection' => json_encode([
                    'title' => 'Engagement',
                    'sub_title' => 'Our Events',
                    'desc' => 'Explore upcoming events and experiences.Eurekas OurEvents is more than just a calendar its a portal to a world of exploration, discovery, and endless fun. So, join the adventure, unleash your curiosity, and get ready to learn like never before!',
                    'advocate_url' => '/requestForm',
                ]),
            ]
        );
    }
}
