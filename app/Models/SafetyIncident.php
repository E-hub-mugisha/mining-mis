<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyIncident extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id','occurred_at','severity','description','is_resolved'
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'is_resolved' => 'boolean',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
