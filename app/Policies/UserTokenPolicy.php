<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserToken;

class UserTokenPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_verified;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserToken $userToken): bool
    {
        return $userToken->user_id == $user->id;
    }

}
