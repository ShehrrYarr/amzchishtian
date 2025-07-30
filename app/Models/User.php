<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_text',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userThreads()
    {
        return $this->hasMany(UserThread::class, 'user_id');
    }
    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'user_publications', 'user_id', 'publication_id')
            ->withPivot('id','user_id');
    }

    public function mobiles()
    {
        return $this->hasMany(Mobile::class);
    }

    public function transfers()
    {
        return $this->hasMany(TransferRecord::class, 'from_user_id');
    }

    public function receivedTransfers()
    {
        return $this->hasMany(TransferRecord::class, 'to_user_id');
    }
}
