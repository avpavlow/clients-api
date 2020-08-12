<?php

namespace Tests\Feature;

use App\Client;
use App\Services\Auth\Checkpoint\ActivationCheckpoint;
use App\Services\Authorization\IAuthToken;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTest extends TestCase
{
    private $email = 'user@mail.ru';
    private $password = 'secret';


    /**
     * Тестируем получение
     *
     * @return void
     */
    public function test_get_clients()
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $response = $this->json('GET', 'api/clients', [], $headers);
        //Получили токен
        $response->assertStatus(200);
    }


    /**
     * Тестируем на создание и удаление при этом
     */
    public function test_create_delete_client()
    {
        $headers = ['Authorization' => "Bearer $this->token"];
        $new = factory(Client::class)->make()->toArray();

        \Log::info($new);

        $created = $this->json('POST', 'api/clients', $new, $headers)
            ->assertStatus(201)->getData();

        $this->json('DELETE', 'api/clients/' . $created->id, [], $headers)
            ->assertStatus(200);
    }


    /**
     * Тестируем обновление
     */
    public function test_update_client()
    {
        $headers = ['Authorization' => "Bearer $this->token"];
        $new = factory(Client::class)->create();


        $this->json('DELETE', 'api/clients/' . $new->id, [], $headers)
            ->assertStatus(200);
    }
}
