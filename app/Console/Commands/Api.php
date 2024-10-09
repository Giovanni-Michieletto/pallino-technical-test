<?php

namespace App\Console\Commands;

use App\Jobs\SyncOffersJob;
use App\Jobs\SyncShopsJob;
use Illuminate\Console\Command;

class Api extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:api
        {--cmd=none : sync_shops|sync_offers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data
        sync_shops : sync shop data
        sync_offers : sync offes data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cmd = $this->option('cmd');

        if ($cmd == 'sync_shops') {
            return $this->doSyncShop();
        }
        if ($cmd == 'sync_offers') {
            return $this->doSyncOffer();
        }
    }

    public function doSyncShop()
    {
        $this->info('SyncShopsJob dispatched');
        SyncShopsJob::dispatch();
        return Command::SUCCESS;
    }

    public function doSyncOffer()
    {
        $this->info('SyncOffersJob dispatched');
        SyncOffersJob::dispatch();
        return Command::SUCCESS;
    }
}
