<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id','filled_at','liters','odometer_or_hours','issuer'
    ];

    protected $casts = [
    'filled_at' => 'datetime',
];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
