<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService)
    {
        $itemData = $dashboardService->getItemsData();
        $userData = $dashboardService->getUsersData();
        $groupData = $dashboardService->getGroupsData();

        return view('pages.dashboard.index', compact('itemData','userData','groupData'));
    }
}
