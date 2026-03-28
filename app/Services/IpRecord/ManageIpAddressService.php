<?php

namespace App\Services\IpRecord;

use App\Enums\{
    Action,
    EntityType,
};
use App\Interfaces\IpRecordInterface;
use App\Services\AuditLog\AuditLogService;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Log,
};

class ManageIpAddressService
{
    /**
     * AuditLogInterface instance
     *
     * @var \App\Interfaces\IpRecordInterface $ipRecordInterface
     */
    protected IpRecordInterface $ipRecordInterface;

    /**
     * AuditLogService instance
     *
     * @var \App\Services\AuditLog\AuditLogService $auditLogService
     */
    protected AuditLogService $auditLogService;

    /**
     * Initialize interface and service
     */
    public function __construct(
        AuditLogService $auditLogService,
        IpRecordInterface $ipRecordInterface,
    ){
        $this->auditLogService = $auditLogService;
        $this->ipRecordInterface = $ipRecordInterface;
    }

    /**
     * Store Ip Record
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function store(array $input)
    {
        DB::beginTransaction();

        try {
            $currentUser = Auth::user();
            $originalInput = $input;
            $input['created_by'] = $currentUser->id;
            $input['updated_by'] = $currentUser->id;

            // Store IP address
            $ip =  $this->ipRecordInterface->create($input);

            // Create Audit Log
            $this->auditLogService->createLog(
                Action::CREATE_IP,
                EntityType::IP_ADDRESS,
                $ip->id,
                null,
                $originalInput,
            );

            DB::commit();

            return $ip;
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Failed to store IP Record', [
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

}
