<?php

namespace App\Services\admin\usersStatistics\admin;

use App\Models\Admin;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class AdminStatistic extends Service
{
    /* ============================
     * OVERVIEW METRICS
     * ============================
     */

    public function totalAdmins(): int
    {
        return Admin::count();
    }

    public function verifiedAdmins(): int
    {
        return Admin::whereNotNull('email_verified_at')->count();
    }

    public function unverifiedAdmins(): int
    {
        return Admin::whereNull('email_verified_at')->count();
    }

    public function newAdminsToday(): int
    {
        return Admin::whereDate('created_at', today())->count();
    }

    public function newAdminsThisMonth(): int
    {
        return Admin::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    /* ============================
     * ROLE STATISTICS
     * ============================
     */

    public function roles(): array
    {
        return Admin::roles();
    }

    public function countAdminsByRole()
    {
        return Admin::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->get();
    }

    /* ============================
     * ACCOUNT HEALTH
     * ============================
     */

    public function recentlyUpdatedAdmins(int $limit = 5)
    {
        return Admin::orderByDesc('updated_at')
            ->limit($limit)
            ->get(['id', 'name', 'email', 'role', 'updated_at']);
    }

    /* ============================
     * TIME-BASED ANALYTICS
     * ============================
     */

    public function adminsCreatedLast7Days()
    {
        return Admin::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function adminsCreatedPerMonth()
    {
        return Admin::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }
}
