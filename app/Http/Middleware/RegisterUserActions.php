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

    public function __construct(IUserActionsRegistration $registration_action)
    {
        $this->registration_action = $registration_action;
    }


    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Perform action

        return $response;
    }
}
