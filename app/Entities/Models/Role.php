<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'maan_roles';

    public $timestamps = true;

    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
