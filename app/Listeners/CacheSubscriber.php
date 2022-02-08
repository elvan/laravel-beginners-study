<?php

namespace App\Listeners;

use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CacheSubscriber
{
    public function handleCacheHit(CacheHit $event)
    {
        Log::info("{$event->key} cache hit");
    }

    public function handleCacheMissed(CacheMissed $event)
    {
        Log::info("{$event->key} cache missed");
    }

    public function subscribe($events)
    {
        $events->listen(
            CacheHit::class,
            [static::class, 'handleCacheHit']
        );

        $events->listen(
            CacheMissed::class,
            [static::class, 'handleCacheMissed']
        );
    }
}
