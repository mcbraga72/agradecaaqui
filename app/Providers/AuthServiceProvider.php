<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use App\Models\UserThanks;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Admin' => 'App\Policies\AdminPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Enterprise' => 'App\Policies\EnterprisePolicy',
        'App\Models\EnterpriseThanks' => 'App\Policies\EnterpriseThanksPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\UserThanks' => 'App\Policies\UserThanksPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();        
    }
}
