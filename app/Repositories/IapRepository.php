<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/10/2018
 * Time: 10:13 PM
 */

namespace App\Repositories;

use App\Entities\Models\Iap;

class IapRepository extends AbstractRepository
{
    protected $_model;

    public function __construct(Iap $iap)
    {
        parent::__construct($iap);
    }
}
