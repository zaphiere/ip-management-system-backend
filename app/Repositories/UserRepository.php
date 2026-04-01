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

    /**
     * Retrieve lists of User Emails
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getEmail(string $search)
    {
        return $this->model->where('email', 'LIKE', '%' . $search . '%')
            ->limit(config('const.dropdown_limit'))
            ->orderBy('email')
            ->pluck('email');
    }

    /**
     * Create new user account
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

}
