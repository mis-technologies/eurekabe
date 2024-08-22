<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'admin@eureka.live',
                'phone' => '08012345678',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Default password
                'username' => 'admin123',
                'interest' => 'Education, Technology',
                'about' => 'Administrator for the system',
                'mobile' => '08012345678',
                'ref_by' => null,
                'balance' => 1000.00,
                'image' => 'admin.jpg',
                'address' => '123 Admin Street, Lagos, Nigeria',
                'status' => true,
                'ev' => true,
                'sv' => true,
                'ver_code' => null,
                'ver_code_send_at' => null,
                'ts' => false,
                'tv' => true,
                'tsc' => null,
                'provider' => null,
                'provider_id' => null,
            ],
            [
                'firstname' => 'Advocate',
                'lastname' => 'User',
                'email' => 'advocate@eureka.live',
                'phone' => '08087654321',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Default password
                'username' => 'advocate123',
                'interest' => 'Law, Advocacy',
                'about' => 'Advocate user for the system',
                'mobile' => '08087654321',
                'ref_by' => null,
                'balance' => 500.00,
                'image' => 'advocate.jpg',
                'address' => '456 Advocate Street, Abuja, Nigeria',
                'status' => true,
                'ev' => true,
                'sv' => true,
                'ver_code' => null,
                'ver_code_send_at' => null,
                'ts' => false,
                'tv' => true,
                'tsc' => null,
                'provider' => null,
                'provider_id' => null,
            ],
            [
                'firstname' => 'Student',
                'lastname' => 'User',
                'email' => 'student@eureka.live',
                'phone' => '08098765432',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Default password
                'username' => 'student123',
                'interest' => 'Learning, Research',
                'about' => 'Student user for the system',
                'mobile' => '08098765432',
                'ref_by' => null,
                'balance' => 300.00,
                'image' => 'student.jpg',
                'address' => '789 Student Street, Kaduna, Nigeria',
                'status' => true,
                'ev' => true,
                'sv' => true,
                'ver_code' => null,
                'ver_code_send_at' => null,
                'ts' => false,
                'tv' => true,
                'tsc' => null,
                'provider' => null,
                'provider_id' => null,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
