<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // Todo::class => TodoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_admin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('is_user', function ($user) {
            return $user->role == 'user';
            // return $user->role == 'user'
            //     ? Response::allow('helo', 200, 'true')
            //     : Response::deny('You must be an administrator.');
        });

        // User Policy
        // Gate::define('update-post', [PostPolicy::class, 'update']);
    }
}
