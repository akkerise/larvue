<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/10/2018
 * Time: 10:15 PM
 */

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\AdsConfig;

class AdsConfigRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(AdsConfig $adsConfig)
    {
        $this->_model = $adsConfig;
    }
}
