<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CityPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function view(User $user, City $location): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function update(User $user, City $location): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function delete(User $user, City $location): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }
}
