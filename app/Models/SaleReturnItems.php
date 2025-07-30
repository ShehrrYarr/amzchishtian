<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReturnItems extends Model
{
    use HasFactory;
    // protected $table = 'sale_return_items';

    protected $fillable = ['sale_return_id', 'sale_item_id', 'quantity', 'price_per_unit'];

    public function salesReturn()
    {
        return $this->belongsTo(SaleReturn::class);
    }

    public function saleItem() {
        return $this->belongsTo(\App\Models\SaleItem::class, 'sale_item_id');
    }
    
}
