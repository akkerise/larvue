<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'maan_notifications';

    public $timestamps = true;

    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'url', 'user_id', 'app_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
