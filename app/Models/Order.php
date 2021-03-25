<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class Order extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];

    public function consumer(): ?HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')
            ->select([
                'id',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'properties'
            ]);
    }

    public function product(): ?HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function setDeliveryDaysAttribute($value)
    {
        $this->attributes['delivery_days'] = json_encode($value);
    }

    public function setPaymentPropertiesAttribute($value)
    {
        $this->attributes['payment_properties'] = json_encode($value);
    }
}
