<?php

namespace App\Policies\V1;

use App\Models\User;
use App\Permissions\V1\Abilities;

class MemberPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function index(User $user) {
        return $user->tokenCan(Abilities::AllMembers);
    }

    public function delete(User $user) {
        return $user->tokenCan(Abilities::DeleteMember);
    }

    public function show(User $user) {
        return $user->tokenCan(Abilities::ShowMember);
    }

    public function store(User $user) {
        return $user->tokenCan(Abilities::CreateMember);
    }

    public function update(User $user) {
        return $user->tokenCan(Abilities::UpdateMember);
    }
}
