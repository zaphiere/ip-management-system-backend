<?php

namespace App\Services\Admin;

use App\Enums\{
    Action,
    EntityType,
};
use App\Interfaces\UserInterface;
use App\Services\AuditLog\AuditLogService;
use Illuminate\Support\Facades\{
    DB,
    Hash,
    Log,
};

class ManageAdminUserService
{
    /**
     * UserInterface instance
     *
     * @var \App\Interfaces\UserInterface $userInterface
     */
    protected UserInterface $useInterface;

    /**
     * AuditLogService instance
     *
     * @var \App\Services\AuditLog\AuditLogService $auditLogService
     */
    protected AuditLogService $auditLogService;

    /**
     * Interface and Service initialization
     */
    public function __construct(
        AuditLogService $auditLogService,
        UserInterface $userInterface,
    ){
        $this->useInterface = $userInterface;
        $this->auditLogService = $auditLogService;
    }

    /**
     * Create new User account
     *
     * @param array<mixed> $input
     *
     * @return mixed
     */
    public function create(array $input)
    {
        DB::beginTransaction();

        try {
            $input['password'] = Hash::make($input['password']);
            $user = $this->useInterface->create($input);

            $this->auditLogService->createLog(
                Action::CREATE_USER,
                EntityType::USER,
                $user->id,
                null,
                collect($input)->except('password')->toArray(),
            );

            DB::commit();

            return $user;
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Failed to create user', [
                "error" => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
