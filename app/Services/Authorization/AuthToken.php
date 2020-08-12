<?php


namespace App\Services\Authorization;

/**
 * Получения токена из API
 * @package App\Services\Authorization
 */
class AuthToken implements IAuthToken
{
    /** Получаем токен авторизации
     * @return string token
     */
    public function getToken(): string
    {
        //Авторизация
        $response = $this->post('api/login', [
            'email' => 'user@mail.ru',
            'password' => 'secret',
        ]);

        //Получили токен
        return $response->getData()->access_token;
    }
}
