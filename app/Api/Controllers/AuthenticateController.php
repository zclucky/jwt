<?php

namespace App\Api\Controllers;


use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthenticateController extends BaseController
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'email' => 'required | email',
            'password' => 'required',
            'name' => 'required'
        ]);

        $data = [
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'name' => $request->get('name')
        ];

        $user = User::create($data);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }
}