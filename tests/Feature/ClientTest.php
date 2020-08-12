<?php

namespace Tests\Feature;

use App\Client;
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


    //Тестируем на создание и удаление при этом
    public function test_create_client()
    {
        $headers = ['Authorization' => "Bearer $this->token"];
        $new = factory(Client::class)->make()->toArray();
        \Log::info($new);

        $created = $this->json('POST', 'api/clients', $new, $headers)
            ->assertStatus(201)->getData();

        \Log::info(json_encode($created));

        $this->json('DELETE', 'api/clients/' . $created->id, [], $headers)
            ->assertStatus(200);
    }


    /*
        public function testsContributionAreUpdatedCorrectly()
        {
            $headers = ['Authorization' => "Bearer $this->token"];

            $Contribution = factory(PeopleContribution::class)->create([
                'title' => 'First Contribution',
                'description' => 'Ipsum',
                'people_id' => rand(1, 200)
            ]);

            $payload = [
                'title' => 'Lorem',
                'description' => 'Ipsum',
            ];

            $response = $this->json('PUT', 'api/contribution/people_contributions/' . $Contribution->id, $payload, $headers)
                ->assertStatus(200)
                ->assertJsonStructure([
                    'status',
                    'id'
                ])
                ->assertJson([
                    'status' => 0
                ]);
        }

        public function testsContributionAreDeletedCorrectly()
        {
            $headers = ['Authorization' => "Bearer $this->token"];
            $Contribution = factory(PeopleContribution::class)->create([
                'title' => 'First Contribution',
                'description' => 'Ipsum',
                'people_id' => rand(1, 200)
            ]);

            $this->json('DELETE', 'api/contribution/people_contributions/' . $Contribution->id, [], $headers)
                ->assertStatus(200)
                ->assertJson([
                    'status' => 0
                ]);
        }
    */


}
