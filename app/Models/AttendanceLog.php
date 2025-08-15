<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id', 'shift_date', 'clock_in', 'clock_out', 'status', 'remarks'
    ];

    protected $casts = [
        'shift_date' => 'date',
        'clock_in' => 'datetime:H:i',
        'clock_out' => 'datetime:H:i',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
