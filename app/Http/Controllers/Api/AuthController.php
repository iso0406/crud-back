<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class AuthController extends Controller {
    private $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function login(Request $request){
    	$credentials = $request->only(['email', 'password']);

    	if(!$token = auth('api')->attempt($credentials)){
    		return response()->json(['error' => 'unautorized'], 401);
    	}

    	return $this->responseWithToken($token);
    }

    public function register(UserRequest $request){
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }

        $this->userService->create($request);
        
    	return $this->login($request);
    }

    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function profile() {
        $user_data = $this->userService->userAuth();

        return response()->json([
            "data_user_auth" => $user_data
        ], 200);
    }

    protected function responseWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
