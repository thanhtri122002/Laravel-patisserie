<?php 

namespace App\Services\admin;

use App\Models\Product;
use App\Services\Service;

class ProductService extends Service {

    protected function getProduct($id) {

        return Product::with(['category', 'productImages'])->findOrFail($id);
    }

    public function index($categoryIds = [] ,$perPage = null) {

        $query = Product::with(['category', 'productImages']);
        //logger()->info('Category IDs received:', ['categoryIds' => $categoryIds]);
        if(!empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        return $query->paginate($perPage);
    }

    public function detail($id) {
        $product = $this->getProduct($id);

        return $product;
    }

    public function store($data) {

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
    public function update($data, $id) {
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
}