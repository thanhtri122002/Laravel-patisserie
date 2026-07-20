<?php

namespace App\Services\admin\Product;

use App\Services\Domain\Product\ProductReader;
use App\Services\Infrastructure\Cache\ProductCacheService;

class ListProductsService
{
    public function __construct(
        protected ProductReader $reader,
        protected ProductCacheService $cache
    ) {}

    public function execute(array $filters, int $perPage)
    {
        $hash = md5(json_encode([$filters, $perPage]));

        return $this->cache->productList(
            $hash,
            fn () => $this->reader->paginated($filters, $perPage)
        );
    }
}