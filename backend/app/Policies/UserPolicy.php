<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     *
     * @param User $user
     * @return bool
     */
    public function admin(User $user): bool
    {
        return $user->role == "admin";
    }
}
