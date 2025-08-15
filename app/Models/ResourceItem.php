<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id', 'name', 'category', 'unit', 'min_stock', 'current_stock'
    ];

    // Relationships
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
