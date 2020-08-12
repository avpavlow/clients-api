<?php

namespace App\Services\UserActionsRegistration;


use App\UserAction;
use Illuminate\Support\Facades\Auth;
use App\Jobs\CreateUserActionJob;

/**
 * Сервис "Реализация регистрации действий пользователя"
 */
class UserActionsRegistration implements IUserActionsRegistration
{
    /**
     * Регистрация
     * @return mixed|void
     */
    public function register()
    {
        $data = [
            'url' => url()->full(),
            'payload' => json_encode(request()->getContent()),
            'request_method' => request()->method(),
            'user_id' => Auth::user()->id
        ];

        $job = new CreateUserActionJob($data);
        dispatch(($job)->onQueue('user_actions'));
    }
}
