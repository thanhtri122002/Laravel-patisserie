<?php

namespace App\Services\Domain\Product;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class ProductStatistic
{
    protected function baseQuery()
    {
        return Product::with(['category', 'productImages']);
    }

    public function getNewProduct(int $limit)
    {
        return Product::latest()->limit($limit)->get();
    }

    public function getProductsInPriceRange(float $priceLimit, string $order = 'asc')
    {
        return Product::where('price', '<', $priceLimit)
            ->orderBy('price', $order)
            ->get();
    }

    public function getProductsCounts(): int
    {
        return Product::count();
    }

    public function getNewInthisMonth()
    {
        return Product::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get(['id', 'name']);
    }

    public function getTopSelling(int $limit)
    {
        return Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->select('products.id', 'products.name')
            ->selectRaw('SUM(product_details.quantity) as total_sold')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();
    }

    public function getMostProfitableProducts(int $limit)
    {
        return Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->select('products.id', 'products.name')
            ->selectRaw('SUM(product_details.cost) as total_profit')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_profit')
            ->limit($limit)
            ->get();
    }

    public function getLowStock(int $threshold = 20)
    {
        return Product::where('stock', '<', $threshold)->orderBy('stock')->get();
    }

    public function getRevenueThisMonth(int $productId)
    {
        return ProductDetail::join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->whereMonth('invoices.created_at', now()->month)
            ->whereYear('invoices.created_at', now()->year)
            ->selectRaw('SUM(product_details.cost) as total_revenue')
            ->value('total_revenue');
    }

    public function getWeeklySalesLast4Weeks(int $productId)
    {
        return ProductDetail::join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->whereBetween('invoices.created_at', [
                now()->subWeeks(4)->startOfWeek(),
                now()->endOfWeek()
            ])
            ->selectRaw('YEARWEEK(invoices.created_at, 1) as week, SUM(product_details.quantity) as total')
            ->groupBy('week')
            ->orderBy('week')
            ->get();
    }

    public function countProductVisit(int $productId): int
    {
        return Visit::where('url', "home/products/$productId")->count();
    }

    public function getConversionRate(int $productId): float
    {
        $purchases = ProductDetail::where('product_id', $productId)->count();
        $visits = $this->countProductVisit($productId);

        return $visits === 0 ? 0 : round(($purchases / $visits) * 100, 2);
    }

    public function getSoldThisMonth(int $productId)
    {
        return ProductDetail::join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->whereMonth('invoices.created_at', now()->month)
            ->whereYear('invoices.created_at', now()->year)
            ->sum('product_details.quantity');
    }

    public function getUserRepeatPurchase(int $productId)
    {
        return ProductDetail::join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->join('users', 'users.id', '=', 'invoices.user_id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->groupBy('users.id', 'users.name')
            ->havingRaw('COUNT(DISTINCT invoices.id) >= 2')
            ->get(['users.id', 'users.name']);
    }

    public function countRepeatedPurchasingUsers(int $productId): int
    {
        return ProductDetail::join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->groupBy('invoices.user_id')
            ->havingRaw('COUNT(DISTINCT invoices.id) >= 2')
            ->count();
    }
    public function getSeasonNalProd()
{
    $currentMonth = now()->month;
    $currentYear  = now()->year;

    $seasons = [
        [1, 2, 3],   // spring
        [4, 5, 6],   // summer
        [7, 8, 9],   // autumn
        [10, 11, 12] // winter
    ];

    $currentSeason = collect($seasons)
        ->first(fn ($season) => in_array($currentMonth, $season));

    return Product::whereIn(DB::raw('MONTH(created_at)'), $currentSeason)
        ->whereYear('created_at', $currentYear)
        ->get();
}
public function getTopSellingTrend(int $limit = 5)
{
    $topProducts = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
        ->join('invoices', 'invoices.id', '=', 'product_details.invoice_id')
        ->where('invoices.status', Invoice::PAID)
        ->select(
            'products.id',
            DB::raw('SUM(product_details.cost) as total_profit')
        )
        ->groupBy('products.id')
        ->orderByDesc('total_profit')
        ->limit($limit);

    $trend = Product::joinSub($topProducts, 'top_products', function ($join) {
            $join->on('products.id', '=', 'top_products.id');
        })
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->join('invoices', 'invoices.id', '=', 'product_details.invoice_id')
        ->where('invoices.status', Invoice::PAID)
        ->whereYear('invoices.created_at', now()->year)
        ->selectRaw('
            products.id,
            products.name,
            MONTH(invoices.created_at) as month,
            SUM(product_details.cost) as total_profit
        ')
        ->groupBy('products.id', 'products.name', 'month')
        ->orderBy('products.name')
        ->orderBy('month')
        ->get();

    return $trend
        ->groupBy('id')
        ->map(function ($product) {
            $data = array_fill(0, 12, 0);

            foreach ($product as $row) {
                $data[$row->month - 1] = (float) $row->total_profit;
            }

            return [
                'id'   => $product[0]->id,
                'name' => $product[0]->name,
                'data' => $data,
            ];
        })
        ->values();
}
public function getLowProfit(int $limit, int $threshold)
{
    return Product::join('product_details', 'product_details.product_id', '=', 'products.id')
        ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
        ->where('invoices.status', Invoice::PAID)
        ->select(
            'products.id',
            'products.name',
            DB::raw('SUM(product_details.quantity) as total_sold')
        )
        ->groupBy('products.id', 'products.name')
        ->having('total_sold', '<', $threshold)
        ->orderBy('total_sold', 'asc')
        ->limit($limit)
        ->get();
}
public function getProductsBySearching(string $keyword)
{
    $pattern = '%' . $keyword . '%';

    return Product::where(function ($query) use ($pattern) {
        $query->where('name', 'LIKE', $pattern)
            ->orWhereHas('category', function ($q) use ($pattern) {
                $q->where('name', 'LIKE', $pattern);
            });
    })->get();
}
public function getNewProds(int $limit)
{
    return $this->getNewProduct($limit);
}


}
