<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AuthAdminUserService;
use Illuminate\Http\Request;

class AuthAdminUserController extends Controller
{
    /**
     * AuthAdminUserService instance
     *
     * @var \App\Services\Admin\AuthAdminUserService $authAdminUserService
     */
    protected AuthAdminUserService $authAdminUserService;

    /**
     * AuthAdminUserService initialization
     */
    public function __construct(AuthAdminUserService $authAdminUserService)
    {
        $this->authAdminUserService = $authAdminUserService;
    }
}
