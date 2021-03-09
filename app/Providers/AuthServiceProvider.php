<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        
        'App\Models\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Gate::define('isAdmin', function($user){
            //return true;
            $roles = $user->roles->pluck('name')->toArray();
            return in_array('Admin',$roles);
        });

        Gate::define('isSubscriber', function($user){
            $roles = $user->roles->pluck('name')->toArray();
            return in_array('Subscriber',$roles);
        });*/

        /* Gate::define('isAllowed', function($user, $allowed){
            //$allowed = explode(':', $allowed);
            //dd($allowed);
            $roles = $user->roles->pluck('name')->toArray();
            //dd($roles);
            //return array_intersect($allowed,$roles);
            return array_intersect($allowed->all(),$roles);
        });*/

        // Post created user only edit or delete record
        /*Gate::define('isAllowed', function($user, $post){
            //dd($user->all());
            return $user->id === $post;
        });*/

        // pass class address to Gate::

        //Gate::define('allow-edit', '\App\Gates\GatePost@allowedAction');
        /*
        Gate::define('isAllowed', '\App\Gates\GatePost@allowed');
        Gate::define('allow-edit', '\App\Gates\GatePost@editAction');
        Gate::define('allow-delete', '\App\Gates\GatePost@deleteAction');
        */
    }
}
