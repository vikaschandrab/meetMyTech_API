<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class FixUserSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:fix-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix missing or empty user slugs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing user slugs...');

        $usersWithoutSlugs = User::whereNull('slug')
            ->orWhere('slug', '')
            ->get();

        if ($usersWithoutSlugs->count() === 0) {
            $this->info('All users already have slugs!');
            return;
        }

        $this->info("Found {$usersWithoutSlugs->count()} users without slugs.");

        $bar = $this->output->createProgressBar($usersWithoutSlugs->count());
        $bar->start();

        foreach ($usersWithoutSlugs as $user) {
            $slug = $this->generateUniqueSlug($user->name);
            $user->slug = $slug;
            $user->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('User slugs have been fixed successfully!');
    }

    /**
     * Generate unique slug from name
     */
    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
