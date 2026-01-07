<?php

namespace App\Services\admin\AdminDashboard;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Visit;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class ProductStatsService extends Service
{
    /**
     * Return the number of products 
     * 
     * @return int
     */
    public function getProductsCounts(): int
    {
        return Product::count();
    }
    
    public function getNewInthisMonth()
    {
        $currentMonth = now()->month();
        $currentYear = now()->year();

        return Product::select('name')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();
    }
    private function getSeason($currentMonth)
    {
        $seasons = [
            'spring' => [1, 2, 3],
            'summer' => [4, 5, 6],
            'autumn' => [7, 8, 9],
            'winter' => [10, 11, 12],
        ];

        foreach ($seasons as $season) {
            if (in_array($currentMonth, $season)) {
                return $season;
            }
        }
    }
    public function getSeasonNalProd()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $seasons = $this->getSeason($currentMonth);

        return Product::whereIn(DB::raw('MONTH(created_at)'), $seasons)->whereYear('created_at', $currentYear)->get();
    }
    public function getNewProds(int $limit)
    {
        return Product::orderBy('created_at', 'desc')->limit($limit)->get();
    }
    public function getMostProfitableProduct()
    {
        return Product::select('products.id', 'products.name')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->selectRaw('SUM(product_details.cost) as total_revenue')
            ->limit(3)
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

        $topSellingTrend =  Product::joinSub($topProducts, 'top_products', function ($join) {
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
                SUM(product_details.quantity) as total_sold,
                SUM(product_details.cost) as total_profit
            ')
            ->groupBy(
                'products.id',
                'products.name',
                'month'
            )
            ->orderBy('products.name')
            ->orderBy('month')
            ->get();

        return $topSellingTrend
            ->groupBy('id')
            ->map(function ($product) {

                $data = array_fill(0, 12, 0);

                foreach ($product as $row) {
                    $data[$row->month - 1] = (float) $row->total_profit;
                }

                return [
                    'id' => $product[0]->id,
                    'name' => $product[0]->name,
                    'data' => $data,
                ];
            })
            ->values();
    }

    public function getTopSelling(int $limit)
    {
        return Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'invoices.id', '=', 'product_details.invoice_id')
            ->where('invoices.status', Invoice::PAID)
            ->select('products.name', 'products.id')
            ->selectRaw('SUM(product_details.cost) as total_profit')
            ->groupBy('products.name', 'products.id')
            ->orderBy('total_profit', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getLowStock(int $threshold = 20)
    {
        return Product::where('stock', '<', $threshold)->orderBy('stock', 'asc')->get();
    }
    public function getLowProfit(int $limit, int $threshold)
    {
        return Product::join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->select(
                'products.id',
                'products.name',
                'SUM(product_details.quantity) as total_sold'
            )
            ->groupBy('products.id', 'products.name')
            ->having('total_sold', '<', $threshold)
            ->orderBy('total_sold', 'asc')
            ->limit($limit)
            ->get();
    }

    public function getRevenueThisMonth($id)
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        return Product::where('products.id', $id)
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->select('products.id', 'products.name')
            ->selectRaw('SUM(product_details.cost) as total_revenue')
            ->groupBy('products.id', 'products.name')
            ->first();
    }

    public function getWeeklySalesLast4Weeks(int $productId)
    {
        return Product::where('products.id', $productId)
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->whereBetween('invoices.created_at', [
                now()->subWeeks(4)->startOfWeek(),
                now()->endOfWeek()
            ])
            ->selectRaw('
            YEARWEEK(invoices.created_at, 1) as year_week,
            SUM(product_details.quantity) as total_sold
        ')
            ->groupBy('year_week')
            ->orderBy('year_week')
            ->get();
    }

    public function countProductVisit($productId)
    {
        return Visit::where('url', 'home/products/' . $productId)->count();
    }

    public function getConversionRate($productId)
    {
        $noPurchase = Product::where('products.id', $productId)
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->count();

        $noVisit = $this->countProductVisit($productId);

        if ($noVisit == 0) {
            return 0;
        }

        $rate = ($noPurchase / $noVisit) * 100;

        return round($rate, 2);
    }

    public function getSoldThisMonth($id)
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        return Product::where('products.id', $id)
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->select('products.id', 'products.name')
            ->selectRaw('SUM(product_details.quantity) as total_sold')
            ->groupBy('products.id', 'products.name')
            ->first();
    }
    public function getUserRepeatPurchase($productId)
    {
        return ProductDetail::join('invoices', 'invoices.id', '=', 'product_details.invoice_id')
            ->join('users', 'users.id', '=', 'invoices.user_id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->select('users.id', 'users.name')
            ->selectRaw('COUNT(DISTINCT invoices.id) as purchase_times')
            ->groupBy('users.id', 'users.name')
            ->having('purchase_times', '>=', 2)
            ->get();
    }

    public function countRepeatedPurchasingUsers($productId)
    {
        return DB::table('product_details')
            ->join('invoices', 'invoices.id', '=', 'product_details.invoice_id')
            ->where('product_details.product_id', $productId)
            ->where('invoices.status', Invoice::PAID)
            ->groupBy('invoices.user_id')
            ->havingRaw('COUNT(DISTINCT invoices.id) >= 2')
            ->select('invoices.user_id') // 🚨 CỰC KỲ QUAN TRỌNG
            ->count();
    }









    // public function productStatistic ($id) 
    // {   


    //     return Product::where('id', $id)->
    // }
}
