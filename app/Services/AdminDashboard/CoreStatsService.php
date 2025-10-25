<?php

namespace App\Services\AdminDashboard;

use App\Models\Invoice;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class CoreStatsService extends Service
{
    // public function index()
    // {
    //     return [
    //         'totalRevenue' => $this->getTotalRevenue(),
    //         'monthlyIncomeSummary' => $this->getMonthlyIncomeSummary(),
    //         'bestMonth' => $this->getBestMonth(),
    //         'worstMonth' => $this->getWorstMonth(),
    //         'averageMonthlyIncome' => $this->getAverageMonthlyIncome(),
    //     ];
    // }
    /**
     * get total revenue
     * 
     * @return float
     */
    public function getTotalRevenue()
    {
        return Invoice::where('status', Invoice::PAID)->sum('cost');
    }
    /**
     * get the income of each month of current year
     * 
     *@return \Illuminate\Support\Collection 
     */
    public function getMonthlyRevenue()
    {
        $currentYear = now()->year;

        return Invoice::where('status', Invoice::PAID)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('SUM(cost) as total_income, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
    }
    /**
     * A function to get the most profit month in current year
     * @return object
     */
    public function getBestMonth()
    {
        $currentYear = now()->year;

        return Invoice::where('status', Invoice::PAID)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('SUM(cost) as total_profit, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('total_profit', 'desc')
            ->first();
    }
    /**
     * Get the month with the lowest total revenue (worst-performing month) for the current year.
     *
     * @return \Illuminate\Database\Eloquent\Model|null 
     *  Returns the month with the smallest total revenue,
     *  including 'total_profit' and 'month' fields,
     *  or null if no data is found.
     */
    public function getWorstMonth()
    {
        $currentYear = now()->year;

        return Invoice::where('status', Invoice::PAID)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('SUM(cost) as total_income, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('total_profit', 'asc')
            ->first();
    }
    /**
     * Calculate the average monthly income for the current year.
     *
     * If $onlyActiveMonths is true, the average is calculated only across months that have revenue.
     * Otherwise, it divides the total annual revenue by 12 months.
     *
     * @param bool $onlyActiveMonths Whether to calculate only over months with nonzero income. Default true.
     * @return float The average monthly income, rounded to 2 decimal places.
     */
    public function getAverageMonthlyIncome($onlyActiveMonths = true)
    {
        $annualIncome = $this->getMonthlyRevenue();

        if ($onlyActiveMonths) {

            $average = $annualIncome->avg('amount');
        } else {

            $average = $annualIncome->sum('amount') / 12;
        }

        return round($average, 2);
    }
    /**
     * Get the total yearly revenue for the current year and previous years within the delta range.
     *
     * @param int $delta The number of years back to include in the comparison. Default 3.
     * @return \Illuminate\Support\Collection 
     *  Returns a collection of yearly total costs,
     *  each item containing 'total_income' and 'year' fields.
     */
    public function getAnnualRevenue($delta = 3)
    {
        $currentYear = now()->year;

        return Invoice::whereBetWeen(DB::raw('YEAR(created_at)'), [$currentYear - $delta, $currentYear])
            ->where('status', Invoice::PAID)
            ->selectRaw('SUM(cost) as total_income ,YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
    }
    /**
     * Get daily revenue for the current month.
     *
     * @return \Illuminate\Support\Collection 
     *  Returns a collection where each record contains
     *  'total_profit' and 'day' fields representing
     *  the total revenue for each day of the current month.
     */
    public function getDaylyRevenue()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        return Invoice::where('status', Invoice::PAID)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('SUM(cost) as total_income, DAY(created_at) as day')
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();
    }
    public function monthLyGrowRate()
    {
        $monthlyRevenue = $this->getMonthlyRevenue();
        $prevMonth = null;
        $growthRate = [];

        foreach ($monthlyRevenue as $month => $income) {
            $income = (float) $income;
            
            if ($prevMonth === null) {
                $growthRate[$month] = 0;
            } else {
                $growthRate[$month] = (($income - $prevMonth) / $prevMonth) * 100;
            }

            $prevMonth = $income;
        }

        return $growthRate;
    }


    public function getAnnualGrowthRate($delta)
    {
        $annualRevenue = $this->getAnnualRevenue($delta);

    }
}
