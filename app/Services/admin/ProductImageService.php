<?php

namespace App\Services\admin;

use App\Models\ProductImage;
use App\Services\Service;

class ProductImageService extends Service {


    public function index() {
        return ProductImage::with('product')->get();
    }


    public function detail($id) {
        return ProductImage::with('products')->findOrFail($id);
    }

    public function store($data) {
        $image = ProductImage::create($data);
        return $image;
    }

    public function update($data, $id) {
        $image = $this->detail($id);
        $image->update($data);
        return $image;
    }

    public function delete($id) {
        $image = $this->detail($id);
        $image->delete();
    }
        
}