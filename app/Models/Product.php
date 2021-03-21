<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class Product extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];
}
