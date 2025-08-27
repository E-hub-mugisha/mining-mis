<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'report_type',
        'user_id',
        'filters',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function filters()
    {
        return json_decode($this->filters, true);
    }
}
