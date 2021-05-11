<?php

namespace App\Facades;

use App\Contracts\CounterContract;
use Illuminate\Support\Facades\Facade;

class CounterFacade extends Facade
{
    /**
     * @method static int increment(string $key, array $tags = null)
     */
    static public function getFacadeAccessor()
    {
        return CounterContract::class;
    }
}
