<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'order_id',
        'content',
        'pdf_path',
        'generated_at',
        'receipt_number',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
