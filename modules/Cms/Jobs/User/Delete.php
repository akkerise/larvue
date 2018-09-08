<?php

namespace App\Jobs\User;

use App\Jobs\Job;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Jobs\UploadableTrait;

class Delete extends Job
{
    use UploadableTrait;
    
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $repository)
    {
        if (!empty($this->entity->image)) {
            $this->destroyFile($this->entity->image);
        }
        $repository->delete($this->entity);
    }
}
