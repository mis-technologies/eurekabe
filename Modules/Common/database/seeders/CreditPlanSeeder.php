<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\CreditPlan;

class CreditPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name'            => 'Free',
                'slug'            => 'free',
                'type'            => 'monthly',
                'monthly_credits' => 50,
                'price_ngn'       => 0,
                'is_active'       => true,
                'rollover'        => false,
            ],
            [
                'name'            => 'Basic',
                'slug'            => 'basic',
                'type'            => 'monthly',
                'monthly_credits' => 300,
                'price_ngn'       => 150000, // ₦1,500
                'is_active'       => true,
                'rollover'        => false,
            ],
            [
                'name'            => 'Pro',
                'slug'            => 'pro',
                'type'            => 'monthly',
                'monthly_credits' => 1000,
                'price_ngn'       => 400000, // ₦4,000
                'is_active'       => true,
                'rollover'        => true,
            ],
        ];

        foreach ($plans as $plan) {
            CreditPlan::firstOrCreate(['slug' => $plan['slug']], $plan);
        }
    }
}
