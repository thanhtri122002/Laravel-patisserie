<?php

namespace App\Services\admin\usersStatistics\endUsers;

use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class EndUserStatistic extends Service
{
    /* ============================
     * CORE USER METRICS
     * ============================
     */

    public function totalUsers(): int
    {
        return User::count();
    }

    // public function verifiedUsers(): int
    // {
    //     return User::whereNotNull('email_verified_at')->count();
    // }

    // public function unverifiedUsers(): int
    // {
    //     return User::whereNull('email_verified_at')->count();
    // }

    public function newUsersToday(): int
    {
        return User::whereDate('created_at', today())->count();
    }

    public function newUsersThisMonth(): int
    {
        return User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    /* ============================
     * ROLE STATISTICS
     * ============================
     */

    public function roles(): array
    {
        return [
            User::USER_ROLE,
            User::SUPER_USER_ROLE,
        ];
    }

    public function countUsersByRole()
    {
        return User::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->get();
    }

    public function superUsersCount(): int
    {
        return User::where('role', User::SUPER_USER_ROLE)->count();
    }

    /* ============================
     * PAYMENT / SUBSCRIPTION STATS
     * ============================
     */

    public function usersWithStripe(): int
    {
        return User::whereNotNull('stripe_id')->count();
    }

    public function usersWithoutStripe(): int
    {
        return User::whereNull('stripe_id')->count();
    }

    /* ============================
     * ENGAGEMENT METRICS
     * ============================
     */

    public function recentlyUpdatedUsers(int $limit = 5)
    {
        return User::orderByDesc('updated_at')
            ->limit($limit)
            ->get(['id', 'name', 'email', 'role', 'updated_at']);
    }

    /* ============================
     * GROWTH ANALYTICS
     * ============================
     */

    public function usersCreatedLast7Days()
    {
        return User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function usersCreatedPerMonth()
    {
        return User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }
}
