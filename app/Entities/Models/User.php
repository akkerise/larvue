<?php

namespace App\Entities\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Auth;

class User extends Auth
{
    use Notifiable;

    protected $table = 'maan_users';

    public $timestamps = true;

    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appota_id', 'role_id', 'google_id', 'facebook_id', 'email', 'password', 'fullname', 'avatar', 'gender', 'phone', 'address', 'last_activity', 'expired_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token', 'refresh_token', 'remember_token'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
