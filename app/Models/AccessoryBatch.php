<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryBatch extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }

    public function vendor()
    {
        return $this->belongsTo(vendor::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
