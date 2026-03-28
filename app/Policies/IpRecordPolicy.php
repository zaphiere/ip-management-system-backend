<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\IpRecord;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IpRecordPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IpRecord $ipRecord): bool
    {
        return $user->role === Role::SUPER_ADMIN ||
            $user->id === $ipRecord->created_by;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IpRecord $ipRecord): bool
    {
        return $user->role === Role::SUPER_ADMIN;
    }
}
