<?php

namespace App\Helpers;

use App\Models\IpRecord;

class IpRecordContentHelper
{
    /**
     * Retrieve only content from IP Record
     *
     * @param \App\Models\IpRecord $ipRecord
     *
     * @return array<mixed>
     */
    public static function getContent(IpRecord $ipRecord)
    {
        return $ipRecord->except(
            'id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'deleted_at'
        );
    }
}
