<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Site::create([
            'name' => 'Trinity Metals Musha',
            'code' => 'TMM-001',
            'location' => 'Musha, Rwanda',
            'notes' => 'Primary mining site for metals and ore extraction'
        ]);
    }
}
