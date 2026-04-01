<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminUserRequest;
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

    /**
     * Create new Admin User Account
     */
    public function create(CreateAdminUserRequest $request)
    {
        $input = $request->validated();
        $data = $this->manageAdminUserService->create($input);

        return JsonResponseHelper::success($data, 'User Creation Success');
    }
}
