<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    // protected $guardrd =[];

    protected $fillable = [
        'vendor_id',
        'customer_name',
        'customer_mobile',
        'sale_date',
        'total_amount',
        'user_id','status', 'approved_at', 'approved_by','discount_amount'
    ];  
    
    public function vendor() {
        return $this->belongsTo(vendor::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
    public function items()
{
    return $this->hasMany(\App\Models\SaleItem::class);
}

public function returns()
{
    return $this->hasMany(\App\Models\SaleReturn::class);
}

}
