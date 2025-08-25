<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // Check if test user already exists
        $testExists = DB::table('users')->where('email', 'test@example.com')->exists();

        if (!$testExists) {
            DB::table('users')->insert([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'user_type' => 'user',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            echo "Test user created successfully!\n";
            echo "Email: test@example.com\n";
            echo "Password: password\n";
        } else {
            echo "Test user already exists!\n";
        }
    }
}
