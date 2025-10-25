<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Services\AdminDashboard\CoreStatsService;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public object $coreStatsService;
    /**
     * DashboardController constructor.
     *
     * @param CoreStatsService $coreStatService Service to fetch core dashboard statistics
     */
    public function __construct(CoreStatsService $coreStatService)
    {
        $this->coreStatsService = $coreStatService;
    }
    /**
     * Get the total revenue of all paid invoices.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRevenue()
    {
        $revenue = $this->coreStatsService->getTotalRevenue();

        return $this->sendSuccessResponse($revenue, "Retrieved revenue successfully", Response::OK);
    }
    /**
     * Get the total revenue grouped by month for the current year.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMonthlyRevenue()
    {
        $monthlyRevenue = $this->coreStatsService->getMonthlyRevenue();
        
        return $this->sendSuccessResponse($monthlyRevenue, "Retrieved data successfully", Response::OK);
    }
    /**
     * Get the total revenue for the last N years.
     *
     * @param Request $request HTTP request containing the 'delta' parameter
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnnualRevenue(Request $request) 
    {   
        
        $validated = $request->validate([
            'delta' => 'required|integer|min:1',
        ]);
        
        $annualRevenue = $this->coreStatsService->getAnnualRevenue($validated['delta']);

        return $this->sendSuccessResponse($annualRevenue, "Retrieved data successfully", Response::OK);
    }
    /**
     * Get the total revenue grouped by day for the current month.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDailyRevenue()
    {
        $dailyRevenue = $this->coreStatsService->getDaylyRevenue();

        return $this->sendSuccessResponse($dailyRevenue, "Retrieved data successfully", Response::OK);
    }
    public function getMonthGrowthRate() 
    {
        $growthRate = $this->coreStatsService->monthLyGrowRat();

        return $this->sendSuccessResponse($growthRate, "Retrieved data successfully", Response::OK);
    }
    
}
