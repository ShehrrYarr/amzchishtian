<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function sale() {
        return $this->belongsTo(Sale::class);
    }
    public function batch() {
        return $this->belongsTo(AccessoryBatch::class, 'accessory_batch_id');
    }
    public function accessory() {
        return $this->belongsTo(Accessory::class, 'accessory_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }     

    public function returns()
{
    return $this->hasMany(\App\Models\SaleReturn::class, 'sale_item_id');
}
}
