<?php

namespace App\Repositories;

use App\Entities\Models\Notification;

class NotificationRepository extends AbstractRepository
{
    protected $_model;

    public function __construct(Notification $notification)
    {
        parent::__construct($notification);
    }
}
