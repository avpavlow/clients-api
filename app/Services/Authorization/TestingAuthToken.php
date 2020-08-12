<?php


namespace App\Services\Authorization;

/**
 * Получения токена из API
 * @package App\Services\Authorization
 */
class TestingAuthToken implements IAuthToken
{
    /**
     * Получаем токен авторизации
     * $testing_context object Контекст использования
     * @return string
     */
    public function getToken($testing_context): string
    {
        //Авторизация
        $response = $testing_context->post('api/login', [
            'email' => 'user@mail.ru',
            'password' => 'secret',
        ]);

        //Получили токен
        return $response->getData()->access_token;
    }
}
