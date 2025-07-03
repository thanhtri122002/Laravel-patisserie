<?php

namespace App\Services\admin;

use App\Models\Invoice;
use App\Models\Product;
use App\Services\Service;

class StatisticService extends Service {

    public function topMostSelling($limit)
    {
        return Product::select('products.id', 'products.name')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID) // Only count sold products
            ->selectRaw('SUM(product_details.quantity) as total_sold')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold') // Order by most sold
            ->limit($limit) // Get top 10 best-selling products
            ->get();
    }

    public function getMonthlyIncome()
    {   
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $totalIncome = Invoice::where('status', Invoice::PAID)
            ->whereYear('created_at', $currentYear)
            ->sum('cost');
        
        return $currentMonth > 0 ? $totalIncome / $currentMonth : 0;
    }

    public function getMonthIncome()
    {
        $currentYear = now()->year;

        return Invoice::where('status', Invoice::PAID)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, SUM(cost) as total_income')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function getTotalYearIncome()
    {
        $currentYear = now()->year;
        
        return Invoice::where('status', Invoice::PAID)
            ->whereYear('created_at', $currentYear)
            ->sum('cost');
    }

    public function newProduct() {
        
        return Product::select('name')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();
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

    public function getYearLyGrowth()
    {
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;

        $currentYearIncome = Invoice::where('status', Invoice::PAID)
                ->whereYear('created_at', $currentYear)
                ->sum('cost');

        $prevYearIncome = Invoice::where('status', Invoice::PAID)
                ->whereYear('created_at', $lastYear)
                ->sum('cost');
        
        return $currentYearIncome - $prevYearIncome;
    }

    public function getMonthsIncome()
    {   
        $currentYear = now()->year;
        return Invoice::where('status', Invoice::PAID)
                            ->whereYear('created_at', $currentYear)
                            ->selectRaw('MONTH(created_at) as month, SUM(cost) as income')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();
    }

    public function index($limit)
    {   
        $topMostSelling = $this->topMostSelling($limit);
        $monthlyIncome = $this->getMonthlyIncome();
        $currentMonthIncome = $this->getMonthIncome();
        $totalYearIncome = $this->getTotalYearIncome();
        $newProduct = $this->newProduct();
        $mostProfitable = $this->getMostProfitableProduct();

        return (object) [
            'topMostSelling' => $this->topMostSelling($limit),
            'monthlyIncome' => $this->getMonthlyIncome(),
            'currentMonthIncome' => $this->getMonthIncome(),
            'totalYearIncome' => $this->getTotalYearIncome(),
            'newProduct' => $this->newProduct(),
            'mostProfitable' => $this->getMostProfitableProduct(),
            'yearlyGrowth' => $this->getYearLyGrowth(),
            'monthsIncome' => $this->getMonthsIncome(),
        ];
    }

}