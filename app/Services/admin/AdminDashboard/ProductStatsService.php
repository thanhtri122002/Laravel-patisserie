<?php

namespace App\Services\admin\AdminDashboard;

use App\Models\Invoice;
use App\Models\Product;
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
    public function getTopSellingTrend (int $limit = 5)
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

            return $topSellingTrend->groupBy('id')->values();
    }

    public function getTopSelling (int $limit)
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
}
