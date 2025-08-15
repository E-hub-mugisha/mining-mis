<?php

namespace Database\Seeders;

use App\Models\ProductionLog;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site = Site::first();
        $today = Carbon::now()->subDays(5);

        for($i=0;$i<5;$i++){
            ProductionLog::create([
                'site_id'=>$site->id,
                'date'=>$today->copy()->addDays($i),
                'ore_tonnage'=>rand(50,150),
                'waste_tonnage'=>rand(10,50),
                'avg_grade'=>rand(150,300)/100, // e.g., 1.50 g/t
                'truck_trips'=>rand(5,15),
                'downtime_minutes'=>rand(0,60),
                'notes'=>'Sample production log'
            ]);
        }
    }
}
