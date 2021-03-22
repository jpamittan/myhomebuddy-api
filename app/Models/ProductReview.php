<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at'  => 'datetime:m/d/Y h:i A',
        'updated_at' => 'datetime:m/d/Y h:i A',
    ];

    public function user(): ?HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')
            ->select([
                'id',
                'first_name',
                'middle_name',
                'last_name'
            ]);
    }
}
