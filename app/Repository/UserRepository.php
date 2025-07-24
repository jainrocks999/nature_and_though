<?php

namespace App\Repository;

use App\Interface\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface 
{

    public function getAllUser() 
    {
        return User::where('id', '!=', 1)->get()->all();
    }

    public function getUserById($userId) 
    {
        return User::findOrFail($userId);
    }

    public function getUserByWhereId($where, $userId) 
    {
        return User::where($where, $userId)->first();
    }

    public function deleteUser($userId) 
    {
        User::destroy($userId);
    }

    public function createUser(array $createUserDetails) 
    {
        return User::create($createUserDetails);
    }

    public function updateUser($userId, array $updateUserDetails) 
    {
        return User::whereId($userId)->update($updateUserDetails);
    }

   
}