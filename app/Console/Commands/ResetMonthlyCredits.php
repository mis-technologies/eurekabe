<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Common\Models\UserCreditAccount;
use Modules\Common\Services\CreditService;

class ResetMonthlyCredits extends Command
{
    protected $signature   = 'credits:monthly-reset';
    protected $description = 'Reset monthly credit allowances for all accounts where next_reset_at is past.';

    public function handle(CreditService $credits): int
    {
        $overdue = UserCreditAccount::where('next_reset_at', '<=', now())->get();

        if ($overdue->isEmpty()) {
            $this->info('No accounts due for reset.');
            return self::SUCCESS;
        }

        $this->info("Found {$overdue->count()} account(s) due for reset.");
        $bar = $this->output->createProgressBar($overdue->count());
        $bar->start();

        $resetCount = 0;
        foreach ($overdue as $account) {
            try {
                $credits->resetMonthlyCredits($account);
                $resetCount++;
            } catch (\Throwable $e) {
                $this->newLine();
                $this->warn("Account #{$account->id} (user #{$account->user_id}) failed: {$e->getMessage()}");
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Done. Reset {$resetCount} account(s).");

        return self::SUCCESS;
    }
}
