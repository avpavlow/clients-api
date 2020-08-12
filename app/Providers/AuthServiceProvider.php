<?php

namespace App\Providers;

use App\Services\Auth\Authenticator;
use App\Services\Auth\DefaultAuthenticator;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Services\Authorization\IAuthToken;
use App\Services\Authorization\TestingAuthToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Сервис получения токена
        $this->app->singleton(IAuthToken::class, TestingAuthToken::class);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addDays(15));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
