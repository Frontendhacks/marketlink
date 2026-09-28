<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $primaryKey = 'product_id';
    protected $fillable = [
        'farmer_id',
        'category_id',
        'market_id',
        'name',
        'description',
        'image',
        'price',
        'stock_quantity',
        'available_day',
        'status',
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
    ];

    /** Public URL of the product picture: uploaded file, then a matching stock photo, then the logo. */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        $stock = [
            'tomato' => 'tomatoes.jpg', 'apple' => 'apples.jpg', 'carrot' => 'carrots.jpg',
            'kiwi' => 'kiwis.jpg', 'banana' => 'bannanas.jpg', 'pineapple' => 'pineapples.jpg',
            'almond' => 'almonds.jpg', 'strawberr' => 'strawberrys.jpg', 'walnut' => 'walnuts.jpg',
            'peach' => 'peaches.jpg', 'blueberr' => 'blueberrys.jpg', 'mango' => 'mangoes.jpg',
            'broccoli' => 'broccoli.jpg',
        ];
        $name = strtolower((string) $this->name);
        foreach ($stock as $needle => $file) {
            if (str_contains($name, $needle)) {
                return asset('customers/Images/' . $file);
            }
        }

        return asset('customers/Images/logo.png');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
