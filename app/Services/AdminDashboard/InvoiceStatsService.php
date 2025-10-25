<?php

use App\Models\Invoice;
use App\Services\Service;

class InvoiceStatsService extends Service {

    public function getStatusInvoice($status)
    {
        return Invoice::where('status', $status)->get();
    }
    public function countStatusInvoice($status)
    {
        return Invoice::where('status', $status)->count();
    }
    public function getAvgOrdersByMonth()
    {
        $currentYear = now()->year;
        $monthlyOrders = Invoice::where('status', Invoice::PAID)
                        ->whereYear('created_at', $currentYear)
                        ->selectRAW("MONTH(created_at) as month, COUNT(id) as total_orders")
                        ->groupBy('month')
                        ->orderBy('month', 'asc')
                        ->get();
        $average = $monthlyOrders->avg('total_orders');

        return [
            'average_orders' => $average,
            'monthly_breakdown' => $monthlyOrders
        ];
    }
    public function getAvgOrdersValueByMonth()
    {
        $currentYear = now()->year;
        
        return Invoice::whereYear('created_at', $currentYear)
        ->where('status', Invoice::PAID)
        ->selectRaw('MONTH(created_at) as month, SUM(cost) / COUNT(id) as avg_order_value')
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    }

}