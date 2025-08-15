<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'location',
        'notes',
        'manager_id'
    ];

    // Relationships
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function resourceItems()
    {
        return $this->hasMany(ResourceItem::class);
    }

    public function productionLogs()
    {
        return $this->hasMany(ProductionLog::class);
    }

    public function safetyIncidents()
    {
        return $this->hasMany(SafetyIncident::class);
    }

    public function envReadings()
    {
        return $this->hasMany(EnvReading::class);
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
