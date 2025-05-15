<?php 

namespace App\Services\admin;

use App\Models\Product;
use App\Services\Service;

class ProductService extends Service {

    protected function getProduct($id) {

        return Product::with(['category', 'productImages'])->findOrFail($id);
    }

    public function index($categoryId = null ,$perPage = null) {

        $query = Product::with(['category', 'productImages']);

        if($categoryId) {
            $query->where('category_id', $categoryId);
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

    public function update($data, $id) {
        $product = $this->getProduct($id);
        $updateProduct = $product->update($data);
    }

    public function delete($id){
        $product = $this->getProduct($id);
        $product->delete();
    }
}