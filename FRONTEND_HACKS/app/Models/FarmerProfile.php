<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
    protected $primaryKey = 'farmer_profile_id';
    protected $fillable = [
        'farmer_id',
        'market_id',
        'stall_name',
        'stall_description',
        'latitude',
        'longitude',
        'map_provider',
        'status',
        'farm_type',
        'farm_size',
        'city',
    ];
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
}
