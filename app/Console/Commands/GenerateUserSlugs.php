<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class GenerateUserSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing users based on their names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for existing users...');

        $users = User::whereNull('slug')->get();
        
        if ($users->isEmpty()) {
            $this->info('No users found without slugs.');
            return;
        }

        $bar = $this->output->createProgressBar($users->count());
        $bar->start();

        foreach ($users as $user) {
            $user->slug = $user->generateSlug($user->name);
            $user->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Successfully generated slugs for {$users->count()} users.");
    }
}
