<?php

namespace App\Services\admin\AdminDashboard;

use App\Models\Invoice;
use App\Models\Visit;
use App\Services\Service;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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
    /**
     * Get the revenue growthRate between month in a year
     * 
     * @return array growthRate - array that contain growth rate between successive month
     */
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
    /**
     * a function to get the growthRate of years
     * 
     * @param int $delta - the distance between current year backward
     * 
     * @return array $growthRate - the growthRate of each successive year
     */
    public function getAnnualGrowthRate($delta)
    {
        $annualRevenue = $this->getAnnualRevenue($delta);
        $prevYear = null;
        $growthRate = [];

        foreach ($annualRevenue as $year => $income) {
            $income = (float) $income;

            if ($prevYear === null) {
                $growthRate[$year] = 0;
            } else {
                $growthRate[$year] = (($income - $prevYear) / $prevYear) * 100;
            }
            $prevYear =  $income;
        }

        return $growthRate;
    }
    public function groupMonthsByRevenue()
    {
        $raw = $this->getMonthlyRevenue();
        $monthly = array_fill(0, 12, null);

        foreach ($raw as $item) {
            $monthly[$item->month - 1] = $item;
        }

        $quarterNames = ['first quarter', 'second quarter', 'third quarter', 'fourth quarter'];
        $quarters = [];

        $currentQuarter = 0;
        $countMonthsInQuarter = 0;

        for ($i = 0; $i < 12; $i++) {

            $quarters[$quarterNames[$currentQuarter]][] = $monthly[$i];

            $countMonthsInQuarter++;

            if ($countMonthsInQuarter === 3) {
                $countMonthsInQuarter = 0;
                $currentQuarter++;
            }
        }

        return $quarters;
    }
    public function getQuarterRevenue(): mixed
    {
        $quarterName = ['first quarter', 'second quarter', 'third quarter', 'fourth quarter'];

        return Invoice::where(column: 'status', operator: Invoice::PAID)
            ->selectRaw("QUARTER(created_at) as quarter, SUM(cost) as total_income")
            ->groupBy('quarter')
            ->orderBy('quarter')
            ->get()
            ->map(function ($item) use ($quarterName) {
                return [
                    'quarter' => $quarterName[$item->quarter - 1],
                    'total_income' => $item->total_income
                ];
            })
            ->values();
    }
    /**
     * Logic to get the visit of this year which is grouped by month
     * This method returns a collection where each item represents a month
     * and the total number of unique visitors (based on `visitor_id`) for that month.
     * The results are ordered from January to December.
     * @return \Illuminate\Support\Collection<int, object{month:int, total:int}>
     * 
     */
    public function getVisitThisYear(): mixed
    {
        $currentYear = now()->year;

        return Visit::whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(DISTINCT visitor_id) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
    }
    /**
     * Summary of getTopVisitMonths
     * 
     * @param int $limit
     * @return \Illuminate\Support\Collection<int, object|object{month: int, total: int>}
     */
    public function getTopVisitMonths($limit): mixed
    {
        $visitThisYear = $this->getVisitThisYear();
        $topMonths = $visitThisYear->sortbyDesc(callback: 'total')->take(limit: $limit)->values();

        return $topMonths;
    }
    /**
     * Summary of getVisitorSDeviceThisYear
     * 
     * @return \Illuminate\Support\Collection<object|object{device: string, total: int>}
     */
    public function getVisitorSDeviceThisYear()
    {
        return Visit::selectRaw('device, COUNT(*) as total')
            ->groupBy('device')
            ->get();
    }
    /**
     * Summary of getMonthOverMonthGrowthRate
     * @description 
     * A service which get the growth rate of 2 successive months
     * if the current date is < 15, compute the previous month and the month before the previous month
     * 
     * @return array{currentMonth: int, currentTotal: int, growthRate: float|int|null, previousMonth: int, previousTotal: int}
     */
    public function getMonthOverMonthGrowthRate()
    {
        $visitThisYear = $this->getVisitThisYear();
        $today = CarbonImmutable::today();

        $currentMonth = $today->day < 15 ? $today->subMonth() : $today;

        $previousMonth = $currentMonth->subMonth();
        $currentTotal = $visitThisYear->firstWhere('month', $currentMonth->month)->total ?? 0;
        $previousTotal = $visitThisYear->firstWhere('month', $previousMonth->month)->total ?? 0;

        $growthRate = $previousTotal > 0
            ? (($currentTotal - $previousTotal) / $previousTotal) * 100
            : null;

        return [
            'currentMonth' => $currentMonth->month,
            'previousMonth' => $previousMonth->month,
            'currentTotal' => $currentTotal,
            'previousTotal' => $previousTotal,
            'growthRate' => $growthRate,
        ];
    }
    public function getMostVisitedDay()
    {
        return Visit::selectRaw('DAYNAME(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('total', 'desc')
            ->first()
            ?->day;
    }

    public function getMostHourViewed()
    {
        return Visit::selectRaw('HOUR(created_at) as hour, COUNT(*) as total')
            ->groupBy('hour')
            ->orderBy('hour', 'desc')
            ->first()
            ?->hour;
    }

    public function getUsedBrowserCount()
    {
        return Visit::selectRaw('COUNT(*) as total, browser')
            ->groupBy('browser')
            ->orderBy('total', 'desc')
            ->get();
    }
    public function getAvgLast30Days()
    {
        return Visit::selectRaw("DATE(created_at) as day, COUNT(*) as total")
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('day')
            ->get()
            ->avg('total');
    }

    public function getBounceRate ()
    {
        $singlePageVisitor = Visit::select('visitor_id')->groupBy('visitor_id')
            ->havingRaw("COUNT(*) = 1")
            ->get()
            ->count();
        $totalVisit = Visit::distinct()->count('visitor_id');

        return ($singlePageVisitor / $totalVisit) * 100;
    }

    public function getReturnRate ()
    {
        $visitors = Visit::select('visitor_id')
            ->selectRaw('COUNT(DISTINCT DATE(created_at)) as days_visited')
            ->groupBy('visitor_id')
            ->get();

        $returning = $visitors->filter(fn($v) => $v->days_visited > 1)->count();
        $total = $visitors->count();

        if ($total === 0) return 0;

        return round(($returning / $total) * 100, 2);
    }

}
