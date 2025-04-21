<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;

class TourPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isGuide();
    }

    public function view(User $user, Tour $tour): bool
    {
        return $user->isAdmin() || $user->isGuide();
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guide';
    }

    public function update(User $user, Tour $tour): bool
    {
        // Только автор тура или админ может редактировать
        return $user->id === $tour->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Tour $tour): bool
    {
        // Только автор тура или админ может удалить
        return $user->id === $tour->user_id || $user->role === 'admin';
    }
}
