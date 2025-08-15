<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id', 'first_name', 'last_name', 'employee_code',
        'role', 'email', 'phone', 'date_of_birth', 'hired_at'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'hired_at' => 'date',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }
}
