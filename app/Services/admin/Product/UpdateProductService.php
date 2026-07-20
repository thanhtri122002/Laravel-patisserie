<?php

namespace App\Services\admin\Product;


use App\Services\Domain\Product\ProductWriter;
use App\Services\Infrastructure\Cache\ProductCacheService;
use Illuminate\Support\Facades\DB;

class UpdateProductService
{
    public function __construct(
        protected ProductWriter $writer,
        protected ProductCacheService $cache
    ) {}

    public function execute(int $id, array $data): bool
    {
        return DB::transaction(function () use ($id, $data) {
            $updated = $this->writer->update($id, $data);
            $this->cache->flushProducts();
            return $updated;
        });
    }
}