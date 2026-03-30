<?php

namespace App\Http\Resources\AuditLog;

use App\Enums\EntityType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuditLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id ?? '',
            'user_id' => $this->user_id ?? '',
            'user_email' => $this->user->email ?? '',
            'user_role' => $this->user->role ?? '',
            'session_id' => $this->session_id ?? '',
            'action' => $this->action ?? '',
            'entity_type' => $this->entity_type ?? '',
        ];

        // If entity type is IP Address
        if ($this->entity_type &&
            $this->entity_type === EntityType::IP_ADDRESS
        ) {
            $data['entity'] = [
                'id' => $this->entity_id,
                'ip_address' => $this->ipEntity?->ip_address,
            ];
        }

        // If entity type is User
        if ($this->entity_type &&
            $this->entity_type === EntityType::USER
        ) {
            $data['entity_details'] = [
                'id' => $this->entity_id,
                'email' => $this->userEntity?->email,
            ];
        }

        $data = array_merge($data, [
            'old_content' => $this->old_content ?? '',
            'new_content' => $this->new_content ?? '',
            'created_at' => $this->created_at->format('Y-m-d H:i:s') ?? '',
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s') ?? '',
        ]);

        return $data;
    }
}
