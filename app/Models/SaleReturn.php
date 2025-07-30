<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    use HasFactory;
    protected $fillable = ['sale_id', 'user_id', 'reason'];


    public function items() {
    return $this->hasMany(\App\Models\SaleReturnItems::class, 'sale_return_id');
}
    public function sale() {
        return $this->belongsTo(\App\Models\Sale::class, 'sale_id');
    }
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
