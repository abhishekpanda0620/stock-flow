<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_id',
        'total_amount',
        'status',
        'payment_method',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->sum(function($item) {
            return $item->quantity * $item->unit_price;
        });
    }

}
