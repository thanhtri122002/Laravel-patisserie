<?php

namespace App\Services\Domain\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductReader
{
    public function findById(int $id): Product
    {
        $product = Product::with(['category', 'productImages'])->findOrFail($id);

        $product->productImages->each(function ($img) {
            $img->url = asset(Storage::url($img->url));
        });

        return $product;
    }

    public function paginated(array $filters, int $perPage)
    {
        return Product::with(['category', 'productImages'])
            ->when(isset($filters['min_price'], $filters['max_price']), fn ($q) =>
                $q->getProductsInPriceRange($filters['min_price'], $filters['max_price'])
            )
            ->when(!empty($filters['input_search']), fn ($q) =>
                $q->getProductsBySearching($filters['input_search'])
            )
            ->when(!empty($filters['category_ids']), fn ($q) =>
                $q->whereIn('category_id', $filters['category_ids'])
            )
            ->paginate($perPage);
    }
}