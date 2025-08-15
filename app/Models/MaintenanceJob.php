<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id','priority','status','scheduled_for','completed_at','description'
    ];

    protected $casts = [
        'scheduled_for' => 'date',
        'completed_at' => 'date',
    ];
    
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
