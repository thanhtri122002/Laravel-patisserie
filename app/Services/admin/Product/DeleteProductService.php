<?php

namespace App\Services\admin\Product;

use App\Services\Domain\Product\ProductWriter;
use App\Services\Infrastructure\Cache\ProductCacheService;
use Illuminate\Support\Facades\DB;

class DeleteProductService
{
    public function __construct(
        protected ProductWriter $writer,
        protected ProductCacheService $cache
    ) {}

    public function execute(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $this->writer->delete($id);
            $this->cache->flushProducts();
            return true;
        });
    }
}