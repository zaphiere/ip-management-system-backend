<?php

namespace App\Enums;

enum Role: string
{
    /**
     * ADMIN
     */
    case ADMIN = 'ADMIN';

    /**
     * SUPER_ADMIN
     */
    case SUPER_ADMIN = 'SUPER_ADMIN';
}
