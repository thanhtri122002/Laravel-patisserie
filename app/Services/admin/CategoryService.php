<?php

namespace App\Services\admin;

use App\Models\Category;
use App\Services\Service;

class CategoryService extends Service
{

    public function getBaseQuery()
    {
        return Category::with('products.productImages');
    }
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
     * Get categories with their products and product images.
     *
     * If $perPage is provided, results are paginated.
     *
     * @param  int|null  $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(?int $perPage = null, ?string $search, ?int $page)
    {
        // $query = Category::with('products.productImages');

        // if ($perPage !== null) {
        //     return $query->paginate($perPage);
        // }

        // return $query->get();
        $query = $this->getBaseQuery();

        if(!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        } 

        if (!empty($page)) {
            return $query->paginate($perPage);
        }
    
        return $query->get();
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

    public function update($data, $id)
    {
        $category = $this->getCategory($id);
        $category->update($data);

        return true;
    }

    public function delete($id)
    {
        $category = $this->getCategory($id);
        $category->delete();

        return true;
    }
}
