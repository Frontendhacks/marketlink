<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $primaryKey = 'market_id';
    
    protected $fillable = [
        'market_name',
        'address',
        'day',
        'timing',
        'latitude',
        'longitude',
        'map_provider',
        'status',
    ];
        public function farmerProfiles()
    {
        return $this->hasMany(FarmerProfile::class, 'market_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'market_id');
    }
}
