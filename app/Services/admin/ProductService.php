<?php 

namespace App\Services\admin;

use App\Models\Invoice;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService extends Service {
    /**
     * Summary of getProduct
     * @param mixed $id
     * @return Product|\Illuminate\Database\Eloquent\Collection<int, Product>
     */
    public function getProduct($id) {

        $product = Product::with(['category', 'productImages'])->findOrFail($id);
        $product->productImages->map(function($img){
            $img->url = asset(Storage::url($img->url));
            return $img;
        });

        return $product;
    }

    protected function baseQuery()
    {
        return Product::with(['category', 'productImages']);
    }

    public function productIndex($data, $perPage)
    {     
        return $this->baseQuery()
            ->when(isset($data['min_price'], $data['max_price']), fn($q) =>
                $q->getProductsInPriceRange($data['min_price'], $data['max_price'])
            )
            ->when(!empty($data['input_search']), fn($q) =>
                $q->getProductsBySearching($data['input_search'])
            )
            ->when(!empty($data['category_ids']), fn($q) =>
                $q->whereIn('category_id', $data['category_ids'])
            )
            
            ->paginate($perPage);
    }

    public function detail($id) 
    {
        $product = $this->getProduct($id);

        return $product;
    }
    /**
     * Summary of store
     * Store a new product
     * 
     * @param array $data
     * 
     * @return Product
     */
     
    public function store($data) 
    {
        $product = Product::create($data);

        return $product;
    }

    /**
     * A function used to update an existing product
     * 
     * This function takes an array data which contains the update information
     * of an existing product which will be find by the id
     * 
     * @param array $data
     * @param int $id
     */
    public function update($data, $id) 
    {
        $product = $this->getProduct($id);
        $updateProduct = $product->update($data);

        return $updateProduct;
    }

    /**
     * A function used to delete a product 
     * 
     * @param int $id id of the product
     * 
     * @return bool
     */
    public function delete($id): bool
    {
        $product = $this->getProduct($id);
        $product->delete();

        return true;
    }


    // public function getCurrentMonthNewProduct ()
    // {
    //     $currentMonth = now()->month;

    //     return Product::whereMonth('created_at', $currentMonth)->get();

    // }

    // public function getOutOfStockProduct ()
    // {
    //     return Product::where('stock', 0)->get();
    // }

    // public function getDisCountProduct()
    // {
    //     return Product::where('discount', '>', 0.0)->get();
    // }

}


