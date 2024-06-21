<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Author;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use App\Policies\V1\AuthorPolicy;
use App\Policies\V1\BookPolicy;
use App\Policies\V1\ReservationPolicy;
use App\Policies\V1\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Author::class => AuthorPolicy::class,
        Book::class => BookPolicy::class,
        Reservation::class => ReservationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
