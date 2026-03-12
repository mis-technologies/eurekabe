<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Admin\Models\Founder;

class FounderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $founder_info = [         
        [
            'name' => 'Ejeh M. Micheal',
            'position' => 'CEO & Co-founder',
            'bio' => 'Ejeh is a visionary leader with a passion for education.',
            'image_path' => 'asset/images/Marv.png',
            'order_column' => 1,
            'is_active' => true,
            'created_at' => now()
        ],
        [
            'name' => 'Oche Solomon ',
            'position' => 'COO & Co-founder',
            'bio' => 'Oche Solomon is a tech expert with a focus on innovation.',
            'image_path' => 'asset/images/Oche.png',
            'order_column' => 2,
            'is_active' => true,
            'created_at' => now()
        ],
        [
            'name' => 'Aaron Aniebiet',
            'position' => 'CTO & Co-founder',
            'bio' => 'Aaron is a tech expert with a focus on innovation.',
            'image_path' => 'asset/images/Aaron.png',
            'order_column' => 3,
            'is_active' => true,
            'created_at' => now()
        ],
        [
            'name' => 'Richard John',
            'position' => 'CFO & Co-founder',
            'bio' => 'Richard is a tech expert with a focus on innovation.',
            'image_path' => 'asset/images/Richard-removebg-preview.png',
            'order_column' => 4,
            'is_active' => true,
            'created_at' => now()
        ],            
     ];

        Founder::insert($founder_info);
    }
}
