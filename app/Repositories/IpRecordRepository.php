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

    /**
     * Search and retrieve list of IP Address records
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function search(array $input)
    {
        $query = $this->model->search($input)->latest();

        return $query->paginate(config('const.pagination_limit'));
    }

    /**
     * Store inputs for IP Record
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Return lists of Ip Addresses
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getIp(string $search)
    {
        return $this->model->where('ip_address', 'LIKE', '%' . $search . '%')
            ->limit(config('const.dropdown_limit'))
            ->orderBy('ip_address')
            ->pluck('ip_address');
    }
}
