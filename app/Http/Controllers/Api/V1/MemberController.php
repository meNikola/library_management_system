<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\UserFilter;
use App\Models\User;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\Role;
use App\Policies\V1\MemberPolicy;

class MemberController extends ApiController
{
    protected $policyClass = MemberPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index(UserFilter $filters)
    {
        $members = User::whereHas('roles', function($query) {
            $query->where('name', 'member');
        })
        ->with('reservations')
        ->filter($filters)
        ->paginate();

        // Policy.
        if ($this->isAble('index', User::class)) {
            return UserResource::collection($members);
        }

        return $this->notAuthorized('You are not authorized to list that resource.');
    }

    public function store(StoreUserRequest $request)
    {
        // Request params.
        $params = $request->mappedAttributes();

        // Create user.
        $user = User::create($params);

        $adminRole = Role::where('name', 'member')->first();

        // Attach user roles.
        $user->roles()->attach($adminRole);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $member)
    {
        // Policy.
        if ($this->isAble('show', User::class)) {
            return new UserResource($member->load('reservations'));
        }

        return $this->notAuthorized('You are not authorized to display specified resource.');
    }
}
