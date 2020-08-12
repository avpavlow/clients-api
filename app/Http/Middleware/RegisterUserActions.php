<?php

namespace App\Http\Middleware;

use App\Services\UserActionsRegistration\IUserActionsRegistration;
use Closure;
use Illuminate\Support\Facades\Auth;

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

        $data = [
            'url' => url()->full(),
            'payload' => json_decode(request()->getContent()),
            'method' => request()->method(),
            'user_id' => Auth::user()->id
        ];

        $this->registration_action->register($data);

        return $response;
    }
}
