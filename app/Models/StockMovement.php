<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_item_id', 'type', 'quantity', 'reference', 'remarks'
    ];

    public function resourceItem()
    {
        return $this->belongsTo(ResourceItem::class);
    }

    // Optional: auto-update current_stock
    protected static function booted()
    {
        static::created(function ($movement) {
            $delta = $movement->type === 'in' ? $movement->quantity : -$movement->quantity;
            $movement->resourceItem()->increment('current_stock', $delta);
        });
    }
}
