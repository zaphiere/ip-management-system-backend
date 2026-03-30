<?php

namespace App\Http\Controllers\AuditLog;

use App\Http\Controllers\Controller;
use App\Services\AuditLog\OptionAuditLogService;
use Illuminate\Http\Request;

class OptionAuditLogController extends Controller
{
    /**
     * OptionAuditLogService instance
     *
     * @var \App\Services\AuditLog\OptionAuditLogService $optionAuditLogService
     */
    protected OptionAuditLogService $optionAuditLogService;

    /**
     * OptionAuditLogService initialization
     */
    public function __construct(OptionAuditLogService $optionAuditLogService)
    {
        $this->optionAuditLogService = $optionAuditLogService;
    }

    public function list()
    {
        return response()->json('list');
    }

    public function view()
    {
        return response()->json('view');
    }
}
