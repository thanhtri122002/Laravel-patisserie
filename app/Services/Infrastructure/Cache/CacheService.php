<?php

namespace App\Services\Infrastructure\Cache;

use Illuminate\Support\Facades\Cache;

abstract class CacheService
{
    protected string $prefix = '';

    protected function remember(string $key, int $ttl, \Closure $callback)
    {
        return Cache::tags($this->tags())->remember(
            $this->prefix . $key,
            $ttl,
            $callback
        );
    }

    protected function flexible(string $key, array $ttl, \Closure $callback)
    {
        return Cache::tags($this->tags())->flexible(
            $this->prefix . $key,
            $ttl,
            $callback
        );
    }


    protected function forget(string|array $keys): void
    {
        foreach ((array) $keys as $key) {
            Cache::forget($this->prefix . $key);
        }
    }

    protected function flush(): void
    {
        Cache::tags($this->tags())->flush();
    }

    protected function tags(): array
    {
        return [];
    }
}
