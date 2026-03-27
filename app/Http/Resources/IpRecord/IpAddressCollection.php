<?php

namespace App\Http\Resources\IpRecord;

use App\Http\Resources\IpRecord\IpAddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IpAddressCollection extends ResourceCollection
{
    /**
     * Initializaion Collection instance
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
            'data' => IpAddressResource::collection($this->collection),
        ];
    }
}
