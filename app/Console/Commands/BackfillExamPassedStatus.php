<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Student\Models\StudentExam;

class BackfillExamPassedStatus extends Command
{
    protected $signature   = 'exams:backfill-passed';
    protected $description = 'Recompute and save the passed flag for all submitted exams that have a null/stale value.';

    public function handle(): int
    {
        $exams = StudentExam::whereIn('status', ['submitted', 'result_released'])
            ->whereNull('passed')
            ->with('exam')
            ->get();

        $this->info("Found {$exams->count()} exam(s) with missing passed status.");

        $bar = $this->output->createProgressBar($exams->count());
        $bar->start();

        $fixed = 0;
        foreach ($exams as $se) {
            try {
                $se->result(); // recomputes and saves passed, marks, etc.
                $fixed++;
            } catch (\Throwable $e) {
                $this->newLine();
                $this->warn("StudentExam #{$se->id} failed: {$e->getMessage()}");
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Done. Fixed {$fixed} exam(s).");

        return self::SUCCESS;
    }
}
