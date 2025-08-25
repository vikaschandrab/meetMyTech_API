<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds - Admin user only.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // Check if admin user already exists
        $adminExists = DB::table('users')->where('email', 'admin@meetmytech.com')->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => 'admin@meetmytech.com',
                'password' => Hash::make('AdminMTech@2025!'),
                'user_type' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            echo "Admin user created successfully!\n";
            echo "Email: admin@meetmytech.com\n";
            echo "Password: AdminMTech@2025!\n";
        } else {
            echo "Admin user already exists!\n";
        }
    }
}
