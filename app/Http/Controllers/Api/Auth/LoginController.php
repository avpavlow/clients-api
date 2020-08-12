<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $input = $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ], [
            'email.exists' => 'The user credentials were incorrect.',
        ]);


        $data = [
            'grant_type' => 'password',
            'client_id' => \Config::get('app.PASSWORD_CLIENT_ID'),
            'client_secret' => \Config::get('app.PASSWORD_CLIENT_SECRET'),
            'username' => $input['email'],
            'password' => $input['password'],
        ];

        request()->request->add($data);

        $response = Route::dispatch(Request::create('/oauth/token', 'POST'));

        $data = json_decode($response->getContent(), true);

        if (!$response->isOk()) {
            return response()->json($data, 401);
        }

        return $data;
    }

    public function logout(Request $request)
    {
        $accessToken = $request->user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true,
            ]);

        $accessToken->revoke();

        return response()->json([], 201);
    }
}
