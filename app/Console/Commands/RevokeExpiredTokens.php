<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class RevokeExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:revoke-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revoke expired Sanctum tokens';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        PersonalAccessToken::where('expires_at', '<', now())->delete();
        $this->info('Expired tokens revoked successfully.');
    }
}
