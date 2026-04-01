<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface
{
    /**
     * Retrieve lists of User Emails
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getEmail(string $search);

    /**
     * Create new User account
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function create(array $input);
}
