<?php

namespace App\Services\admin\Product;

use App\Services\Domain\Product\ProductWriter;
use App\Services\Infrastructure\Cache\ProductCacheService;
use Illuminate\Support\Facades\DB;

class CreateProductService
{
    public function __construct(
        protected ProductWriter $writer,
        protected ProductCacheService $cache
    ) {}

    public function execute(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->writer->create($data);
            $this->cache->flushProducts();
            return $product;
        });
    }
}