<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();
    }

    public function registerPostPolicies()
    {
        Gate::define('browse-only', function($user){
            return $user->hasAccess(['browse-only']);
        });
        
        Gate::define('create-post', function($user){
            return $user->hasAccess(['create-post']);
        });

        Gate::define('delete-post', function($user){
            return $user->hasAccess(['delete-post']);
        });

        Gate::define('control-all', function($user){
            return $user->hasAccess(['control-all']);
        });

        Gate::define('change-roles', function($user){
            return $user->hasAccess(['change-roles']);
        });
        
        Gate::define('update-post', function($user){
            return $user->hasAccess(['update-post']);
        });
    }
}
