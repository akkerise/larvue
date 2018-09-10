<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/10/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\RelatedsApp;

class RelatedsAppRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(RelatedsApp $relatedsApp)
    {
        $this->_model = $relatedsApp;
    }
}
