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
    protected $description = 'Execute the refresh commands.';

    /**
     * @var string
     */
    protected $signature = 'refresh
                        {--c|cache : Cache again after deleting.}
                        {--d|dumpautoload : Perform autoloading with composer.}
                        {--f|force : Force without confirmation.}
                        {--i|info : Output the processing contents.}';

    /**
     * @param Composer $composer
     * @return mixed
     */
    public function handle(Composer $composer)
    {
        $jobs = 5;

        $isChache = false;
        if ($this->option('cache')
            || (! $this->option('force') && $this->confirm('Do you want to cache configuration files? (y/n) or'))
        ) {
            $isChache = true;
        }

        $isDump = false;
        if ($this->option('dumpautoload')
            || (! $this->option('force') && $this->confirm('Do you want to execute class autoloading?'))
        ) {
            $isDump = true;
            $jobs += 1;
        }

        $progress = $this->output->createProgressBar($jobs);

        $isInfo = $this->option('info');
        $call = $isInfo ? 'call' : 'callSilent';

        $this->comment('Refreshing...');
        $this->{$call}('down');

        $this->{$call}('clear-compiled');
        $progress->advance();
        $isInfo ? $this->line('') : null;

        $this->{$call}('cache:clear');
        $progress->advance();
        $isInfo ? $this->line('') : null;

        $this->{$call}('view:clear');
        $progress->advance();
        $isInfo ? $this->line('') : null;

        if ($isChache) {
            $this->{$call}('config:cache');
            $progress->advance();
            $isInfo ? $this->line('') : null;

            $this->{$call}('route:cache');
            $progress->advance();
            $isInfo ? $this->line('') : null;
        } else {
            $this->{$call}('config:clear');
            $progress->advance();
            $isInfo ? $this->line('') : null;

            $this->{$call}('route:clear');
            $progress->advance();
            $isInfo ? $this->line('') : null;
        }

        if ($isDump) {
            $isInfo ? $this->info('Class autoload files dumping...') : null;
            $composer->dumpAutoloads();
            $isInfo ? $this->info('Done dumping!') : null;
            $progress->advance();
        }

        $this->info('');
        $this->{$call}('up');
        $this->comment('Some refresh commands are executed!');
    }
}
