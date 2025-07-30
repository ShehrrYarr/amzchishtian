<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'office_address',
        'city',
        'CNIC',
        'mobile_no',
        'picture',
        'created_by'
    ];

   
    public function accounts()
    {
        return $this->hasMany(Accounts::class);
    }

   public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}
public function batches()
{
    return $this->hasMany(AccessoryBatch::class);
}
}
