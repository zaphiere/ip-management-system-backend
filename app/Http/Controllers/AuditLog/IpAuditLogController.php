<?php

namespace App\Http\Controllers\AuditLog;

use App\Http\Controllers\Controller;
use App\Services\AuditLog\IpAuditLogService;
use Illuminate\Http\Request;

class IpAuditLogController extends Controller
{
    /**
     * IpAuditLogService instance
     *
     * @var \App\Services\AuditLog\IpAuditLogService $ipAuditLogService
     */
    protected IpAuditLogService $ipAuditLogService;

    /**
     * IpAuditLogService initialization
     */
    public function __construct(IpAuditLogService $ipAuditLogService)
    {
        $this->ipAuditLogService = $ipAuditLogService;
    }
}
