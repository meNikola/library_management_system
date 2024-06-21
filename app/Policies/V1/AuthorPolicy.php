<?php

namespace App\Policies\V1;

use App\Models\User;
use App\Permissions\V1\Abilities;

class AuthorPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user) {
        return $user->tokenCan(Abilities::DeleteAuthor);
    }

    public function store(User $user) {
        return $user->tokenCan(Abilities::CreateAuthor);
    }

    public function update(User $user) {
        return $user->tokenCan(Abilities::UpdateAuthor);
    }
}
