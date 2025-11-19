<?php

namespace App\Services\admin\AdminDashboard;

use App\Models\Invoice;
use App\Models\User;
use App\Services\Service;

class CustomerStatsService extends Service {

    public function getNOCustomers()
    {
        return User::count();
    }
    public function getUserByRole(string $role)
    {
        return User::where('role', $role)->get();
    }
    
    public function getNewUserThisMonth()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        return User::whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->get();
    }
    public function getReturningRate()
    {
        $totalCustomer = Invoice::where('status', Invoice::PAID)
                            ->select('user_id')
                            ->distinct()
                            ->count();
        $repeatedCustomer = Invoice::where('status', Invoice::PAID)
                                ->groupBy('user_id')
                                ->havingRaw('COUNT(id) > 1')
                                ->count();
        
        return $totalCustomer > 0 ? ($repeatedCustomer /  $totalCustomer) * 100 : 0;
    }
    public function getTopCustomers($limit = 5)
    {
        return User::join('invoices', 'users.id', '=', 'invoices.user_id')
                        ->where('invoices.status', Invoice::PAID)
                        ->select('users.name')
                        ->selectRaw('COUNT(invoices.id) as total_invoices')
                        ->groupBy('users.id', 'users.name')
                        ->orderByDesc('total_invoices')
                        ->limit($limit)
                        ->get();
    }
    public function getTopCustomerByRevenue($limit)
    {
        return User::join('invoices', 'users.id', '=', 'invoices.user_id')
                    ->where('invoices.status', Invoice::PAID)
                    ->selectRaw('SUM(invoices.cost) as total_spent')
                    ->select('users.name', 'users.id')
                    ->groupBy('users.name', 'users.id')
                    ->orderByDesc('total_spent')
                    ->limit($limit)
                    ->get();
    }
    
}