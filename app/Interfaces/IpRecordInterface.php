<?php

namespace App\Interfaces;

use App\Models\IpRecord;

interface IpRecordInterface
{
    /**
     * Search and retrieve list of IP Address records
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function search(array $input);

    /**
     * Store inputs for IP Record
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function create(array $input);

    /**
     * Return lists of Ip Addresses
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getIp(string $search);
}
