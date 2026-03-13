<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');

        Blog::firstOrCreate(
            ['title' => 'The revolution Ai Chatbot Training library for NodeJS'],
            [
                'category_id' => $categories['trending-now']->id,
                'slug' => 'the-revolution-ai-chatbot-training-library-for-nodejs',
                'content' => 'Tech blog content here...',
                'image' => 'http://eurekabe.test/asset/images/programs/man.png',
                'status' => 'PUBLISHED'
            ]
        );

        Blog::firstOrCreate(
            ['title' => 'Exploring the Future of Tech Innovation'],
            [
                'category_id' => $categories['technology']->id,
                'slug' => 'exploring-the-future-of-tech-innovation',
                'content' => 'Advanced technology trends...',
                'image' => 'http://eurekabe.test/asset/images/programs/ladies.png',
                'status' => 'PUBLISHED'
            ]
        );

        Blog::firstOrCreate(
            ['title' => 'Behind the Scenes of Hollywood Blockbusters'],
            [
                'category_id' => $categories['entertainment']->id,
                'slug' => 'behind-the-scenes-of-hollywood-blockbusters',
                'content' => 'Entertainment industry insights...',
                'image' => 'http://eurekabe.test/asset/images/programs/entertainment.jpg',
                'status' => 'PUBLISHED'
            ]
        );

        Blog::firstOrCreate(
            ['title' => 'Creative Marketing Strategies for Startups'],
            [
                'category_id' => $categories['marketing']->id,
                'slug' => 'creative-marketing-strategies-for-startups',
                'content' => 'Effective marketing methods...',
                'image' => 'http://eurekabe.test/asset/images/programs/man.png',
                'status' => 'PUBLISHED'
            ]
        );

        Blog::firstOrCreate(
            ['title' => 'Top Athletes to Watch This Season'],
            [
                'category_id' => $categories['sports']->id,
                'slug' => 'top-athletes-to-watch-this-season',
                'content' => 'Sports highlights and rumors...',
                'image' => 'http://eurekabe.test/asset/images/programs/001.jpg',
                'status' => 'PUBLISHED'
            ]
        );

        Blog::firstOrCreate(
            ['title' => 'The Changing Landscape of Global Politics'],
            [
                'category_id' => $categories['politics']->id,
                'slug' => 'the-changing-landscape-of-global-politics',
                'content' => 'Political updates and events...',
                'image' => 'http://eurekabe.test/asset/images/programs/flag-nigeria.jpg',
                'status' => 'PUBLISHED'
            ]
        );
    }
}