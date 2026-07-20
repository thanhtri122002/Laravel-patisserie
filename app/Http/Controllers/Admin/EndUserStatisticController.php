<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Services\admin\usersStatistics\endUsers\EndUserStatistic;

class EndUserStatisticController extends BaseController
{
    protected EndUserStatistic $service;

    public function __construct(EndUserStatistic $service)
    {
        $this->service = $service;
    }

    /**
     * Overall user overview (dashboard cards)
     */
    public function overview()
    {
        $data = [
            'total_users' => $this->service->totalUsers(),
            'new_today' => $this->service->newUsersToday(),
            'new_this_month' => $this->service->newUsersThisMonth(),
            'super_users' => $this->service->superUsersCount(),
            'verified_users' => $this->service->usersWithStripe(), // or verified later
        ];

        return $this->sendSuccessResponse(
            $data,
            'User overview statistics retrieved successfully',
            Response::OK
        );
    }

    /**
     * Role distribution
     */
    public function roles()
    {
        return $this->sendSuccessResponse(
            $this->service->countUsersByRole(),
            'User roles statistics retrieved',
            Response::OK
        );
    }

    /**
     * Growth analytics
     */
    public function growth()
    {
        return $this->sendSuccessResponse(
            [
                'last_7_days' => $this->service->usersCreatedLast7Days(),
                'monthly' => $this->service->usersCreatedPerMonth(),
            ],
            'User growth statistics retrieved',
            Response::OK
        );
    }

    /**
     * Recent user activity
     */
    public function recent()
    {
        return $this->sendSuccessResponse(
            $this->service->recentlyUpdatedUsers(),
            'Recent user activity retrieved',
            Response::OK
        );
    }
}
