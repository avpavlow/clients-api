<?php

namespace App\Providers;

use App\Services\Authorization\AuthToken;
use App\Services\Authorization\IAuthToken;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Services\UserActionsRegistration\IUserActionsRegistration;
use App\Services\UserActionsRegistration\UserActionsRegistration;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Сервис для регистрации действий пользователя
        $this->app->singleton(IUserActionsRegistration::class, UserActionsRegistration::class);
    }


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
