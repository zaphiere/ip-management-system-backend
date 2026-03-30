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

    /**
     * Create Audit Log
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
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
        $query = $this->model
            ->with([
                'ipEntity:id,ip_address',
                'userEntity:id,email',
            ])
            ->search($input)
            ->latest();

        return $query->paginate(config('const.pagination_limit'));
    }

    /**
     * Retrieve lists of Session IDs
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getSessionId(string $search)
    {
        return $this->model->where('session_id', 'LIKE', '%' . $search . '%')
            ->limit(config('const.dropdown_limit'))
            ->distinct()
            ->orderBy('session_id')
            ->pluck('session_id');
    }
}
