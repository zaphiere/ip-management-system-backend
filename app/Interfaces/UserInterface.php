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
}
