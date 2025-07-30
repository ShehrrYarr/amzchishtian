<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserThread extends Model
{
    use HasFactory;
    public $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
