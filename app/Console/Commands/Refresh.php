<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh {--c|cache : Cache again after deleting.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the refresh commands.';

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
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Refreshing...');
        $this->call('clear-compiled');
        $this->call('cache:clear');

        if ($this->option('cache')) {
            $this->call('config:cache');
            $this->call('route:cache');
        } else {
            $this->call('config:clear');
            $this->call('route:clear');
        }

        $this->call('view:clear');
        $this->comment('Refresh commands executed!');
    }
}
