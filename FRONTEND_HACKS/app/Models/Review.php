<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'customer_id',
        'product_id',
        'rating',
        'comment',
        'farmer_reply',
        'status',
        'review_date',
    ];
    protected $casts = [
        'review_date' => 'datetime',
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
