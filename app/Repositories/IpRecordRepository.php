<?php

namespace App\Repositories;

use App\Interfaces\IpRecordInterface;
use App\Models\IpRecord;

class IpRecordRepository implements IpRecordInterface
{
    /**
     * Ip Record model instance
     *
     * @var \App\Models\IpRecord $model
     */
    protected $model;

    /**
     * Ip Record model initialization
     */
    public function __construct()
    {
        $this->model = new IpRecord();
    }
}
