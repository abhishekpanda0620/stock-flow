<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'notes',
        'image',
        'last_order_at',
        'last_paid_at',
        'total_orders',
        'total_spent',
        'total_items',
        'total_quantity',
        'total_discounts',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTotalSpentAttribute()
    {
        return $this->orders->sum('total_amount');
    }

}
