<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($this->isActiveAdmin($user)) {
            return true;
        }
    }

    public function viewAdmin(User $user)
    {
        return $this->isActiveAdmin($user);
    }

    private function isActiveAdmin($user) {
        return $user->isAdmin() && $user->is_active;
    }
}
