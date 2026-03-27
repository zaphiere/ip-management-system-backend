<?php

namespace App\Http\Resources\IpRecord;

use App\Helpers\AdminAccessHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class IpAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? '',
            'ip_address' => $this->ip_address ?? '',
            'label' => $this->label ?? '',
            'comment_full' => $this->comment ?? '',
            'comment_truncate' => $this->resource->comment
                ? Str::limit($this->resource->comment, config('const.character_limit'))
                : '',
            'can_edit' => AdminAccessHelper::canAccess($this->created_by) ?? 'false',
            'can_delete' => AdminAccessHelper::canAccess($this->created_by) ?? 'false',
            'created_at' => $this->created_at->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
