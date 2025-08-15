<?php

namespace Database\Seeders;

use App\Models\ResourceItem;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site = Site::first();

        $resources = [
            ['name'=>'Diesel Fuel','category'=>'Fuel','unit'=>'Liters','min_stock'=>5000,'current_stock'=>10000],
            ['name'=>'Explosives','category'=>'Explosive','unit'=>'Kg','min_stock'=>200,'current_stock'=>500],
            ['name'=>'Safety Helmets','category'=>'PPE','unit'=>'Pieces','min_stock'=>100,'current_stock'=>200],
            ['name'=>'Gloves','category'=>'PPE','unit'=>'Pairs','min_stock'=>200,'current_stock'=>400],
        ];

        foreach ($resources as $r) {
            ResourceItem::create(array_merge($r, ['site_id'=>$site->id]));
        }
    }
}
