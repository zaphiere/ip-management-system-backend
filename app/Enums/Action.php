<?php

namespace App\Enums;

enum Action: string
{
    /**
     * LOGIN
     */
    case LOGIN = 'LOGIN';

    /**
     * LOGOUT
     */
    case LOGOUT = 'LOGOUT';

    /**
     * CREATE_IP
     */
    case CREATE_IP = 'CREATE_IP';

    /**
     * CREATE_USER
     */
    case CREATE_USER = 'CREATE_USER';

    /**
     * UPDATE_IP
     */
    case UPDATE_IP = 'UPDATE_IP';

    /**
     * DELETE_IP
     */
    case DELETE_IP = 'DELETE_IP';
}

