<?php

namespace App\Jobs;

use App\Jobs\BaseJob;
use Illuminate\Bus\Queueable;
use App\Services\OfferService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncOffersJob extends BaseJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    protected $label = "SyncOffersJob";

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug($this->label);
        app(OfferService::class)->sync();
    }
}
