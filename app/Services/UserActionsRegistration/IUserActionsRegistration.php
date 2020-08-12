<?php


namespace App\services\UserActionsRegistration;

/**
 * Интерфейс регистрации действий пользователя
 * @package App\services\UserActionsRegistration
 */
interface IUserActionsRegistration
{
    /** Метод регистрации
     * @param array $data Данные для регистрации
     * @return mixed
     */
    public function register(array $data);
}
