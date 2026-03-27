<?php

namespace App\Helpers;

use App\Enums\Role;
use Illuminate\Support\Facades\Auth;

class AdminAccessHelper
{
    /**
     * Check if current Auth user is able to edit an IP Address
     *
     * @param int $id
     *
     * @return boolean
     */
    public static function canAccess(int $id)
    {
        $currentAuth = Auth::user();

        if ($currentAuth->role == Role::SUPER_ADMIN || $currentAuth->id == $id) {
            return true;
        }

        return false;
    }
}
