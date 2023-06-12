<?php

namespace App\Console\Commands;

use App\Models\UserToken;
use Illuminate\Console\Command;

class ClearExpiredTokensCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:clear-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes expired tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UserToken::where('expires_at', '<=', now())->delete();
    }
}
