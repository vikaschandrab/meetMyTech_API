<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogSubscriber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BlogSubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Log::info('Starting blog subscriber seeder');

        // Get all users with user_type 'user'
        $users = User::where('user_type', 'user')
                    ->where('status', 'active')
                    ->whereNotNull('email')
                    ->get();

        $subscribed = 0;
        $skipped = 0;

        foreach ($users as $user) {
            // Check if email already exists in blog_subscribers
            $existingSubscriber = BlogSubscriber::where('email', $user->email)->first();

            if (!$existingSubscriber) {
                // Create new subscription
                BlogSubscriber::create([
                    'email' => $user->email,
                    'is_subscribed' => true,
                    'subscribed_at' => $user->created_at ?? now(),
                    'ip_address' => null, // No IP data for existing users
                    'user_agent' => 'Migrated from existing users',
                ]);

                $subscribed++;
                Log::info("Subscribed user: {$user->email}");
            } else {
                $skipped++;
                Log::info("Skipped existing subscriber: {$user->email}");
            }
        }

        Log::info("Blog subscriber seeder completed", [
            'total_users' => $users->count(),
            'subscribed' => $subscribed,
            'skipped' => $skipped
        ]);

        $this->command->info("✅ Blog subscriber seeder completed!");
        $this->command->info("📊 Total users processed: {$users->count()}");
        $this->command->info("✅ New subscriptions created: {$subscribed}");
        $this->command->info("⏭️ Existing subscriptions skipped: {$skipped}");
    }
}
