<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id', 'name', 'type', 'serial', 'status', 'last_maintenance_at', 'hours_meter'
    ];

    protected $dates = ['last_maintenance_at'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function fuelLogs()
    {
        return $this->hasMany(FuelLog::class);
    }

    public function maintenanceJobs()
    {
        return $this->hasMany(MaintenanceJob::class);
    }
}
