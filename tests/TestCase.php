<?php

namespace Tests;

use App\Services\Authorization\IAuthToken;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase Абстрактный базовый класс тестирования
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        //Токен получаем через общий сервис
        $auth = $this->app->make(IAuthToken::class);
        $this->token =  $auth->getToken($this);
    }
}
