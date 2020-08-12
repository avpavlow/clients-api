<?php

namespace App\Http\Middleware;

use App\Services\Auth\Auth;
use App\Services\UserActionsRegistration\IUserActionsRegistration;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

class RegisterUserActions
{
    private $registration_action;

    /**
     *
     * RegisterUserActions constructor.
     * @param IUserActionsRegistration $registration_action Используется сервис IoC
     */
    public function __construct(IUserActionsRegistration $registration_action)
    {
        $this->registration_action = $registration_action;
    }


    public function handle($request, Closure $next)
    {
        $response = $next($request);

        \Log::info($response);

     //   $this->registration_action->register();

        return $response;
    }
}
