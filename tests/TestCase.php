<?php

namespace Tests;

use App\Services\Authorization\IAuthToken;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase Абстрактный базовый класс тестирования
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * @var string Используется для обращениям к API
     */
    protected $token;

    //Для создания приложения теста
    use CreatesApplication;

    //В тестах используем транзакции
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        //Токен получаем через IoC сервис
        $auth = $this->app->make(IAuthToken::class);
        $this->token =  $auth->getToken($this);
    }
}
