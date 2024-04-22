<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Repository\UserRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 3
        ]);
    }

    public function attempt(array $credentials){
        return Auth::attempt($credentials);
    }

    public function logout(){
        return Auth::logout();
    }

    public function getUsersWithRoles()
    {
        return User::with("role")->get();
    }

    public function getAllRoles()
    {
        return Role::all();
    }


   
}
