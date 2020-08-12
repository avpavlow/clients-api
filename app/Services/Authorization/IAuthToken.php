<?php


namespace App\Services\Authorization;

/**
 * Интерфейс для получения токена
 * @package App\Services\Authorization
 */
interface IAuthToken
{
    /**
     * Получение токена
     * @return string token
     */
    public function getToken():string;

}
