<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//         'App\Models\Customer' => 'App\Policies\CustomerPolicy',
         'App\Models\Order'=> 'App\Policies\OrderPolicy',
         'App\Models\OrderItem' => 'App\Policies\OrderItemPolicy',
//         'App\Models\OrderUser' => 'App\Policies\OrderUserPolicy',
         'App\Models\User' => 'App\Policies\BasePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
