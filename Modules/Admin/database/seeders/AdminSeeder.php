<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        // Check if admin already exists by unique field (e.g., username or email)
        $existing = User::where('username', 'superadmin')->first();

        if (!$existing) {
            User::create([
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'email' => 'admin@eureka.test',
                'phone' => '08000000000',
                'mobile' => '08000000000',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'username' => 'superadmin',
                'status' => 1,
                'interest' => 'Education, Technology',
                'balance' => 1000.0,
                'about' => 'Administrator for the system',
                'address' => '123 Admin Streett, Lagos, Nigeria',
                'ev' => 1,
                'sv' => 1,
                'tv' => 1,
                'ts' => 0,
                'image' => 'admin.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $this->command->info('✅ Super Admin created successfully.');
        } else {
            $this->command->info('ℹ️ Super Admin already exists. No duplicate created.');
        }
    }
}
