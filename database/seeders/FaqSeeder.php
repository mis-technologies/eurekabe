<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::updateOrCreate(
            ['question' => 'What is Eureka?'],
            ['answer' => 'Eureka is a platform designed to empower education by supporting and promoting dynamic learning experiences and impactful events.']
        );

        Faq::updateOrCreate(
            ['question' => 'How can I become an advocate?'],
            ['answer' => 'Join our community by clicking the  Become an Advocate button and filling out the necessary information to get started.']
        );

        Faq::updateOrCreate(
            ['question' => 'What benefits do I get as an advocate?'],
            ['answer' => 'As an advocate, you gain leadership experience, enhance your communication skills, and have the opportunity to shape the direction of education in your school.']
        );

        Faq::updateOrCreate(
            ['question' => 'How can I contact Eureka?'],
            ['answer' => 'You can contact us through the Contact Us page or by filling out the form in the Have Any More Questions? section below.']
        );

        Faq::updateOrCreate(
            ['question' => 'What benefits do I get as an advocate?'],
            ['answer' => 'As an advocate, you gain leadership experience, enhance your communication skills, and have the opportunity to shape the direction of education in your school.']
        );

        Faq::updateOrCreate(
            ['question' => 'How can I contact Eureka?'],
            ['answer' => 'You can contact us through the Contact Us page or by filling out the form in the Have Any More Questions? section below.']
        );
    }
}