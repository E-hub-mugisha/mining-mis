<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\ResourceItem;
use App\Models\Equipment;
use App\Models\ProductionLog;
use App\Models\SafetyIncident;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $site = Site::where('code', 'TMM-001')->first();

        // Low stock items
        $items = ResourceItem::where('site_id', $site->id)
            ->whereColumn('current_stock', '<=', 'min_stock')
            ->get();

        // Production stats (last 7 days)
        $productionStats = ProductionLog::where('site_id', $site->id)
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->orderBy('date')
            ->get();

        $productionLabels = $productionStats->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray();
        $oreData = $productionStats->pluck('ore_tonnage')->toArray();
        $wasteData = $productionStats->pluck('waste_tonnage')->toArray();

        // Stock data
        $resourceItems = ResourceItem::where('site_id', $site->id)->get();
        $stockLabels = $resourceItems->pluck('name')->toArray();
        $stockData = $resourceItems->pluck('current_stock')->toArray();

        // Equipment status counts
        $equipmentStatus = Equipment::where('site_id', $site->id)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // Recent safety incidents
        $recentIncidents = SafetyIncident::where('site_id', $site->id)
            ->orderByDesc('occurred_at')
            ->take(5)
            ->get();

        $totalOre = $productionStats->sum('ore_tonnage');
        $totalWaste = $productionStats->sum('waste_tonnage');
        $avgGrade = $productionStats->avg('avg_grade');


        return view('dashboard', compact(
            'items',
            'totalOre',
            'totalWaste',
            'avgGrade',
            'productionLabels',
            'oreData',
            'wasteData',
            'stockLabels',
            'stockData',
            'equipmentStatus',
            'recentIncidents'
        ));
    }
}
