<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientController extends Controller
{
    /**
     * Показать список с поиском
     *
     * @param Request $request
     * @return LengthAwarePaginator|mixed
     */
    public function index(Request $request)
    {
        $query = Client::query();

        if($request->full_name){
            $query->whereFullname($request->full_name);
        }

        if($request->phone){
            $query->wherePhone($request->phone);
        }

        if($request->email){
            $query->whereEmail($request->email);
        }

        $query->paginate(20);

        $clients = $query->get();

        return $clients;
    }


    /**
     * Сохраняем новый созданный объект в БД
     *
     * @param ClientRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $validated = $request->validated();
        $client = Client::create($request->validated());

        return response()->json($client, 201);
    }

    /**
     * Показать
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return Client::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ClientRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);

        $data = $request->validated();
        $client->update($data);

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return response([], 200);
    }
}
