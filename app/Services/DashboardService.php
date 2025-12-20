<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\DashboardServiceInterface;

class DashboardService implements DashboardServiceInterface
{
    public function getItemsData()
    {
        // Total Inventory Value (current stock)
        $totalValue = Item::sum(DB::raw('price * quantity'));

        // Calculate growth based on items added this month vs last month
        $currentMonthValue = Item::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->sum(DB::raw('price * quantity'));
                                 
        $lastMonthValue = Item::whereMonth('created_at', Carbon::now()->subMonth()->month)
                              ->whereYear('created_at', Carbon::now()->subMonth()->year)
                              ->sum(DB::raw('price * quantity'));

        $percentageChange = 0;
        if ($lastMonthValue > 0) {
            $percentageChange = (($currentMonthValue - $lastMonthValue) / $lastMonthValue) * 100;
        } elseif ($currentMonthValue > 0) {
            $percentageChange = 100;
        }
        
        // Chart Data: Value of items added in the last 10 days
        $chartData = [];
        $categories = [];
        
        // Loop for last 10 days
        for ($i = 10; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayValue = Item::whereDate('created_at', $date->toDateString())
                            ->sum(DB::raw('price * quantity'));
            
            $chartData[] = (float) $dayValue;
            // Format matching the chart widget expectation or ISO8601
            $categories[] = $date->format('Y-m-d\TH:i:s');
        }

        return [
            'total_value' => $totalValue,
            'percentage_change' => $percentageChange,
            'chart_data' => $chartData,
            'categories' => $categories,
        ];
    }
    public function getUsersData()
    {
        // Total Users
        $totalUsers = User::count();

        // Calculate growth based on users registered this month vs last month
        $currentMonthUsers = User::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->count();
                                 
        $lastMonthUsers = User::whereMonth('created_at', Carbon::now()->subMonth()->month)
                              ->whereYear('created_at', Carbon::now()->subMonth()->year)
                              ->count();

        $percentageChange = 0;
        if ($lastMonthUsers > 0) {
            $percentageChange = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        } elseif ($currentMonthUsers > 0) {
            $percentageChange = 100;
        }
        // Chart Data: Users registered in the last 10 days
        $chartData = [];
        $categories = [];
        // Loop for last 10 days
        for ($i = 10; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayUsers = User::whereDate('created_at', $date->toDateString())
                            ->count();
            
            $chartData[] = (float) $dayUsers;
            // Format matching the chart widget expectation or ISO8601
            $categories[] = $date->format('Y-m-d\TH:i:s');
        }
        return [
            'total_users' => $totalUsers,
            'percentage_change' => $percentageChange,
            'chart_data' => $chartData,
            'categories' => $categories,
        ];


    }
    public function getGroupsData()
    {
        // Total Groups
        $totalGroups = Group::count();
        // Calculate growth based on groups registered this month vs last month
        $currentMonthGroups = Group::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->count();
                                 
        $lastMonthGroups = Group::whereMonth('created_at', Carbon::now()->subMonth()->month)
                              ->whereYear('created_at', Carbon::now()->subMonth()->year)
                              ->count();
                                 
        $percentageChange = 0;
        if ($lastMonthGroups > 0) {
            $percentageChange = (($currentMonthGroups - $lastMonthGroups) / $lastMonthGroups) * 100;
        } elseif ($currentMonthGroups > 0) {
            $percentageChange = 100;
        }
        // Chart Data: Groups registered in the last 10 days
        $chartData = [];
        $categories = [];
        // Loop for last 10 days
        for ($i = 10; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayGroups = Group::whereDate('created_at', $date->toDateString())
                            ->count();
            
            $chartData[] = (float) $dayGroups;
            // Format matching the chart widget expectation or ISO8601
            $categories[] = $date->format('Y-m-d\TH:i:s');
        }
        return [
            'total_groups' => $totalGroups,
            'percentage_change' => $percentageChange,
            'chart_data' => $chartData,
            'categories' => $categories,
        ];

    }
}
