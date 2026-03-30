<?php

namespace App\Http\Controllers\AuditLog;

use App\Helpers\JsonResponseHelper;
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

    /**
     * Returns a list of IP Addresses
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIp(Request $request)
    {
        $search = $request->input('search');
        $data = [];

        if ($search) {
            $data = $this->optionAuditLogService->getIp($search);
        }

        return JsonResponseHelper::success($data);
    }

    /**
     * Return a list of Emails
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmail(Request $request)
    {
        $search = $request->input('search');
        $data = [];

        if ($search) {
            $data = $this->optionAuditLogService->getEmail($search);
        }

        return JsonResponseHelper::success($data);
    }

    /**
     * Return list of Session IDs
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSessionId(Request $request)
    {
        $search = $request->input('search');
        $data = [];

        if ($search) {
            $data = $this->optionAuditLogService->getSessionId($search);
        }

        return JsonResponseHelper::success($data);
    }

    /**
     * Get list of Actions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAction()
    {
        $data = $this->optionAuditLogService->getAction();

        return JsonResponseHelper::success($data);
    }

    /**
     * Get list of Entity Types
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEntityType()
    {
        $data = $this->optionAuditLogService->getEntityType();

        return JsonResponseHelper::success($data);
    }
}
