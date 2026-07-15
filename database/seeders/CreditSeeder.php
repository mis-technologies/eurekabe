<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\CreditFeatureCost;
use Modules\Common\Models\CreditPlan;

class CreditSeeder extends Seeder
{
    public function run(): void
    {
        // ── Plans ──────────────────────────────────────────────────────────────
        $plans = [
            [
                'name'            => 'Free',
                'slug'            => 'free',
                'type'            => 'monthly',
                'monthly_credits' => 50,
                'price_ngn'       => 0,
                'rollover'        => false,
                'is_active'       => true,
            ],
            [
                'name'            => 'Basic',
                'slug'            => 'basic',
                'type'            => 'monthly',
                'monthly_credits' => 500,
                'price_ngn'       => 50000, // ₦500
                'rollover'        => false,
                'is_active'       => true,
            ],
            [
                'name'            => 'Pro',
                'slug'            => 'pro',
                'type'            => 'monthly',
                'monthly_credits' => 2000,
                'price_ngn'       => 150000, // ₦1,500
                'rollover'        => true,
                'is_active'       => true,
            ],
            [
                'name'            => '100 Credits',
                'slug'            => 'credit_pack_100',
                'type'            => 'pay_as_you_go',
                'monthly_credits' => 100,
                'price_ngn'       => 20000, // ₦200
                'rollover'        => false,
                'is_active'       => true,
            ],
        ];

        foreach ($plans as $plan) {
            CreditPlan::updateOrCreate(['slug' => $plan['slug']], $plan);
        }

        // ── Feature costs ──────────────────────────────────────────────────────
        $costs = [
            // Study Materials — Summarization
            ['feature_key' => 'material_summary_short',    'credits' => 5,  'description' => 'Generate short summary (key points)'],
            ['feature_key' => 'material_summary_medium',   'credits' => 10, 'description' => 'Generate medium summary (section breakdown)'],
            ['feature_key' => 'material_summary_detailed', 'credits' => 20, 'description' => 'Generate detailed summary (comprehensive)'],

            // Study Materials — Resources
            ['feature_key' => 'material_resources',        'credits' => 15, 'description' => 'Generate related resource suggestions'],

            // Study Materials — Questions (cost is per question, multiplied by count)
            ['feature_key' => 'material_questions',        'credits' => 3,  'description' => 'Generate a practice question (×count)'],

            // AI Tutor
            ['feature_key' => 'ai_hint',                   'credits' => 2,  'description' => 'AI exam hint'],
            ['feature_key' => 'ai_explain',                'credits' => 3,  'description' => 'AI answer explanation'],
            ['feature_key' => 'ai_chat_message',           'credits' => 1,  'description' => 'AI tutor chat message'],
        ];

        foreach ($costs as $cost) {
            CreditFeatureCost::updateOrCreate(['feature_key' => $cost['feature_key']], $cost);
        }

        $this->command->info('Credit plans and feature costs seeded.');
    }
}
