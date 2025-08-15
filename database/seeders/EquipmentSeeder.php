<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site = Site::first();

        $equipments = [
            ['name'=>'Excavator 3000','type'=>'Excavator','serial'=>'EX-3000','status'=>'active','hours_meter'=>1200],
            ['name'=>'Dump Truck A1','type'=>'Truck','serial'=>'DT-A1','status'=>'active','hours_meter'=>800],
            ['name'=>'Drill Rig X','type'=>'Drill','serial'=>'DR-X','status'=>'maintenance','hours_meter'=>500],
        ];

        foreach ($equipments as $eq) {
            Equipment::create(array_merge($eq,['site_id'=>$site->id]));
        }
    }
}
