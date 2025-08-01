<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pettyCash extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'type',
        'description',
        'user_id',
    ];

    // (Optional) Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
