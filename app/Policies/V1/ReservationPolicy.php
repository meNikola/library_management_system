<?php

namespace App\Policies\V1;

use App\Models\User;
use App\Permissions\V1\Abilities;

class ReservationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function index(User $user) {
        return $user->tokenCan(Abilities::AllReservation);
    }

    public function store(User $user) {
        return $user->tokenCan(Abilities::CreateReservation);
    }

    public function show(User $user) {
        return $user->tokenCan(Abilities::ShowReservation);
    }
}
