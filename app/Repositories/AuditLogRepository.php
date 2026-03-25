<?php

namespace App\Repositories;

use App\Interfaces\AuditLogInterface;
use App\Models\AuditLog;

class AuditLogRepository implements AuditLogInterface
{
    /**
     * Audit Log model instance
     *
     * @var \App\Models\AuditLog $model
     */
    protected $model;

    /**
     * Audit Log model initialization
     */
    public function __construct()
    {
        $this->model = new AuditLog();
    }
}
