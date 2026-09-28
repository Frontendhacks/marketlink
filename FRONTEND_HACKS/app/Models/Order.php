<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'product_id',
        'total_amount',
        'quantity',
        'order_status',
        'order_date',
        'order_type',
        'pickup_date',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'order_date' => 'datetime',
        'pickup_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}