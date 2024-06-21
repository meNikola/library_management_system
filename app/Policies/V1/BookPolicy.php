<?php

namespace App\Policies\V1;

use App\Models\User;
use App\Permissions\V1\Abilities;

class BookPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user) {
        return $user->tokenCan(Abilities::DeleteBook);
    }

    public function store(User $user) {
        return $user->tokenCan(Abilities::CreateBook);
    }

    public function update(User $user) {
        return $user->tokenCan(Abilities::UpdateBook);
    }
}
