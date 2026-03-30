<?php

namespace App\Services\IpRecord;

use App\Interfaces\IpRecordInterface;

class ViewIpAddressService
{
    /**
     * IpRecordInterface instance
     *
     * @var \App\Interfaces\IpRecordInterface $ipRecordInterface
     */
    protected IpRecordInterface $ipRecordInterface;

    /**
     * Initialize Interface
     */
    public function __construct(IpRecordInterface $ipRecordInterface)
    {
        $this->ipRecordInterface = $ipRecordInterface;
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
        return $this->ipRecordInterface->search($input);
    }

    /**
     * Retrieve IP Address based on ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findIpAddressById(int $id)
    {
        return $this->findIpAddressById($id);
    }
}
