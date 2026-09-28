<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $primaryKey = 'favorite_id';
    protected $fillable = [
        'customer_id',
        'product_id',
        'farmer_id',
    ];
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
