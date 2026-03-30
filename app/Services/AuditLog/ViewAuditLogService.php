<?php

namespace App\Services\AuditLog;

use App\Interfaces\AuditLogInterface;

class ViewAuditLogService
{
    /**
     * AuditLogInterface instance
     *
     * @var \App\Interfaces\AuditLogInterface $auditLogInterface
     */
    protected AuditLogInterface $auditLogInterface;

    /**
     * Initializing interface
     */
    public function __construct(AuditLogInterface $auditLogInterface)
    {
        $this->auditLogInterface = $auditLogInterface;
    }

    /**
     * Search and retrieve list of audit logs
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function search(array $input)
    {
        return $this->auditLogInterface->search($input);
    }
}
