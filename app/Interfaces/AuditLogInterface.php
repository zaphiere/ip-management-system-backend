<?php

namespace App\Interfaces;

use App\Models\AuditLog;

interface AuditLogInterface
{
    /**
     * Create Audit Log
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Search and retrieve list of audit logs
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function search(array $input);
}
