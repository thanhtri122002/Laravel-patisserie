<?php

namespace App\Services\admin\Product;

use App\Services\Domain\Product\ProductStatistic;
use App\Services\Infrastructure\Cache\ProductCacheService;

class ProductStatisticService
{
    public function __construct(
        protected ProductStatistic $statistic,
        protected ProductCacheService $cache
    ) {}

    /* ===== PASS-THROUGH ===== */

    public function getNewProduct(int $limit)
    {
        return $this->statistic->getNewProduct($limit);
    }

    public function getProductsInPriceRange(float $priceLimit, string $order = 'asc')
    {
        return $this->statistic->getProductsInPriceRange($priceLimit, $order);
    }

    public function getProductsCounts(): int
    {
        return $this->statistic->getProductsCounts();
    }

    public function getNewInthisMonth()
    {
        return $this->statistic->getNewInthisMonth();
    }

    public function getLowStock(int $threshold = 20)
    {
        return $this->statistic->getLowStock($threshold);
    }

    public function getRevenueThisMonth(int $productId)
    {
        return $this->statistic->getRevenueThisMonth($productId);
    }

    public function getWeeklySalesLast4Weeks(int $productId)
    {
        return $this->statistic->getWeeklySalesLast4Weeks($productId);
    }

    public function getSoldThisMonth(int $productId)
    {
        return $this->statistic->getSoldThisMonth($productId);
    }

    public function getUserRepeatPurchase(int $productId)
    {
        return $this->statistic->getUserRepeatPurchase($productId);
    }

    public function countRepeatedPurchasingUsers(int $productId): int
    {
        return $this->statistic->countRepeatedPurchasingUsers($productId);
    }

    public function getConversionRate(int $productId): float
    {
        return $this->statistic->getConversionRate($productId);
    }

    public function searchProducts(string $keyword)
    {
        return $this->statistic->getProductsBySearching($keyword);
    }

    public function getSeasonNalProd()
    {
        return $this->statistic->getSeasonNalProd();
    }

    public function getNewProds(int $limit)
    {
        return $this->statistic->getNewProds($limit);
    }

    public function countProductVisit(int $productId): int
    {
        return $this->statistic->countProductVisit($productId);
    }

    /* ===== CACHED ===== */

    public function getTopSelling(int $limit)
    {
        return $this->cache->statistic(
            "top-selling:$limit",
            300,
            fn() => $this->statistic->getTopSelling($limit)
        );
    }

    public function getMostProfitableProducts(int $limit)
    {
        return $this->cache->statistic(
            "most-profitable:$limit",
            600,
            fn() => $this->statistic->getMostProfitableProducts($limit)
        );
    }

    public function getTopSellingTrend(int $limit = 5)
    {
        return $this->cache->statisticFlexible(
            "top-selling-trend:$limit",
            [300, 900],
            fn() => $this->statistic->getTopSellingTrend($limit)
        );
    }

    public function getLowProfit(int $limit, int $threshold)
    {
        return $this->cache->statistic(
            "low-profit:$limit:$threshold",
            600,
            fn() => $this->statistic->getLowProfit($limit, $threshold)
        );
    }

    /* ===== DASHBOARD ===== */

    public function dashboardSummary(): array
    {
        return [
            'total_products' => $this->getProductsCounts(),
            'new_this_month' => $this->getNewInthisMonth(),
            'low_stock'      => $this->getLowStock(),
            'top_selling'    => $this->getTopSelling(5),
        ];
    }
}
