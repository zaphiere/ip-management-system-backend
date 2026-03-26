<?php

namespace App\Http\Controllers\Admin;

use App\Enums\{
    Action,
    EntityType,
};
use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAuthRequest;
use App\Services\Admin\AuthAdminUserService;
use App\Services\AuditLog\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminUserController extends Controller
{
    /**
     * AuthAdminUserService instance
     *
     * @var \App\Services\Admin\AuthAdminUserService $authAdminUserService
     */
    protected AuthAdminUserService $authAdminUserService;

    /**
     * AuditLogService instance
     *
     * @var \App\Services\AuditLog\AuditLogService $auditLogService
     */
    protected AuditLogService $auditLogService;

    /**
     *  Initialize Services
     *
     * @param \App\Services\Admin\AuthAdminUserService $authAdminUserService
     * @param \App\Services\AuditLog\AuditLogService $auditLogService
     */
    public function __construct(
        AuthAdminUserService $authAdminUserService,
        AuditLogService $auditLogService,
    ) {
        $this->authAdminUserService = $authAdminUserService;
        $this->auditLogService = $auditLogService;
    }

    /**
     * Admin login
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AdminAuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if(!$token) {
            return JsonResponseHelper::unauthorized('wrong email and/or password');
        }

        $user = Auth::user();
        $this->auditLogService->createLog(Action::LOGIN, EntityType::USER, $user->id);

        return JsonResponseHelper::success([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 'Login Success');
    }

    /**
     * Admin logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = Auth::user();
        $this->auditLogService->createLog(Action::LOGOUT, EntityType::USER, $user->id);
        Auth::logout();

        return JsonResponseHelper::success(null, 'Logout Success');
    }

    /**
     * Refresh token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return JsonResponseHelper::success([
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
