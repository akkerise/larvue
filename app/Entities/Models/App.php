<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'maan_apps';

    public $timestamps = true;

    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'platform', 'version', 'build', 'bundle_id', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'api_key', 'secret_key',
    ];
}
