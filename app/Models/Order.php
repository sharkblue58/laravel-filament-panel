<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'customer_email', 'billing_address', 'shipping_address', 'status', 'city_id', 'total'];

    protected $casts = [
        'status' => OrderStatus::class,
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function updateTotal()
    {
        $this->total = $this->orderItems->sum(fn($item) => $item->quantity * $item->price);
        $this->save();
    }
}
