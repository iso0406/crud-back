<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index(){
        $arr_users = $this->userService->getAll();

        return response()->json(
            [
                'users' => $arr_users,
                'message' => 'Usuários selecionado com sucesso!'
            ], 200
        );
    }

    public function show($id){
    	$user = $this->userService->findUser($id);

        return response()->json(
            [
                'user' => $user,
                'message' => 'Usuário selecionado com sucesso!'
            ], 200
        );
    }
}
