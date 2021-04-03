<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class OrderSchedule extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'schedule_date'  => 'datetime:n/d/Y',
        'schedule_time'  => 'datetime:g:i A'
    ];

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
}
