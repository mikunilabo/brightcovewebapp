<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

final class Refresh extends Command
{
    /**
     * @var string
     */
    protected $signature = 'refresh
                        {--c|cache : Cache again after deleting.}
                        {--d|dumpautoload : Perform autoloading with composer.}';

    /**
     * @var string
     */
    protected $description = 'Execute the refresh commands.';

    /**
     * @var Composer
     */
    private $composer;

    /**
     * @param Composer $composer
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobs = 7;
        $jobs += $this->option('dumpautoload') ? 1 : 0;
        $progress = $this->output->createProgressBar($jobs);

        $this->comment('Refreshing...');

        $this->callSilent('down');
        $progress->advance();

        $this->callSilent('clear-compiled');
        $progress->advance();

        $this->callSilent('cache:clear');
        $progress->advance();

        $this->callSilent('view:clear');
        $progress->advance();

        if ($this->option('cache')) {
            $this->callSilent('config:cache');
            $progress->advance();

            $this->callSilent('route:cache');
            $progress->advance();
        } else {
            $this->callSilent('config:clear');
            $progress->advance();

            $this->callSilent('route:clear');
            $progress->advance();
        }

        if ($this->option('dumpautoload')) {
            $this->composer->dumpAutoloads();
            $progress->advance();
        }

        $this->callSilent('up');
        $progress->finish();

        $this->line('');
        $this->comment('Some refresh commands are executed!');
    }
}
