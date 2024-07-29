<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SystemInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing System Laravel...');
        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');
        $this->info('Install System Laravel Success');
    }
}
