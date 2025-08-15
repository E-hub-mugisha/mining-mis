<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id','date','ore_tonnage','waste_tonnage','avg_grade','truck_trips','downtime_minutes','notes'
    ];

    protected $casts = [
        'date' => 'date',
        'ore_tonnage' => 'decimal:2',
        'waste_tonnage' => 'decimal:2',
        'avg_grade' => 'decimal:4',
    ];
    
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
