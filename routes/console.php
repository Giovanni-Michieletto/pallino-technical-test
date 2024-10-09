<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:api --cmd=sync_shops')->everyMinute()->withoutOverlapping();
Schedule::command('app:api --cmd=sync_offers')->everyMinute()->withoutOverlapping();

Schedule::command('queue:work ' . config('queue.default') . ' --max-jobs=15 --timeout=180 --max-time=230 --stop-when-empty')->everyMinute()->withoutOverlapping();
