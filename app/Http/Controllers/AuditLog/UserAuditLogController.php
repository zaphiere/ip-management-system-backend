<?php

namespace App\Http\Controllers\AuditLog;

use App\Http\Controllers\Controller;
use App\Services\AuditLog\UserAuditLogService;
use Illuminate\Http\Request;

class UserAuditLogController extends Controller
{
    /**
     * UserAuditLogService instance
     *
     * @var \App\Services\AuditLog\UserAuditLogService $userAuditLogService
     */
    protected UserAuditLogService $userAuditLogService;

    /**
     * UserAuditLogService initialization
     */
    public function __construct(UserAuditLogService $userAuditLogService)
    {
        $this->userAuditLogService = $userAuditLogService;
    }
}
