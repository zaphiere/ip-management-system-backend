<?php

namespace App\Services\AuditLog;

use App\Enums\{
    Action,
    EntityType,
};
use App\Interfaces\AuditLogInterface;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Log,
};
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuditLogService
{
    /**
     * AuditlogInterface instance
     *
     * @var \App\Interfaces\AuditLogInterface $auditLogInterface
     */
    protected AuditLogInterface $auditLogInterface;


    /**
     * Initialize Interface
     *
     * @param \App\Interfaces\AuditLogInterface $auditLogInterface
     */
    public function __construct(AuditLogInterface $auditLogInterface)
    {
        $this->auditLogInterface = $auditLogInterface;
    }

    /**
     * Create Audit Log
     *
     * @param \App\Enums\Action $action
     * @param \App\Enums\EntityType $entity
     * @param null|int $entityId
     * @param null|array $oldContent
     * @param null|array $newContent
     */
    public function createLog(
        Action $action,
        EntityType $entity,
        ?int $entityId = null,
        ?array $oldContent = null,
        ?array $newContent = null
    ){
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $sessionId = auth('api')->payload()->get('jti');

            $this->auditLogInterface->create([
                'user_id' => $user?->id,
                'session_id' => $sessionId,
                'action' => $action->value,
                'entity_type' => $entity->value,
                'entity_id' => $entityId,
                'old_content' => $oldContent,
                'new_content' => $newContent,
                'created_at' => now(),
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to create audit log', [
                'error' => $e->getMessage(),
            ]);
        }

    }
}
