<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Trending Now' => 'trending-now',
            'Technology' => 'technology',
            'Entertainment' => 'entertainment',
            'Marketing' => 'marketing',
            'Sports' => 'sports',
            'Politics' => 'politics'
        ];

        foreach ($categories as $name => $slug) {
            Category::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }
    }
}