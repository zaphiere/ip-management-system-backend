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
}
