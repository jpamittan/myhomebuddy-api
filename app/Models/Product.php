<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{
    HasMany,
    HasOne
};
use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class Product extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];

    public function orders(): ?HasMany
    {
        
        return $this->hasMany(Order::class, 'product_id', 'id');
    }

    public function seller(): ?HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function reviews(): ?HasMany
    {
        
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }
}
