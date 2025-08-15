<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id','taken_at','type','value','unit'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
