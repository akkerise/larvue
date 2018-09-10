<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/10/2018
 * Time: 10:13 PM
 */

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\Iap;

class IapRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(Iap $iap)
    {
        $this->_model = $iap;
    }
}
