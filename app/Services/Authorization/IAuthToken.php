<?php


namespace App\Services\Authorization;

/**
 * Интерфейс для получения токена
 * @package App\Services\Authorization
 */
interface IAuthToken
{
    /**
     * Получить токен
     * @param $context object Контекст использования
     * @return string
     */
    public function getToken($context):string;

}
