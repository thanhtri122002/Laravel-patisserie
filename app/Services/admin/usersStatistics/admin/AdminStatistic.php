<?php

namespace App\Services\admin\usersStatistics\admin;

use App\Models\Admin;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class AdminStatistic extends Service
{

    public function totalAdmins()
    {
        return Admin::count();
    }

    public function totalRoles()
    {
        return Admin::distinct()->count('role');
    }

    public function countAdminsByRole()
    {
        return Admin::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->orderByDesc('total')
            ->get();
    }
    public function dominantRole()
    {
        return Admin::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->orderByDesc('total')
            ->first();
    }



    public function newAdminsThisMonth()
    {
        return Admin::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    public function adminsCreatedToday()
    {
        return Admin::whereDate('created_at', today())->count();
    }

    public function adminsCreatedThisWeek()
    {
        return Admin::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])->count();
    }

    public function recentAdmins($limit = 5)
    {
        return Admin::select('id', 'username', 'email', 'role', 'created_at')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}
