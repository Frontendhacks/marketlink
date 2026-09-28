<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     protected $fillable = [
        'generated_by',
        'report_type',
        'generated_at',
    ];
    protected $casts = [
        'generated_at' => 'datetime',
    ];
    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
