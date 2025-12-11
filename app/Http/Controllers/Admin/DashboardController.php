<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Services\admin\AdminDashboard\CoreStatsService;
use App\Services\admin\AdminDashboard\CustomerStatsService;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public object $coreStatsService;
    public object $customerStatsService;
    /**
     * DashboardController constructor.
     *
     * @param CoreStatsService $coreStatService Service to fetch core dashboard statistics
     */
    public function __construct(CoreStatsService $coreStatService, CustomerStatsService $customerStatsService)
    {
        $this->coreStatsService = $coreStatService;
        $this->customerStatsService = $customerStatsService;
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
        \Log::info($dailyRevenue);
        return $this->sendSuccessResponse($dailyRevenue, "Retrieved data successfully", Response::OK);
    }
    /**
     * Get the growthRate of between successive months
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMonthGrowthRate() 
    {
        $growthRate = $this->coreStatsService->monthLyGrowRate();

        return $this->sendSuccessResponse($growthRate, "Retrieved data successfully", Response::OK);
    }
    /**
     * Get the quarter revenue
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuarterRevenue()
    {
        $quarterRevenue = $this->coreStatsService->getQuarterRevenue();

        return $this->sendSuccessResponse($quarterRevenue, "Retrieved data successfully", Response::OK);
    }
    /**
     * Get new user which is created in each month
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNewUserInEachMonth() 
    {
        $newUserInEachMonth = $this->customerStatsService->getNewUserInEachMonth();

        return $this->sendSuccessResponse($newUserInEachMonth, "Retrieved data successfully", Response::OK);
    }
    /**
     * Get ratio paid customers over total customers
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaidCustomerRatio()
    {
        $ratio = $this->customerStatsService->getPaidCustomerRatio();

        return $this->sendSuccessResponse($ratio, "Retrieved data successfully", Response::OK);
    }
    /**
     * get visit in each months of this year by calling getVisitThisYear method of core service
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVisitThisYear()
    {
        $visitThisYear = $this->coreStatsService->getVisitThisYear();

        return $this->sendSuccessResponse($visitThisYear, "Retrived data successfully", Response::OK);
    }
    /**
     * Summary of getVisitorsDeviceThisyear
     * 
     * A Controller function calling the total of each visitors' device
     * 
     * @return Response
     */
    public function getVisitorsDeviceCount() 
    {
        $visitorsDevice = $this->coreStatsService->getVisitorSDeviceThisYear();

        return $this->sendSuccessResponse($visitorsDevice, "Retrieved data successfully", Response::OK);
    }
    /**
     * A function to get the Month over Month growthRate
     * 
     * @return Response
     */
    public function getMonthOverMonthGrowthRate()
    {
        $growthRate = $this->coreStatsService->getMonthOverMonthGrowthRate();

        return $this->sendSuccessResponse($growthRate, "Retrieved data successfully", Response::OK);
    }

    public function getTopVisitMonths (Request $request)
    {
        $validated = $request->validate([
            'limit' => 'integer|max:12'
        ]);
        $topVisitMonth = $this->coreStatsService->getTopVisitMonths($validated['limit']);

        return $this->sendSuccessResponse($topVisitMonth, "Retrieved data successfully", Response::OK); 
    }

    public function getMostVisitedDay ()
    {
        $day = $this->coreStatsService->getMostVisitedDay();

        return $this->sendSuccessResponse($day, "Retrieved data successfully", Response::OK);
    }

    public function getMostHourViewed()
    {
        $mostHourViewed = $this->coreStatsService->getMostHourViewed();

        return $this->sendSuccessResponse($mostHourViewed, "Retrieved data success", Response::OK);
    }

    public function getUserBrowserCount() 
    {
        $browserCount = $this->coreStatsService->getUsedBrowserCount();

        return $this->sendSuccessResponse($browserCount, "Retrieved data successfully", Response::OK);
    }

    public function getBounceRate ()
    {
        $bounceRate = $this->coreStatsService->getBounceRate();

        return $this->sendSuccessResponse($bounceRate, 'Retrieved data successfully', Response::OK);
    }

    public function getReturnRate()
    {
        $returnRate = $this->coreStatsService->getReturnRate();

        return $this->sendSuccessResponse($returnRate, "Retrieved data successfully", Response::OK);
    }
}
