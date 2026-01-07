<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Services\admin\Product\ProductStatisticService;
use Illuminate\Http\Request;

class ProductStatisticController extends BaseController
{
    protected ProductStatisticService $service;

    public function __construct(ProductStatisticService $service)
    {
        $this->service = $service;
    }



    /* =========================
       BASIC STATISTICS
       ========================= */

    public function productCount()
    {
        return $this->sendSuccessResponse(
            $this->service->getProductsCounts(),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function newProducts(Request $request)
    {
        $data = $request->validate([
            'limit' => 'integer|min:1|max:100'
        ]);

        return $this->sendSuccessResponse(
            $this->service->getNewProduct($data['limit'] ?? 10),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function productsInPriceRange(Request $request)
    {
        $data = $request->validate([
            'price' => 'required|numeric|min:0',
            'order' => 'in:asc,desc'
        ]);

        return $this->sendSuccessResponse(
            $this->service->getProductsInPriceRange(
                $data['price'],
                $data['order'] ?? 'asc'
            ),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function seasonalProducts()
    {
        return $this->sendSuccessResponse(
            $this->service->getSeasonNalProd(),
            'Retrieved data successfully',
            Response::OK
        );
    }
    public function newestProducts(Request $request)
    {
        $data = $request->validate([
            'limit' => 'integer|min:1|max:100'
        ]);

        return $this->sendSuccessResponse(
            $this->service->getNewProds($data['limit'] ?? 10),
            'Retrieved data successfully',
            Response::OK
        );
    }


    /* =========================
       SALES & PERFORMANCE
       ========================= */

    public function soldThisMonth(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->getSoldThisMonth($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function conversionRate(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->getConversionRate($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function revenueThisMonth(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->getRevenueThisMonth($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function weeklySales(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->getWeeklySalesLast4Weeks($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }
    public function productVisitCount(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->countProductVisit($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }


    /* =========================
       TOP / TRENDING
       ========================= */

    public function topSelling(int $limit = 5)
    {
        return $this->sendSuccessResponse(
            $this->service->getTopSelling($limit),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function topSellingTrend(int $limit = 5)
    {
        return $this->sendSuccessResponse(
            $this->service->getTopSellingTrend($limit),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function mostProfitable(int $limit = 5)
    {
        return $this->sendSuccessResponse(
            $this->service->getMostProfitableProducts($limit),
            'Retrieved data successfully',
            Response::OK
        );
    }

    /* =========================
       RISK / ALERT
       ========================= */

    public function lowStock(int $threshold = 20)
    {
        return $this->sendSuccessResponse(
            $this->service->getLowStock($threshold),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function lowProfit(Request $request)
    {
        $data = $request->validate([
            'limit'     => 'required|integer|min:1',
            'threshold' => 'required|integer|min:0'
        ]);

        return $this->sendSuccessResponse(
            $this->service->getLowProfit($data['limit'], $data['threshold']),
            'Retrieved data successfully',
            Response::OK
        );
    }

    /* =========================
       USER BEHAVIOR
       ========================= */

    public function repeatedPurchasingUsers(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->countRepeatedPurchasingUsers($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }

    public function repeatPurchaseDetails(int $productId)
    {
        return $this->sendSuccessResponse(
            $this->service->getUserRepeatPurchase($productId),
            'Retrieved data successfully',
            Response::OK
        );
    }

    /* =========================
       DASHBOARD
       ========================= */

    public function dashboardSummary()
    {
        return $this->sendSuccessResponse(
            $this->service->dashboardSummary(),
            'Retrieved data successfully',
            Response::OK
        );
    }
}
