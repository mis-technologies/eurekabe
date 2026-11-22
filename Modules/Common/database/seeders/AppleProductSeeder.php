<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\CreditPlan;

/**
 * Maps existing credit plans to their Apple App Store Connect product IDs,
 * and seeds the two additional credit pack tiers created for iOS IAP.
 *
 * Safe to re-run: only ever updates `apple_product_id` by slug (never price_ngn
 * or monthly_credits on existing rows) and uses firstOrCreate for new rows.
 */
class AppleProductSeeder extends Seeder
{
    public function run(): void
    {
        $existingMappings = [
            'basic'           => 'com.eurekaeureka.ap.plan.basic.monthly',
            'pro'             => 'com.eurekaeureka.ap.plan.pro.monthly',
            'credit_pack_100' => 'com.eurekaeureka.ap.credits.pack100',
        ];

        foreach ($existingMappings as $slug => $appleProductId) {
            CreditPlan::where('slug', $slug)->update(['apple_product_id' => $appleProductId]);
        }

        $newPacks = [
            [
                'name'             => '500 Credits',
                'slug'             => 'credit_pack_500',
                'type'             => 'pay_as_you_go',
                'monthly_credits'  => 500,
                'price_ngn'        => 90000, // ₦900
                'is_active'        => true,
                'rollover'         => false,
                'apple_product_id' => 'com.eurekaeureka.ap.credits.pack500',
            ],
            [
                'name'             => '1000 Credits',
                'slug'             => 'credit_pack_1000',
                'type'             => 'pay_as_you_go',
                'monthly_credits'  => 1000,
                'price_ngn'        => 170000, // ₦1,700
                'is_active'        => true,
                'rollover'         => false,
                'apple_product_id' => 'com.eurekaeureka.ap.credits.pack1000',
            ],
        ];

        foreach ($newPacks as $pack) {
            CreditPlan::firstOrCreate(['slug' => $pack['slug']], $pack);
        }
    }
}
