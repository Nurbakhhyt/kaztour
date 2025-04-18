<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;

class TourPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Tour $tour): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isGuide();
    }

    public function update(User $user, Tour $tour): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Tour $tour): bool
    {
        return $user->isAdmin();
    }
}
