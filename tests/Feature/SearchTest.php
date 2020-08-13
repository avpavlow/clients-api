<?php

namespace Tests\Feature;

use App\Client;
use App\Services\Auth\Checkpoint\ActivationCheckpoint;
use App\Services\Authorization\IAuthToken;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{

    /**
     * Тестируем поиск по полному имени
     *
     * @return void
     */
    public function test_search_by_fullname()
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $params = "?full_name=Eum q";
        $response = $this->json('GET', 'api/clients' . $params, [], $headers);
        //Получили токен
        $response->assertStatus(200);
        $response->assertJson([]);

    }

    /**
     * Тестируем поиск по телефону
     *
     * @return void
     */
    public function test_search_by_phone()
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $params = "?phone=122&page=2";
        $response = $this->json('GET', 'api/clients' . $params, [], $headers);
        //Получили токен
        $response->assertStatus(200);
        $response->assertJson([]);
        \Log::info($response->getData());
    }


    /**
     * Тестируем поиск по почте
     *
     * @return void
     */
    public function test_search_by_email()
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $params = "?email=a";
        $response = $this->json('GET', 'api/clients' . $params, [], $headers);
        //Получили токен
        $response->assertStatus(200);
        $response->assertJson([]);
    }


    /**
     * Тестируем поиск по всем параметрам
     *
     * @return void
     */
    public function test_search_by_all_options()
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $params = "?full_name=a&phone=1&email=a";
        $response = $this->json('GET', 'api/clients' . $params, [], $headers);
        //Получили токен
        $response->assertStatus(200);
        $response->assertJson([]);
    }

}
