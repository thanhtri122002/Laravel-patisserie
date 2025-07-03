<?php

namespace App\Services\admin;

use App\Models\Category;
use App\Services\Service;

class CategoryService extends Service {

    /**
     * A function to get the Category instance by its id 
     * 
     * @param int $id
     * 
     * @return \App\Models\Category 
     */
    private function getCategory($id): Category
    {
        return Category::findOrFail($id);
    }

    /**
     * A function get the categories along its products + productsImages
     * 
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function index() 
    {
        $categories = Category::with('products.productImages')->get();
        
        return $categories;
    }

    /**
     * A function creating the new Category 
     * 
     * Expected keys in array 
     * - name (string)
     * 
     * @param array $data 
     * 
     * @return \App\Models\Category 
     */
    public function create($data): Category
    {
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


