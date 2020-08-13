<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    //В тестах используем транзакции
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        //Получили токен
        $token = json_encode($response->baseResponse->original['access_token']);

        $response->assertStatus(200);
    }


    /**
     * Для проверки регистрации
     *
     * @return void
     */
   /* public function test_user_can_register()
    {
        $response = $this->post('/api/register', [
            'email' => 'test1@mail.ru',
            'name' => 'name1',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        $response->assertStatus(200);
    }*/
}
