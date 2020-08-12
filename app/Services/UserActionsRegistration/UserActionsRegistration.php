<?php

namespace App\Services\UserActionsRegistration;


use App\UserAction;

/**
 * Сервис "Реализация регистрации действий пользователя"
 */
class UserActionsRegistration implements IUserActionsRegistration
{
    /**
     * Регистрация
     * @param array $data Данные для регистрации
     * @return mixed|void
     */
    public function register(array $data)
    {
        UserAction::create($data);
    }
}
