<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    /**
     * User model instance
     *
     * @var \App\Models\User $model
     */
    protected $model;

    /**
     * User model initialization
     */
    public function __construct()
    {
        $this->model = new User();
    }
}
