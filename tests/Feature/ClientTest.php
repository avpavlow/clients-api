<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTest extends TestCase
{
    private $email = 'user@mail.ru';
    private $password = 'secret';


    //В тестах используем транзакции
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        //Авторизация
        $response = $this->post('api/login', [
            'email' => 'user@mail.ru',
            'password' => 'secret',
        ]);

        //Получили токен
       // $this->token  = json_encode($response->baseResponse->original['access_token']);
        $this->token = $response->getData()->access_token;
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $response = $this->json('GET', 'api/clients', [], $headers);
        //Получили токен
        $response->assertStatus(200);
    }


}
