<?php
namespace App\Repositories;

use App\Entities\Models\RelatedsApp;

class RelatedsAppRepository extends AbstractRepository
{

    protected $_model;

    public function __construct(RelatedsApp $relatedsApp)
    {
        parent::__construct($relatedsApp);
    }
}
