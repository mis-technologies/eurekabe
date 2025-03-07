<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\HomePageSeeder;
use App\Models\HomePage;
use Database\Seeders\EventSeeder;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(UserSeeder::class);
       $this->call(HomePageSeeder::class);
       $this->call(EventSeeder::class);
       $this->call([
            CategorySeeder::class,
            BlogSeeder::class,
        ]);
    }
}
