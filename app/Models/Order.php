<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'customer_email','billing_address','shipping_address' ,'city_id','total'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
