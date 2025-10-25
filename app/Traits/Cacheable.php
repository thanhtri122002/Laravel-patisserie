<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait Cacheable {

    protected function rememberCache($key, $callback) 
    {
        return Cache::flexible($key, [60, 600], $callback);
    }

    protected function forgetCache($key)
    {
        return Cache::forget($key);
    }

    protected function storeForeverCache($key, $value)
    {
        return Cache::forever($key, $value);
    }

}