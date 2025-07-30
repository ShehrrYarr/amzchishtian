<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function group()
{
    return $this->belongsTo(group::class);
}

public function company()
{
    return $this->belongsTo(company::class);
}
public function batches()
{
    return $this->hasMany(AccessoryBatch::class);
}

public function getTotalRemainingAttribute()
{
    // Sum qty_remaining for all batches
    return $this->batches->sum('qty_remaining');
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
