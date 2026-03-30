<?php

namespace App\Http\Controllers\AuditLog;

use App\Helpers\JsonResponseHelper;
use App\Http\Requests\AuditLog\AuditLogSearchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuditLog\{
    AuditLogCollection,
    AuditLogResource,
};
use App\Models\AuditLog;
use App\Services\AuditLog\ViewAuditLogService;

class ViewAuditLogController extends Controller
{
    /**
     * IpAuditLogService instance
     *
     * @var \App\Services\AuditLog\IpAuditLogService $ipAuditLogService
     */
    protected ViewAuditLogService $viewAuditLogService;

    /**
     * IpAuditLogService initialization
     */
    public function __construct(ViewAuditLogService $viewAuditLogService)
    {
        $this->viewAuditLogService = $viewAuditLogService;
    }

    /**
     * Retrieve Audit Log List (Only accessible with SUPER_ADMIN role)
     *
     * @param \App\Http\Requests\AuditLog\AuditLogSearchRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(AuditLogSearchRequest $request)
    {
        $input = $request->validated();
        $data = $this->viewAuditLogService->search($input);

        $auditlogs = AuditLogCollection::make($data)
            ->response()
            ->getData(true);

        return JsonResponseHelper::successList($auditlogs, 'Retrieved Audit Logs List Successfully');
    }

    /**
     * Retrieve single Audit Log Entry
     *
     * @param \App\Models\AuditLog $auditLog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(AuditLog $auditLog)
    {
        $auditLogRecord = new AuditLogResource($auditLog);

        return JsonResponseHelper::success($auditLogRecord);
    }
}
