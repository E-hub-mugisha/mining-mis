<?php

namespace Database\Seeders;

use App\Models\SafetyIncident;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SafetyIncidentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site = Site::first();

        SafetyIncident::create([
            'site_id'=>$site->id,
            'occurred_at'=>Carbon::now()->subDays(2),
            'severity'=>'minor',
            'description'=>'Worker slipped near excavation area',
            'is_resolved'=>true
        ]);

        SafetyIncident::create([
            'site_id'=>$site->id,
            'occurred_at'=>Carbon::now()->subDays(1),
            'severity'=>'moderate',
            'description'=>'Minor equipment fire in drill rig',
            'is_resolved'=>false
        ]);
    }
}
