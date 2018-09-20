<?php
namespace App\Repositories;

use App\Entities\Models\App;

class AppRepository extends AbstractRepository
{
    protected $_model;

    public function __construct(App $app)
    {
        parent::__construct($app);
    }


}
