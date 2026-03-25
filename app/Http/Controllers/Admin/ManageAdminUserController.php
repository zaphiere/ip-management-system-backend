<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManageAdminUserService;
use Illuminate\Http\Request;

class ManageAdminUserController extends Controller
{
    /**
     * ManageAdminUserService instance
     *
     * @var \App\Services\Admin\ManageAdminUserService $manageAdminUserService
     */
    protected ManageAdminUserService $manageAdminUserService;

    /**
     * ManageAdminUserService initialization
     */
    public function __construct(ManageAdminUserService $manageAdminUserService)
    {
        $this->manageAdminUserService = $manageAdminUserService;
    }
}
