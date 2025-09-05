<?php 

namespace App\Services\admin;

use App\Models\Invoice;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;

class ProductService extends Service {

    
    protected function getProduct($id) {

        return Product::with(['category', 'productImages'])->findOrFail($id);
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


    public function index($categoryIds = [] ,$perPage = null) {

        $query = Product::with(['category', 'productImages']);
        
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

    public function getNewProduct($limit)
    {
        return Product::orderBy('created_at', 'desc')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Return all the products having price below the $priceLimit
     * 
     * @param float $priceLimt
     * @param string $order 
     * 
     * @return \Illuminate\Database\Eloquent\Collection   
     */
    public function getProductsInPriceRange($priceLimit, $order = 'asc') 
    {
        return Product::where('price' , '<', $priceLimit)
                    ->orderBy('price', $order)
                    ->get();
    }
    /**
     * Retrieve the top selling products
     * 
     * Return the products that have 
     * 
     * @param int $limit 
     * 
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getTheTopSellingProduct($limit)
    {   
        return Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                    ->join('invoices', 'product_details.invoice_id', 'invoices.id')
                    ->where('invoices.status', Invoice::PAID)
                    ->select(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.description'
                    )
                    ->selectRaw('SUM(product_details.quantity) as total_sold')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.description'
                    )
                    ->orderby('total_sold', 'desc')
                    ->limit($limit)
                    ->get();
    }

    public function getProductsBySearching($inputString)
    {   
        $pattern = '%' . $inputString . '%';

        return Product::where(function ($product)  use ($pattern) {

            $product->whereLike('name', $pattern)
                    ->orWhereHas('category', function ($category) use ($pattern) {

                        $category->whereLike('name', $pattern);
                    });
        })->get();
    }

    public function getMostProfitableProduct($limit)
    {
        return Product::join('product_details', 'product.id', '=', 'product_details.product_id')
                        ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
                        ->where('invoices.status', Invoice::PAID)
                        ->selectRaw('SUM(product_details.cost) as total_profit')
                        ->groupBy('product.id')
                        ->orderByDesc('total_profit')
                        ->limit($limit)
                        ->get();
    }

    public function getCurrentMonthNewProduct()
    {
        $currentMonth = now()->month;

        return Product::whereMonth('created_at', $currentMonth)->get();

    }

    public function getOutOfStockProduct()
    {
        return Product::where('quantity', 0)->get();
    }

    public function getDisCountProduct()
    {
        return Product::where('discount', '>', 0.0)->get();
    }

}


