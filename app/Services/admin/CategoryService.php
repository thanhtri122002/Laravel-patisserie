<?php

namespace App\Services\admin;

use App\Models\Category;
use App\Services\Service;

class CategoryService extends Service {

    private function getCategory($id) {
        return Category::findOrFail($id);
    }

    public function index() {
        $categories = Category::with('products')->all();
        
        return $categories;
    }

    public function create($data) {
        $category = Category::create($data);

        return $category;
    }

    public function update($data, $id) {
        $category = $this->getCategory($id);
        $category->update($data);

        return true;
    }

    public function delete($id) {
        $category = $this->getCategory($id);
        $category->delete();

        return true;
    }

}


