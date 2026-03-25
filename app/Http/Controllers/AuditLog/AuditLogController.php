<?php

namespace App\Http\Controllers\AuditLog;

use App\Http\Controllers\Controller;
use App\Services\AuditLog\AuditLogService;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * AuditLogService instance
     *
     * @var \App\Services\AuditLog\AuditLogService $auditLogService
     */
    protected AuditLogService $auditLogService;

    /**
     * AuditLogService initialization
     */
    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }

    public function create()
    {
        return response()->json('create');
    }
}
