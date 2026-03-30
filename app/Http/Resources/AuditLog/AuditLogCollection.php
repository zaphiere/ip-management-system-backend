<?php

namespace App\Http\Resources\AuditLog;

use App\Http\Resources\AuditLog\AuditLogResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AuditLogCollection extends ResourceCollection
{
    /**
     * Initialization Collection instance
     */
    public function __construct(Collection|array|LengthAwarePaginator $collection)
    {
        parent::__construct($collection);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => AuditLogResource::collection($this->collection)
        ];
    }
}
