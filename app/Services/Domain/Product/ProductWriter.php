<?php

namespace App\Services\Domain\Product;

use App\Models\Product;

class ProductWriter
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Product::findOrFail($id)->update($data);
    }

    public function delete(int $id): bool
    {
        Product::findOrFail($id)->delete();
        return true;
    }
}
