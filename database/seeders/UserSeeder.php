<?php

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'Jyothi A H',
                'email' => 'ahjyothi.1994@gmail.com',
                'password' => Hash::make('jAdmin1@3&4'), // Encrypt the password
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'B Vikas Chandra',
                'email' => 'chandravikasa38@gmail.com',
                'password' => Hash::make('vcAdmin1@3&4'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Manikanta Talanki',
                'email' => 'manikanta.t341@gmail.com',
                'password' => Hash::make('mAdmin1@3&4'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

