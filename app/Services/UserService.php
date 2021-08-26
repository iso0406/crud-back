<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Validator;


class UserService {
    public function getAll(){
        return User::get();
    }

    public function create(UserRequest $request){
        $dataUser = $request->only(['name', 'email', 'password', 'c_password']);
        $dataUser['password'] = bcrypt($dataUser['password']);
        $user = User::create($dataUser);
        return $user;
    }

    public function findUser($id){
        return User::findOrFail($id);
    }

    public function update(Request $request, $id){
        $user = $this->findUser($id);
        $dataUser = $request->only(['name', 'email', 'password', 'c_password']);
        $user->update($dataUser);
        return $user;
    }

    public function userAuth(){
        return auth()->user();
    }

    public function delete($id){
        $user = $this->findUser($id);
        $user->delete();
        return $user;
    }
}