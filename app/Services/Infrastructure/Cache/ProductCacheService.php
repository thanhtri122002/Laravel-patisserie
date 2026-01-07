<?php

namespace App\Services\Infrastructure\Cache;

class ProductCacheService extends CacheService
{
    protected string $prefix = 'products:';

    protected function tags(): array
    {
        return ['products'];
    }

    public function statistic(string $key, int $ttl, \Closure $callback)
    {
        return $this->remember("stats:$key", $ttl, $callback);
    }

    public function statisticFlexible(string $key, array $ttl, \Closure $callback)
    {
        return $this->flexible("stats:$key", $ttl, $callback);
    }

    public function flushProducts(): void
    {
        $this->flush();
    }
}
