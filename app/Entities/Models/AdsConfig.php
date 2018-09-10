<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class AdsConfig extends Model
{
    protected $table = 'maan_ads_config';

    public $timestamps = true;

    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'app_id', 'type', 'banner', 'interstitial', 'native'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
