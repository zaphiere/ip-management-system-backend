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
}
